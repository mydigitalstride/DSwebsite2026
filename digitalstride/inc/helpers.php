<?php
/**
 * Helper: inline an SVG from the media library, or fall back to <img>.
 *
 * Pass an ACF image array (return_format = 'array').
 * For SVG files the raw markup is read from disk, stripped of XML/DOCTYPE
 * declarations, and output inline so CSS fill/filter rules can target paths.
 * Non-SVG files are returned as a normal <img> tag.
 *
 * @param array  $image  ACF image array with 'id', 'url', 'alt', 'mime_type'.
 * @param string $class  Extra classes added to the root <svg> or <img>.
 * @return string
 */
function ds_inline_svg( $image, $class = '' ) {
    if ( empty( $image ) ) return '';

    $mime = $image['mime_type'] ?? '';
    $url  = $image['url']       ?? '';
    $ext  = strtolower( pathinfo( $url, PATHINFO_EXTENSION ) );

    if ( $mime === 'image/svg+xml' || $ext === 'svg' ) {
        $path = ! empty( $image['id'] ) ? get_attached_file( $image['id'] ) : '';

        if ( $path && file_exists( $path ) ) {
            $svg = file_get_contents( $path );

            if ( $svg ) {
                // Remove XML declaration and DOCTYPE
                $svg = preg_replace( '/<\?xml[^?]*\?>\s*/i', '', $svg );
                $svg = preg_replace( '/<!DOCTYPE[^>]*>\s*/i',  '', $svg );
                $svg = trim( $svg );

                // Replace hardcoded fill values with currentColor (preserve fill="none")
                // This lets CSS color/fill rules control the icon tint.
                $svg = preg_replace( '/\sfill="(?!none\b)[^"]*"/',   ' fill="currentColor"', $svg );
                $svg = preg_replace( "/\sfill='(?!none\b)[^']*'/",   " fill='currentColor'", $svg );
                // Strip fill from inline style attributes so they don't override CSS
                $svg = preg_replace( '/\bfill\s*:\s*(?!none\b)[^;}"\']+/i', 'fill:currentColor', $svg );

                // Build class string
                $cls = 'ds-svg' . ( $class ? ' ' . esc_attr( $class ) : '' );

                // Inject class and aria-hidden into the root <svg> tag
                if ( preg_match( '/<svg([^>]*)>/i', $svg, $m ) ) {
                    $attrs = $m[1];
                    // Append to existing class or add new one
                    if ( preg_match( '/class=["\']([^"\']*)["\']/', $attrs, $cm ) ) {
                        $new_attrs = str_replace( $cm[0], 'class="' . esc_attr( $cm[1] ) . ' ' . $cls . '"', $attrs );
                    } else {
                        $new_attrs = $attrs . ' class="' . $cls . '"';
                    }
                    // Add aria-hidden if not present
                    if ( strpos( $new_attrs, 'aria-hidden' ) === false ) {
                        $new_attrs .= ' aria-hidden="true"';
                    }
                    $svg = str_replace( $m[0], '<svg' . $new_attrs . '>', $svg );
                }

                return $svg;
            }
        }
    }

    // Fallback: regular img tag
    $cls_attr = $class ? ' class="' . esc_attr( $class ) . '"' : '';
    return '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $image['alt'] ?? '' ) . '"' . $cls_attr . '>';
}

/**
 * Helper: render a flexible content layout
 */
function ds_render_flex($field_name = 'page_sections', $post_id = false) {
    if (!have_rows($field_name, $post_id)) return;

    while (have_rows($field_name, $post_id)) {
        the_row();
        $layout = get_row_layout();
        get_template_part('template-parts/flex', $layout);
    }
}

/**
 * Helper: render global flex sections (from options)
 */
function ds_render_global_cta() {
    ds_render_flex('global_cta_sections', 'option');
}

/**
 * Helper: build an autoplay-friendly embed URL for a YouTube or Vimeo link.
 *
 * Returns '' when the URL is not a recognised provider, so callers can fall
 * back to treating the value as a direct video file.
 *
 * @param string $url   Video page / share URL.
 * @param array  $args  autoplay, loop, controls, muted booleans.
 * @return string
 */
function ds_video_embed_url( $url, $args = [] ) {
    $url = trim( (string) $url );
    if ( ! $url ) return '';

    $args = wp_parse_args( $args, [
        'autoplay' => true,
        'loop'     => false,
        'controls' => false,
        'muted'    => true,
    ] );

    // YouTube: watch?v=ID, youtu.be/ID, /embed/ID, /shorts/ID
    if ( preg_match( '~(?:youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|v/)|youtu\.be/)([A-Za-z0-9_-]{6,})~i', $url, $m ) ) {
        $params = [
            'autoplay'       => $args['autoplay'] ? 1 : 0,
            'mute'           => $args['muted']    ? 1 : 0,
            'controls'       => $args['controls'] ? 1 : 0,
            'loop'           => $args['loop']     ? 1 : 0,
            'playsinline'    => 1,
            'rel'            => 0,
            'modestbranding' => 1,
        ];
        // A single-video loop only works when the video is also its own playlist.
        if ( $args['loop'] ) $params['playlist'] = $m[1];

        return add_query_arg( $params, 'https://www.youtube-nocookie.com/embed/' . $m[1] );
    }

    // Vimeo: vimeo.com/ID, player.vimeo.com/video/ID, optional /HASH for unlisted
    if ( preg_match( '~vimeo\.com/(?:video/)?(\d+)(?:/([A-Za-z0-9]+))?~i', $url, $m ) ) {
        $params = [
            'autoplay'    => $args['autoplay'] ? 1 : 0,
            'muted'       => $args['muted']    ? 1 : 0,
            'controls'    => $args['controls'] ? 1 : 0,
            'loop'        => $args['loop']     ? 1 : 0,
            'playsinline' => 1,
            'title'       => 0,
            'byline'      => 0,
            'portrait'    => 0,
            'dnt'         => 1,
        ];
        if ( ! empty( $m[2] ) ) $params['h'] = $m[2];

        return add_query_arg( $params, 'https://player.vimeo.com/video/' . $m[1] );
    }

    return '';
}

/**
 * Helper: normalise one carousel repeater row into a predictable array.
 *
 * Rows saved before video support existed have no 'media_type', so anything
 * that is not explicitly a video is treated as an image.
 *
 * @param array $slide Raw ACF repeater row.
 * @return array|null  ['type' => 'image'|'video-file'|'video-embed', ...] or null when empty.
 */
function ds_carousel_slide( $slide ) {
    if ( empty( $slide ) || ! is_array( $slide ) ) return null;

    $caption = $slide['caption'] ?? '';

    if ( ( $slide['media_type'] ?? 'image' ) !== 'video' ) {
        if ( empty( $slide['image'] ) ) return null;

        return [
            'type'    => 'image',
            'image'   => $slide['image'],
            'caption' => $caption,
        ];
    }

    $autoplay = ! isset( $slide['video_autoplay'] ) || $slide['video_autoplay'];
    $loop     = ! empty( $slide['video_loop'] );
    // Without autoplay nothing would ever start, so controls are forced on.
    $controls = ! empty( $slide['video_controls'] ) || ! $autoplay;
    $poster   = $slide['video_poster'] ?? null;
    $source   = $slide['video_source'] ?? 'file';

    $base = [
        'caption'  => $caption,
        'autoplay' => $autoplay,
        'loop'     => $loop,
        'controls' => $controls,
        'poster'   => ! empty( $poster['url'] ) ? $poster['url'] : '',
    ];

    if ( $source === 'file' && ! empty( $slide['video_file']['url'] ) ) {
        return $base + [
            'type' => 'video-file',
            'url'  => $slide['video_file']['url'],
            'mime' => $slide['video_file']['mime_type'] ?? '',
            'alt'  => $slide['video_file']['title'] ?? '',
        ];
    }

    if ( $source === 'url' && ! empty( $slide['video_url'] ) ) {
        $embed = ds_video_embed_url( $slide['video_url'], [
            'autoplay' => $autoplay,
            'loop'     => $loop,
            'controls' => $controls,
        ] );

        if ( $embed ) {
            return $base + [
                'type' => 'video-embed',
                'url'  => $embed,
            ];
        }

        // Not YouTube / Vimeo — assume a directly playable file URL.
        return $base + [
            'type' => 'video-file',
            'url'  => $slide['video_url'],
            'mime' => '',
            'alt'  => '',
        ];
    }

    return null;
}

/**
 * Helper: render the shared hero-style media carousel (images and/or videos).
 *
 * Used by the hero and CTA banner flex layouts so both stay in sync.
 *
 * @param array $slides Rows from a 'carousel_images' repeater.
 * @param array $args   'label' => aria-label, 'nav' => show prev/next + dots,
 *                      'interval' => auto-advance ms for non-video slides.
 * @return void
 */
function ds_render_media_carousel( $slides, $args = [] ) {
    if ( empty( $slides ) || ! is_array( $slides ) ) return;

    $args = wp_parse_args( $args, [
        'label'    => __( 'Media carousel', 'digitalstride' ),
        'nav'      => false,
        'interval' => 5000,
    ] );

    $items = array_values( array_filter( array_map( 'ds_carousel_slide', $slides ) ) );
    if ( ! $items ) return;
    ?>
    <div class="ds-hero__carousel" aria-label="<?php echo esc_attr( $args['label'] ); ?>"
         data-interval="<?php echo (int) $args['interval']; ?>">
        <div class="ds-hero__carousel-track">
            <?php foreach ( $items as $i => $item ) :
                $active = ( $i === 0 );
                // Video slides that play through once drive their own timing.
                $waits  = ( $item['type'] === 'video-file' && $item['autoplay'] && ! $item['loop'] );
                ?>
                <div class="ds-hero__slide ds-hero__slide--<?php echo esc_attr( $item['type'] === 'image' ? 'image' : 'video' ); ?> <?php echo $active ? 'is-active' : ''; ?>"
                     aria-hidden="<?php echo $active ? 'false' : 'true'; ?>"
                     <?php echo $waits ? 'data-wait="1"' : ''; ?>>

                    <?php if ( $item['type'] === 'image' ) : ?>
                        <img src="<?php echo esc_url( $item['image']['url'] ); ?>"
                             alt="<?php echo esc_attr( $item['image']['alt'] ?: $item['caption'] ); ?>"
                             loading="<?php echo $active ? 'eager' : 'lazy'; ?>">

                    <?php elseif ( $item['type'] === 'video-file' ) : ?>
                        <video class="ds-hero__slide-video"
                               <?php echo $item['poster'] ? 'poster="' . esc_url( $item['poster'] ) . '"' : ''; ?>
                               preload="<?php echo $active ? 'auto' : 'metadata'; ?>"
                               playsinline
                               <?php echo $item['autoplay'] ? 'muted' : ''; ?>
                               <?php echo $item['loop'] ? 'loop' : ''; ?>
                               <?php echo $item['controls'] ? 'controls' : ''; ?>
                               data-autoplay="<?php echo $item['autoplay'] ? '1' : '0'; ?>"
                               <?php echo $item['caption'] ? 'aria-label="' . esc_attr( $item['caption'] ) . '"' : ''; ?>>
                            <source src="<?php echo esc_url( $item['url'] ); ?>"
                                    <?php echo $item['mime'] ? 'type="' . esc_attr( $item['mime'] ) . '"' : ''; ?>>
                        </video>

                    <?php else : ?>
                        <div class="ds-hero__slide-embed">
                            <?php // src is set by JS when the slide becomes active so nothing plays off-screen. ?>
                            <iframe data-src="<?php echo esc_url( $item['url'] ); ?>"
                                    title="<?php echo esc_attr( $item['caption'] ?: __( 'Video', 'digitalstride' ) ); ?>"
                                    frameborder="0" loading="lazy"
                                    allow="autoplay; fullscreen; picture-in-picture; encrypted-media"
                                    allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>

                    <?php if ( $item['caption'] ) : ?>
                        <p class="ds-hero__slide-caption"><?php echo esc_html( $item['caption'] ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ( $args['nav'] && count( $items ) > 1 ) : ?>
            <div class="ds-hero__carousel-nav">
                <button class="ds-hero__carousel-btn ds-hero__carousel-btn--prev" aria-label="<?php esc_attr_e( 'Previous slide', 'digitalstride' ); ?>">&#10094;</button>
                <div class="ds-hero__carousel-dots">
                    <?php foreach ( $items as $i => $item ) : ?>
                        <button class="ds-hero__carousel-dot <?php echo $i === 0 ? 'is-active' : ''; ?>"
                                aria-label="<?php printf( esc_attr__( 'Go to slide %d', 'digitalstride' ), $i + 1 ); ?>"
                                data-slide="<?php echo $i; ?>"></button>
                    <?php endforeach; ?>
                </div>
                <button class="ds-hero__carousel-btn ds-hero__carousel-btn--next" aria-label="<?php esc_attr_e( 'Next slide', 'digitalstride' ); ?>">&#10095;</button>
            </div>
        <?php endif; ?>
    </div>
    <?php
}
