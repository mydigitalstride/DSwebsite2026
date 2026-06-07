<?php
/**
 * Flex Layout: Full-Width Angled Carousel
 * Center panel: flat full-size image.
 * Left / right panels: same-height images angled away in 3D perspective.
 * Dot navigation + optional auto-advance.
 */
$heading = get_sub_field('heading');

$slides = [];
if (have_rows('slides')) :
    while (have_rows('slides')) : the_row();
        $slides[] = [
            'image'   => get_sub_field('image'),
            'caption' => get_sub_field('caption'),
        ];
    endwhile;
endif;

if (count($slides) < 1) return;

$uid = 'fwc-' . get_the_ID() . '-' . uniqid();
?>

<section class="ds-section ds-section--fwc ds-fwc-section">
    <?php if ($heading) : ?>
        <div class="ds-container">
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        </div>
    <?php endif; ?>

    <div class="ds-fwc" id="<?php echo esc_attr($uid); ?>" data-count="<?php echo count($slides); ?>">

        <!-- Three-panel stage -->
        <div class="ds-fwc__stage">
            <div class="ds-fwc__panel ds-fwc__panel--left">
                <img src="" alt="" class="ds-fwc__img">
            </div>
            <div class="ds-fwc__panel ds-fwc__panel--center">
                <img src="" alt="" class="ds-fwc__img">
            </div>
            <div class="ds-fwc__panel ds-fwc__panel--right">
                <img src="" alt="" class="ds-fwc__img">
            </div>
        </div>

        <!-- Dot navigation -->
        <div class="ds-fwc__dots" aria-hidden="true">
            <?php foreach ($slides as $i => $slide) : ?>
                <button class="ds-fwc__dot <?php echo $i === 0 ? 'is-active' : ''; ?>" data-index="<?php echo $i; ?>"></button>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- Pass slide data to JS -->
<script>
(function () {
    var slides = <?php echo wp_json_encode(array_map(function($s) {
        return ['src' => $s['image']['url'] ?? '', 'alt' => $s['image']['alt'] ?? '', 'caption' => $s['caption'] ?? ''];
    }, $slides)); ?>;
    var el = document.getElementById(<?php echo wp_json_encode($uid); ?>);
    if (window.initFwCarousel) {
        window.initFwCarousel(el, slides);
    } else {
        document.addEventListener('ds:fwc-ready', function () { window.initFwCarousel(el, slides); });
    }
})();
</script>
