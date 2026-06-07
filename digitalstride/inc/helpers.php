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
