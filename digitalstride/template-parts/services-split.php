<?php
/**
 * Template Part: Services Split
 * Desktop: titles start centered and closed; opening one slides the titles left
 * and reveals its content panel on the right. Mobile: stacked accordion.
 *
 * Expects $args['services']: list of ['icon','icon_color','title','cta','subs'],
 * each sub being ['icon','icon_color','title','desc','link'].
 */
$services_data = $args['services'] ?? [];
?>
<?php if ($services_data) : ?>
    <div class="ds-services-split">
        <div class="ds-services-split__tabs">
            <?php foreach ($services_data as $i => $service) : ?>
                <div class="ds-services-split__item" data-panel="<?php echo $i; ?>">
                    <button class="ds-services-split__header" aria-expanded="false">
                        <span class="ds-accordion__title-wrap">
                            <?php if ($service['icon']) : ?>
                                <span class="<?php echo $service['icon_color'] ? 'ds-icon--' . esc_attr($service['icon_color']) : ''; ?>"><?php echo ds_inline_svg($service['icon']); ?></span>
                            <?php endif; ?>
                            <?php echo esc_html($service['title']); ?>
                        </span>
                        <i class="fa-solid fa-chevron-down ds-accordion__chevron ds-services-split__chevron" aria-hidden="true"></i>
                    </button>

                    <div class="ds-services-split__mobile-body">
                        <?php if ($service['subs']) : ?>
                            <div class="ds-services-split__subs">
                                <?php foreach ($service['subs'] as $sub) : ?>
                                    <div class="ds-services-split__sub">
                                        <?php if ($sub['icon']) : ?>
                                            <div class="ds-services-split__sub-icon <?php echo $sub['icon_color'] ? 'ds-icon--' . esc_attr($sub['icon_color']) : ''; ?>">
                                                <?php echo ds_inline_svg($sub['icon']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <h6 class="ds-services-split__sub-title"><?php echo esc_html($sub['title']); ?></h6>
                                            <p class="ds-services-split__sub-text"><?php echo esc_html($sub['desc']); ?></p>
                                            <?php if (!empty($sub['link'])) : ?>
                                                <a href="<?php echo esc_url($sub['link']['url']); ?>" class="ds-services-split__sub-link" <?php echo !empty($sub['link']['target']) ? 'target="' . esc_attr($sub['link']['target']) . '" rel="noopener"' : ''; ?>><?php echo esc_html($sub['link']['title']); ?> <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($service['cta']) : ?>
                            <div class="ds-services-split__cta">
                                <a href="<?php echo esc_url($service['cta']['url']); ?>" class="ds-btn ds-btn--secondary"><?php echo esc_html($service['cta']['title']); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="ds-services-split__panels">
            <?php foreach ($services_data as $i => $service) : ?>
                <div class="ds-services-split__panel" data-panel="<?php echo $i; ?>">
                    <?php if ($service['subs']) : ?>
                        <div class="ds-services-split__subs">
                            <?php foreach ($service['subs'] as $sub) : ?>
                                <div class="ds-services-split__sub">
                                    <?php if ($sub['icon']) : ?>
                                        <div class="ds-services-split__sub-icon <?php echo $sub['icon_color'] ? 'ds-icon--' . esc_attr($sub['icon_color']) : ''; ?>">
                                            <?php echo ds_inline_svg($sub['icon']); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <h6 class="ds-services-split__sub-title"><?php echo esc_html($sub['title']); ?></h6>
                                        <p class="ds-services-split__sub-text"><?php echo esc_html($sub['desc']); ?></p>
                                        <?php if (!empty($sub['link'])) : ?>
                                            <a href="<?php echo esc_url($sub['link']['url']); ?>" class="ds-services-split__sub-link" <?php echo !empty($sub['link']['target']) ? 'target="' . esc_attr($sub['link']['target']) . '" rel="noopener"' : ''; ?>><?php echo esc_html($sub['link']['title']); ?> <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($service['cta']) : ?>
                        <div class="ds-services-split__cta">
                            <a href="<?php echo esc_url($service['cta']['url']); ?>" class="ds-btn ds-btn--secondary"><?php echo esc_html($service['cta']['title']); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
