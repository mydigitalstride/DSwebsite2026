<?php
/**
 * AEC Landing: The Core Pillars for AEC — image cards
 * (repeater `aec_core_pillars`).
 *
 * Rest: background image + title. Hover / keyboard focus: orange-yellow
 * gradient fill, black text, overview sentence and "Explore …" link.
 */
$d       = ds_aec_defaults('core_pillars');
$heading = get_field('aec_core_pillars_heading') ?: $d['heading'];
$pillars = [];

if (have_rows('aec_core_pillars')) {
    while (have_rows('aec_core_pillars')) {
        the_row();
        $pillars[] = [
            'title'     => get_sub_field('pillar_title'),
            'image'     => get_sub_field('pillar_background_image'),
            'overview'  => get_sub_field('pillar_overview_sentence'),
            'link_text' => get_sub_field('pillar_link_text'),
            'link_url'  => get_sub_field('pillar_link_url'),
        ];
    }
}
if (!$pillars) $pillars = $d['pillars'];

$pillars = array_filter($pillars, function ($p) { return !empty($p['title']); });
if (!$pillars) return;
?>
<section class="ds-section ds-aec-pillars">
    <div class="ds-container">
        <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>

        <ul class="ds-aec-pillars__grid">
            <?php foreach ($pillars as $p) :
                $img_id    = is_array($p['image']) ? (int) ($p['image']['ID'] ?? $p['image']['id'] ?? 0) : (int) $p['image'];
                $link_text = $p['link_text'] ?: sprintf(__('Explore %s', 'digitalstride'), $p['title']);
                ?>
                <li class="ds-aec-pillar<?php echo $img_id ? '' : ' ds-aec-pillar--no-image'; ?>">
                    <?php if ($img_id) {
                        echo wp_get_attachment_image($img_id, 'card-thumb', false, [
                            'class'   => 'ds-aec-pillar__img',
                            'alt'     => '',
                            'loading' => 'lazy',
                            'sizes'   => '(max-width: 600px) 100vw, (max-width: 1024px) 50vw, 25vw',
                        ]);
                    } ?>
                    <span class="ds-aec-pillar__overlay ds-aec-pillar__overlay--default" aria-hidden="true"></span>
                    <span class="ds-aec-pillar__overlay ds-aec-pillar__overlay--hover" aria-hidden="true"></span>

                    <div class="ds-aec-pillar__body">
                        <h3 class="ds-aec-pillar__title"><?php echo esc_html($p['title']); ?></h3>
                        <div class="ds-aec-pillar__reveal">
                            <div class="ds-aec-pillar__reveal-inner">
                                <?php if ($p['overview']) : ?>
                                    <p class="ds-aec-pillar__text"><?php echo esc_html($p['overview']); ?></p>
                                <?php endif; ?>
                                <?php if ($p['link_url']) : ?>
                                    <a class="ds-aec-pillar__link" href="<?php echo esc_url($p['link_url']); ?>">
                                        <?php echo esc_html($link_text); ?> <span class="ds-aec-pillar__arrow" aria-hidden="true">&rarr;</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
