<?php
/**
 * ACF Local JSON — source of truth for field groups.
 *
 * Field groups live in /acf-json/*.json (one file per group). ACF loads them
 * from there, and any edit made in ACF > Field Groups is written straight back
 * to the matching file, so the admin UI and git stay in step.
 *
 * ACF normally waits for someone to click "Sync" after a JSON file changes on
 * disk. This helper does that automatically for admins so deployed JSON edits
 * take effect without a manual step.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Locate the database copy of a field group without falling through to the
 * local (JSON) store, which is what acf_get_field_group() would do.
 */
function ds_acf_get_field_group_post(string $key)
{
    if (function_exists('acf_get_internal_post_type_post')) {
        return acf_get_internal_post_type_post($key, 'acf-field-group');
    }
    if (function_exists('acf_get_field_group_post')) {
        return acf_get_field_group_post($key);
    }
    return false;
}

/**
 * Every database copy of a field group, newest first. Earlier versions of the
 * sync below imported without an ID, which makes ACF insert a new copy on
 * every admin page load instead of updating the existing one.
 */
function ds_acf_field_group_posts(string $key)
{
    return get_posts([
        'post_type'        => 'acf-field-group',
        'name'             => $key,
        'post_status'      => ['publish', 'acf-disabled', 'draft', 'private', 'trash'],
        'posts_per_page'   => -1,
        'orderby'          => ['modified' => 'DESC', 'ID' => 'DESC'],
        'suppress_filters' => true,
        'no_found_rows'    => true,
    ]);
}

/**
 * Remove duplicate database copies of a field group and their fields.
 *
 * Deletes the rows directly: wp_delete_post() would fire ACF's delete hooks,
 * which also delete the group's JSON file from the theme. Saved field values
 * are keyed by field key, not by these post IDs, so no content is lost.
 */
function ds_acf_delete_field_group_copies(array $ids)
{
    global $wpdb;
    $ids = array_values(array_filter(array_map('intval', $ids)));
    $all = $ids;
    // Fields are children of the group, sub fields children of their field.
    while ($ids) {
        $in   = implode(',', $ids);
        $ids  = array_map('intval', $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'acf-field' AND post_parent IN ($in)"));
        $all  = array_merge($all, $ids);
    }
    foreach (array_chunk(array_unique($all), 500) as $chunk) {
        $in = implode(',', $chunk);
        $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id IN ($in)");
        $wpdb->query("DELETE FROM {$wpdb->posts} WHERE ID IN ($in)");
        foreach ($chunk as $id) clean_post_cache($id);
    }
    if (function_exists('wp_cache_flush_group')) wp_cache_flush_group('acf');
}

add_action('acf/init', function () {
    if (!is_admin() || wp_doing_ajax() || wp_doing_cron()) {
        return;
    }
    // Only on page views, never while a form is saving: re-importing in the
    // middle of a save swaps the field definitions ACF is saving against.
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
        return;
    }
    if (!current_user_can('manage_options')) {
        return;
    }
    if (!function_exists('acf_get_local_json_files') || !function_exists('acf_import_field_group')) {
        return;
    }

    foreach (acf_get_local_json_files('acf-field-group') as $key => $file) {
        $json = json_decode((string) file_get_contents($file), true);
        if (!is_array($json) || empty($json['key'])) {
            continue;
        }

        $posts = ds_acf_field_group_posts($json['key']);
        $post  = $posts ? array_shift($posts) : null;
        if ($posts) {
            ds_acf_delete_field_group_copies(wp_list_pluck($posts, 'ID'));
        }

        if ($post) {
            $db_modified   = (int) get_post_modified_time('U', true, $post);
            $json_modified = (int) ($json['modified'] ?? 0);
            if ($json_modified <= $db_modified) {
                continue; // database copy is current
            }
            // Without the ID, ACF inserts a new copy instead of updating this one.
            $json['ID'] = $post->ID;
        }

        acf_import_field_group($json);
    }
}, 20);
