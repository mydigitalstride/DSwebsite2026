<?php
/**
 * Audiences — AEC vs Home Services journeys.
 *
 * Every flexible-content section carries an "audience" value (all / aec /
 * home_services). Sections are always in the HTML; the visitor's pick is
 * stored client-side and applied as data-audience on <html>, and CSS hides
 * the sections tagged for the other industry. Nothing is personalised on
 * the server, so bots, caches and visitors all receive the same page and
 * the un-picked page stays a coherent generalist page for search engines.
 *
 * A pick is remembered in localStorage (and mirrored to a cookie for
 * server-side tools that want it) and can be pre-set with ?industry=aec.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DS_AUDIENCE_COOKIE', 'ds_audience');
define('DS_AUDIENCE_PARAM', 'industry');

/**
 * The two audiences with their labels, descriptions and destination pages.
 * Values come from Theme Settings > Audiences with sensible defaults.
 *
 * @return array<string, array{label:string, description:string, url:string}>
 */
function ds_audiences() {
    static $cache = null;
    if ($cache !== null) return $cache;

    $defaults = [
        'aec' => [
            'label'       => 'AEC',
            'description' => 'Architecture, engineering & construction firms',
            'url'         => '',
        ],
        'home_services' => [
            'label'       => 'Home Services',
            'description' => 'HVAC, plumbing, electrical, roofing & more',
            'url'         => '',
        ],
    ];

    $cache = [];
    foreach ($defaults as $slug => $def) {
        $group = function_exists('get_field') ? get_field('audience_' . $slug, 'option') : null;
        $link  = is_array($group) && !empty($group['link']) ? $group['link'] : null;

        $cache[$slug] = [
            'label'       => !empty($group['label']) ? $group['label'] : $def['label'],
            'description' => isset($group['description']) && $group['description'] !== '' ? $group['description'] : $def['description'],
            'url'         => !empty($link['url']) ? $link['url'] : $def['url'],
        ];
    }

    return $cache;
}

/**
 * Valid audience slugs, including the "everyone" value used on sections.
 */
function ds_audience_slugs() {
    return ['all', 'aec', 'home_services'];
}

/**
 * Render one audience button.
 *
 * Output is an <a> pointing at the industry page when one is set (so the
 * link is crawlable and works without JavaScript) and a <button> otherwise.
 * JavaScript reads data-audience-set / data-audience-on-select.
 *
 * @param string $slug      'aec' | 'home_services'
 * @param array  $args      class, on_select ('reveal'|'navigate'), show_description
 */
function ds_audience_button($slug, $args = []) {
    $audiences = ds_audiences();
    if (empty($audiences[$slug])) return;

    $args = wp_parse_args($args, [
        'class'            => 'ds-btn ds-btn--primary',
        'on_select'        => 'reveal',
        'show_description' => false,
    ]);
    $a   = $audiences[$slug];
    $tag = $a['url'] ? 'a' : 'button';

    $attrs = [
        'class'                     => trim($args['class'] . ' ds-audience-btn ds-audience-btn--' . $slug),
        'data-audience-set'         => $slug,
        'data-audience-on-select'   => $args['on_select'] === 'navigate' && $a['url'] ? 'navigate' : 'reveal',
        'aria-pressed'              => 'false',
    ];
    if ($tag === 'a') {
        $attrs['href'] = $a['url'];
    } else {
        $attrs['type'] = 'button';
    }

    $html = '';
    foreach ($attrs as $k => $v) {
        $html .= ' ' . $k . '="' . esc_attr($v) . '"';
    }
    ?>
    <<?php echo $tag . $html; ?>>
        <span class="ds-audience-btn__label"><?php echo esc_html($a['label']); ?></span>
        <?php if ($args['show_description'] && $a['description']) : ?>
            <span class="ds-audience-btn__desc"><?php echo esc_html($a['description']); ?></span>
        <?php endif; ?>
    </<?php echo $tag; ?>>
    <?php
}

/**
 * Wrap a flexible-content section in an audience container when it is
 * tagged for one industry. Called by ds_render_flex().
 */
function ds_audience_wrap_open() {
    $audience = function_exists('get_sub_field') ? get_sub_field('audience') : '';
    if (!$audience || $audience === 'all' || !in_array($audience, ds_audience_slugs(), true)) {
        return false;
    }
    echo '<div class="ds-audience ds-audience--' . esc_attr($audience) . '" data-audience="' . esc_attr($audience) . '">';
    return true;
}

function ds_audience_wrap_close($opened) {
    if ($opened) echo '</div>';
}

/**
 * Switcher bar above the header, rendered from header.php.
 */
function ds_render_audience_bar() {
    if (!function_exists('get_field')) return;
    $enabled = get_field('audience_bar_enabled', 'option');
    if ($enabled === false || $enabled === 0 || $enabled === '0') return;

    $label = get_field('audience_bar_label', 'option');
    if ($label === null || $label === '') $label = "I'm in:";
    ?>
    <div class="ds-audience-bar" id="ds-audience-bar">
        <div class="ds-audience-bar__inner">
            <span class="ds-audience-bar__label"><?php echo esc_html($label); ?></span>
            <div class="ds-audience-bar__options" role="group" aria-label="<?php esc_attr_e('Choose your industry', 'digitalstride'); ?>">
                <?php foreach (array_keys(ds_audiences()) as $slug) : ?>
                    <?php ds_audience_button($slug, ['class' => 'ds-audience-bar__btn', 'on_select' => 'reveal']); ?>
                <?php endforeach; ?>
            </div>
            <button type="button" class="ds-audience-bar__clear" data-audience-clear aria-label="<?php esc_attr_e('Show content for everyone', 'digitalstride'); ?>">
                <?php esc_html_e('Show all', 'digitalstride'); ?>
            </button>
        </div>
    </div>
    <?php
}

/**
 * Apply the stored / URL audience before first paint so there is no flash
 * of the other industry's content. Runs at the top of <head>.
 */
add_action('wp_head', function () {
    ?>
    <script>
    (function () {
        var valid = ['aec', 'home_services'], a = null;
        try {
            var m = location.search.match(/[?&]<?php echo DS_AUDIENCE_PARAM; ?>=([^&#]+)/);
            if (m) a = decodeURIComponent(m[1]).replace(/-/g, '_');
            if (valid.indexOf(a) === -1) a = localStorage.getItem('<?php echo DS_AUDIENCE_COOKIE; ?>');
        } catch (e) {}
        if (valid.indexOf(a) !== -1) document.documentElement.setAttribute('data-audience', a);
    })();
    </script>
    <?php
}, 0);

/**
 * Expose the config to main.js.
 */
add_action('wp_enqueue_scripts', function () {
    wp_localize_script('digitalstride-main', 'dsAudienceConfig', [
        'storageKey' => DS_AUDIENCE_COOKIE,
        'param'      => DS_AUDIENCE_PARAM,
        'audiences'  => ds_audiences(),
    ]);
}, 20);

/**
 * Options page.
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_options_sub_page')) return;
    acf_add_options_sub_page([
        'page_title'  => 'Audiences (AEC / Home Services)',
        'menu_title'  => 'Audiences',
        'menu_slug'   => 'acf-options-audiences',
        'parent_slug' => 'theme-settings',
    ]);
});
