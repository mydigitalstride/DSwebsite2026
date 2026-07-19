<?php
/**
 * Flex Layout: Marketing Needs Survey
 * Multi-step assessment for AEC / Home Service prospects.
 * Questions and routing are defined in inc/survey.php (ds_survey_config()).
 */
$heading         = get_sub_field('heading');
$intro           = get_sub_field('intro');
$success_heading = get_sub_field('success_heading');
$success_message = get_sub_field('success_message');

$steps       = ds_survey_config();
$total_steps = count($steps);
$survey_id   = 'ds-survey-' . get_row_index();
?>

<section class="ds-section ds-section--survey">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro) : ?>
            <p class="ds-section__intro ds-survey__intro"><?php echo esc_html($intro); ?></p>
        <?php endif; ?>

        <div class="ds-survey" id="<?php echo esc_attr($survey_id); ?>">
            <div class="ds-survey__progress" aria-hidden="true">
                <div class="ds-survey__progress-bar"><span class="ds-survey__progress-fill"></span></div>
                <span class="ds-survey__progress-label"></span>
            </div>

            <form class="ds-survey__form" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post" novalidate>
                <input type="hidden" name="action" value="ds_survey_submit">
                <input type="hidden" name="ds_survey_source" value="<?php echo esc_attr(get_the_ID()); ?>">
                <div class="ds-survey__hp" aria-hidden="true">
                    <label>Leave this field empty <input type="text" name="ds_hp_website" tabindex="-1" autocomplete="off"></label>
                </div>

                <?php foreach ($steps as $s => $step) : ?>
                    <div class="ds-survey__step<?php echo $s === 0 ? ' is-active' : ''; ?>" data-step="<?php echo esc_attr($s); ?>" data-step-title="<?php echo esc_attr($step['title']); ?>">
                        <h3 class="ds-survey__step-title"><?php echo esc_html($step['title']); ?></h3>

                        <?php foreach ($step['questions'] as $q) :
                            $name     = $q['name'];
                            $type     = $q['type'];
                            $required = !empty($q['required']);
                            $show_if  = !empty($q['show_if'])
                                ? esc_attr(wp_json_encode($q['show_if']))
                                : '';
                        ?>
                            <fieldset class="ds-survey__q"
                                data-name="<?php echo esc_attr($name); ?>"
                                <?php echo $required ? 'data-required="1"' : ''; ?>
                                <?php echo $show_if ? "data-show-if='" . $show_if . "'" : ''; ?>>

                                <?php if ($type === 'consent') : ?>
                                    <label class="ds-survey__consent">
                                        <input type="checkbox" name="<?php echo esc_attr($name); ?>" value="Yes">
                                        <span><?php echo esc_html($q['label']); ?></span>
                                    </label>
                                <?php else : ?>
                                    <legend class="ds-survey__label">
                                        <?php echo esc_html($q['label']); ?>
                                        <?php if (!$required) : ?><em class="ds-survey__optional">(optional)</em><?php endif; ?>
                                    </legend>
                                    <?php if (!empty($q['help'])) : ?>
                                        <p class="ds-survey__help"><?php echo esc_html($q['help']); ?></p>
                                    <?php endif; ?>

                                    <?php if ($type === 'radio' || $type === 'checkbox') : ?>
                                        <div class="ds-survey__options">
                                            <?php foreach ($q['options'] as $opt) :
                                                $is_exclusive = isset($q['exclusive']) && $q['exclusive'] === $opt;
                                            ?>
                                                <label class="ds-survey__option">
                                                    <input
                                                        type="<?php echo esc_attr($type); ?>"
                                                        name="<?php echo esc_attr($name); ?><?php echo $type === 'checkbox' ? '[]' : ''; ?>"
                                                        value="<?php echo esc_attr($opt); ?>"
                                                        <?php echo $is_exclusive ? 'data-exclusive="1"' : ''; ?>>
                                                    <span><?php echo esc_html($opt); ?></span>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php elseif ($type === 'textarea') : ?>
                                        <textarea class="ds-survey__input" name="<?php echo esc_attr($name); ?>" rows="4"
                                            placeholder="<?php echo esc_attr($q['placeholder'] ?? ''); ?>"></textarea>
                                    <?php else : ?>
                                        <input class="ds-survey__input"
                                            type="<?php echo esc_attr($type); ?>"
                                            name="<?php echo esc_attr($name); ?>"
                                            placeholder="<?php echo esc_attr($q['placeholder'] ?? ''); ?>"
                                            <?php echo $type === 'tel' ? 'autocomplete="tel"' : ''; ?>
                                            <?php echo $type === 'email' ? 'autocomplete="email"' : ''; ?>>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <p class="ds-survey__error" hidden>This one's required — it helps us give you a useful answer.</p>
                            </fieldset>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

                <p class="ds-survey__form-error" hidden></p>

                <div class="ds-survey__nav">
                    <button type="button" class="ds-btn ds-btn--outline ds-survey__back" hidden>Back</button>
                    <button type="button" class="ds-btn ds-btn--primary ds-survey__next">Next</button>
                    <button type="submit" class="ds-btn ds-btn--primary ds-survey__submit" hidden>Get My Assessment</button>
                </div>
            </form>

            <div class="ds-survey__success" hidden>
                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                <h3><?php echo esc_html($success_heading ?: 'Thanks — your assessment is on its way!'); ?></h3>
                <p><?php echo esc_html($success_message ?: "We'll review your answers and reach out within one business day with our honest read on your biggest opportunities."); ?></p>
            </div>
        </div>
    </div>
</section>
