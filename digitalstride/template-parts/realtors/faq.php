<?php
/**
 * Realtors 5: FAQ (s5_* fields). The site accordion (main.js / main.css).
 * Blue heading bar.
 */
$d     = ds_rlt_defaults('faq');
$title = get_field('s5_title') ?: $d['title'];
$faqs  = ds_rlt_rows('s5_faqs', $d['faqs'], ['question']);
if (!$faqs) return;
?>
<section class="ds-section ds-section--faq ds-rlt-faq">
    <div class="ds-container">
        <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($title); ?></h2>

        <div class="ds-accordion">
            <?php foreach ($faqs as $faq) : ?>
                <div class="ds-accordion__item">
                    <button class="ds-accordion__header" aria-expanded="false">
                        <span><?php echo esc_html($faq['question']); ?></span>
                        <i class="fa-solid fa-chevron-down ds-accordion__chevron" aria-hidden="true"></i>
                    </button>
                    <div class="ds-accordion__body">
                        <?php echo wp_kses_post(wpautop($faq['answer'] ?? '')); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
