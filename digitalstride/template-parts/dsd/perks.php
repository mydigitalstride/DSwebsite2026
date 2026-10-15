<?php
/**
 * DSD: Perks row under the hero (hero_perks, group_dsd_hero).
 *
 * Four columns of large icons in the site's blue icon gradient with a
 * title and a line of text. Uploaded SVGs are tinted the same way.
 */
$d     = ds_dsd_defaults('hero');
$perks = array_slice(ds_dsd_rows('hero_perks', $d['perks'], ['title', 'subtitle']), 0, 4);
$fa    = array_column($d['perks'], 'fa');
if (!$perks) return;
?>
<section class="ds-section ds-dsd-perks" aria-label="<?php esc_attr_e('DSD benefits', 'digitalstride'); ?>">
    <div class="ds-container">
        <ul class="ds-dsd-perks__grid">
            <?php foreach ($perks as $i => $perk) : ?>
                <li class="ds-dsd-perk">
                    <?php echo ds_dsd_icon($perk['icon'] ?? null, !empty($perk['fa']) ? $perk['fa'] : ($fa[$i] ?? 'fa-solid fa-check'), 'ds-dsd-perk__icon'); ?>
                    <?php if (!empty($perk['title'])) : ?><h3 class="ds-dsd-perk__title"><?php echo esc_html($perk['title']); ?></h3><?php endif; ?>
                    <?php if (!empty($perk['subtitle'])) : ?><p class="ds-dsd-perk__text"><?php echo esc_html($perk['subtitle']); ?></p><?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
