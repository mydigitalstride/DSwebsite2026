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

add_action('acf/init', function () {
    if (!is_admin() || wp_doing_ajax() || wp_doing_cron()) {
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

        $post = ds_acf_get_field_group_post($json['key']);
        if ($post) {
            $db_modified   = (int) get_post_modified_time('U', true, $post);
            $json_modified = (int) ($json['modified'] ?? 0);
            if ($json_modified <= $db_modified) {
                continue; // database copy is current
            }
        }

        // ACF matches on 'key', so an existing group is updated in place.
        acf_import_field_group($json);
    }
}, 20);
