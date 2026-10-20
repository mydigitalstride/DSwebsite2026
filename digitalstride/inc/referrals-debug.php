<?php
/**
 * TEMPORARY: diagnose Referral Form fields not saving in the page editor.
 *
 * When an administrator updates a page that has a Referral Form section,
 * this records what the save request carried and what ACF stored, and shows
 * it in a box at the top of the edit screen after the reload. Nothing is
 * shown to anyone else or on the front end. Delete this file and its
 * require_once in functions.php once the cause is found.
 */

if (!defined('ABSPATH')) {
    exit;
}

function ds_ref_debug_key($post_id) {
    return 'ds_ref_debug_' . get_current_user_id() . '_' . (int) $post_id;
}

/** Referral rows in the posted page_sections, keyed by posted row id. */
function ds_ref_debug_posted_rows() {
    $rows = $_POST['acf']['field_page_sections'] ?? null;
    if (!is_array($rows)) return [];
    return array_filter($rows, function ($row) {
        return is_array($row) && ($row['acf_fc_layout'] ?? '') === 'referral_form';
    });
}

// Before ACF saves (it hooks save_post at 10).
add_action('save_post_page', function ($post_id) {
    if (!current_user_can('manage_options') || wp_is_post_revision($post_id) || (int) ($_POST['post_ID'] ?? 0) !== (int) $post_id) return;

    $report = [
        'time'             => current_time('mysql'),
        'acf_version'      => defined('ACF_VERSION') ? ACF_VERSION : (function_exists('acf') ? acf()->version : 'not loaded'),
        'acf_pro'          => defined('ACF_PRO') ? 'yes' : 'no',
        'post_vars'        => count($_POST, COUNT_RECURSIVE),
        'max_input_vars'   => ini_get('max_input_vars'),
        'acf_nonce'        => empty($_POST['_acf_nonce']) ? 'MISSING' : 'present',
        'page_sections_posted' => isset($_POST['acf']['field_page_sections']) ? 'yes' : 'NO',
        'referral_rows_posted' => [],
    ];
    foreach (ds_ref_debug_posted_rows() as $row_id => $row) {
        $fields = [];
        foreach ($row as $key => $value) {
            $fields[$key] = is_scalar($value) ? wp_trim_words((string) $value, 8, '…') : '(array)';
        }
        $report['referral_rows_posted'][$row_id] = $fields;
    }

    // Where ACF gets the Page Sections definition from, and whether it
    // knows the Referral Form sub fields.
    if (function_exists('acf_get_field')) {
        $field = acf_get_field('field_page_sections');
        $layout = null;
        foreach ((array) ($field['layouts'] ?? []) as $l) {
            if (($l['name'] ?? '') === 'referral_form') $layout = $l;
        }
        $report['field_source']      = $field ? (function_exists('acf_is_local_field') && acf_is_local_field('field_page_sections') ? 'local' : 'database') : 'NOT FOUND';
        $report['heading_field_source'] = function_exists('acf_is_local_field') && acf_is_local_field('field_rf_heading') ? 'local' : (acf_get_field('field_rf_heading') ? 'database' : 'NOT FOUND');
        $report['referral_layout']   = $layout ? count($layout['sub_fields'] ?? []) . ' sub fields: ' . implode(', ', wp_list_pluck($layout['sub_fields'] ?? [], 'name')) : 'NOT FOUND';
        $group = function_exists('acf_get_field_group') ? acf_get_field_group('group_page_sections') : null;
        $report['group_source']      = $group ? (!empty($group['local']) ? 'local ' . $group['local'] : 'database') : 'NOT FOUND';
        $report['group_json_file']   = $group['local_file'] ?? '';
        $db = function_exists('ds_acf_get_field_group_post') ? ds_acf_get_field_group_post('group_page_sections') : null;
        $report['group_db_modified'] = $db ? get_post_modified_time('Y-m-d H:i:s', true, $db) . ' UTC' : 'none';
        $report['group_json_modified'] = !empty($group['modified']) ? gmdate('Y-m-d H:i:s', (int) $group['modified']) . ' UTC' : '';
    }

    set_transient(ds_ref_debug_key($post_id), $report, HOUR_IN_SECONDS);
}, 1);

// After ACF has validated and saved (ACF uses the generic save_post hook,
// which runs after save_post_page).
add_action('save_post', function ($post_id) {
    $key = ds_ref_debug_key($post_id);
    $report = get_transient($key);
    if (!$report) return;

    $report['validation_errors'] = function_exists('acf_get_validation_errors') ? (acf_get_validation_errors() ?: 'none') : 'n/a';
    $report['acf_save_ran'] = did_action('acf/save_post') ? 'yes' : 'NO';

    $stored = [];
    $rows = (array) get_post_meta($post_id, 'page_sections', true);
    foreach ($rows as $i => $layout) {
        if ($layout !== 'referral_form') continue;
        foreach (['heading', 'intro', 'reward_amount', 'max_referrals', 'notify_email'] as $name) {
            $value = get_post_meta($post_id, 'page_sections_' . $i . '_' . $name, true);
            $stored['row ' . $i][$name] = metadata_exists('post', $post_id, 'page_sections_' . $i . '_' . $name) ? wp_trim_words((string) $value, 8, '…') : '(not stored)';
        }
    }
    $report['layouts_stored'] = $rows ? implode(', ', $rows) : '(none)';
    $report['referral_values_stored'] = $stored ?: '(no referral_form row stored)';
    set_transient($key, $report, HOUR_IN_SECONDS);
}, 99);

add_action('admin_notices', function () {
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen || $screen->base !== 'post' || $screen->post_type !== 'page' || !current_user_can('manage_options')) return;
    $post_id = absint($_GET['post'] ?? 0);
    $report = $post_id ? get_transient(ds_ref_debug_key($post_id)) : null;
    if (!$report) return;
    delete_transient(ds_ref_debug_key($post_id));
    echo '<div class="notice notice-warning"><p><strong>Referral Form save diagnostic</strong> — please copy everything in this box and send it to your developer.</p>';
    echo '<textarea readonly rows="14" style="width:100%;font-family:monospace;font-size:12px">' . esc_textarea(wp_json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)) . '</textarea></div>';
});
