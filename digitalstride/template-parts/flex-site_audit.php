<?php
/**
 * Flex Layout: Free Site & AI Search Audit (lead magnet)
 * Captures the lead, then runs Google Lighthouse (PageSpeed Insights) plus
 * AI search readiness checks and renders the report in place.
 * Server side: inc/site-audit.php. Front end: assets/js/main.js (.ds-audit).
 */
$heading      = get_sub_field('heading');
$intro        = get_sub_field('intro');
$button_label = get_sub_field('button_label') ?: 'Run My Free Audit';
$cta_heading  = get_sub_field('cta_heading');
$cta_text     = get_sub_field('cta_text');
$cta_label    = get_sub_field('cta_label') ?: 'Book My Free Walkthrough';
$cta_url      = get_sub_field('cta_url');

$fields = [
    ['name' => 'website_url',   'label' => 'Your website',  'type' => 'text',  'required' => true,  'placeholder' => 'yourcompany.com', 'autocomplete' => 'url', 'inputmode' => 'url'],
    ['name' => 'contact_name',  'label' => 'Your name',     'type' => 'text',  'required' => true,  'autocomplete' => 'name'],
    ['name' => 'contact_email', 'label' => 'Email',         'type' => 'email', 'required' => true,  'autocomplete' => 'email', 'help' => "We'll send a copy of your report here."],
    ['name' => 'company',       'label' => 'Company name',  'type' => 'text',  'required' => false, 'autocomplete' => 'organization'],
    ['name' => 'contact_phone', 'label' => 'Phone',         'type' => 'tel',   'required' => false, 'autocomplete' => 'tel'],
];
?>

<section class="ds-section ds-section--audit">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro) : ?>
            <p class="ds-section__intro ds-audit__intro"><?php echo esc_html($intro); ?></p>
        <?php endif; ?>

        <div class="ds-audit">
            <form class="ds-survey__form ds-audit__form" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post" novalidate>
                <input type="hidden" name="action" value="ds_site_audit_submit">
                <input type="hidden" name="ds_audit_source" value="<?php echo esc_attr(get_the_ID()); ?>">
                <div class="ds-survey__hp" aria-hidden="true">
                    <label>Leave this field empty <input type="text" name="ds_hp_website" tabindex="-1" autocomplete="off"></label>
                </div>

                <div class="ds-audit__fields">
                    <?php foreach ($fields as $f) :
                        $id = 'ds-audit-' . $f['name'] . '-' . get_row_index();
                    ?>
                        <div class="ds-audit__field<?php echo $f['name'] === 'website_url' ? ' ds-audit__field--wide' : ''; ?>" data-name="<?php echo esc_attr($f['name']); ?>" <?php echo $f['required'] ? 'data-required="1"' : ''; ?>>
                            <label class="ds-survey__label" for="<?php echo esc_attr($id); ?>">
                                <?php echo esc_html($f['label']); ?>
                                <?php if (!$f['required']) : ?><em class="ds-survey__optional">(optional)</em><?php endif; ?>
                            </label>
                            <input class="ds-survey__input" id="<?php echo esc_attr($id); ?>"
                                type="<?php echo esc_attr($f['type']); ?>"
                                name="<?php echo esc_attr($f['name']); ?>"
                                placeholder="<?php echo esc_attr($f['placeholder'] ?? ''); ?>"
                                autocomplete="<?php echo esc_attr($f['autocomplete']); ?>"
                                <?php echo !empty($f['inputmode']) ? 'inputmode="' . esc_attr($f['inputmode']) . '" autocapitalize="off" spellcheck="false"' : ''; ?>>
                            <?php if (!empty($f['help'])) : ?>
                                <p class="ds-survey__help ds-audit__help"><?php echo esc_html($f['help']); ?></p>
                            <?php endif; ?>
                            <p class="ds-survey__error" hidden>Please fill this in.</p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="ds-audit__field" data-name="consent" data-required="1">
                    <label class="ds-survey__consent">
                        <input type="checkbox" name="consent" value="Yes">
                        <span>I agree to be contacted by Digital Stride about my results.</span>
                    </label>
                    <p class="ds-survey__error" hidden>Please check this box so we can send your report.</p>
                </div>

                <p class="ds-survey__form-error" hidden></p>

                <div class="ds-audit__actions">
                    <button type="submit" class="ds-btn ds-btn--primary ds-audit__submit"><?php echo esc_html($button_label); ?></button>
                    <p class="ds-audit__fineprint">Free. Powered by Google Lighthouse. Takes about a minute.</p>
                </div>
            </form>

            <div class="ds-audit__loading" hidden aria-live="polite">
                <span class="ds-survey__quote-spinner" aria-hidden="true"></span>
                <p class="ds-audit__loading-text">Running Google Lighthouse on your site…</p>
                <p class="ds-audit__loading-note">This usually takes 30–60 seconds. Keep this tab open.</p>
            </div>

            <div class="ds-audit__results" hidden aria-live="polite"></div>

            <?php if ($cta_heading || $cta_url) : ?>
                <div class="ds-audit__cta" hidden>
                    <?php if ($cta_heading) : ?><h3><?php echo esc_html($cta_heading); ?></h3><?php endif; ?>
                    <?php if ($cta_text) : ?><p><?php echo esc_html($cta_text); ?></p><?php endif; ?>
                    <?php if ($cta_url) : ?>
                        <a class="ds-btn ds-btn--primary" href="<?php echo esc_url($cta_url); ?>"><?php echo esc_html($cta_label); ?></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
