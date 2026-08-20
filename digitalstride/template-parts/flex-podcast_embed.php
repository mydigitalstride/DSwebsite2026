<?php
/**
 * Flex Layout: Podcast Embed
 * Embeds one or more podcast episodes/shows from Spotify, Apple Podcasts or
 * another host. The URL is resolved to a player by ds_podcast_player().
 */
$heading = get_sub_field('heading');
$intro   = get_sub_field('intro');
$size    = get_sub_field('player_size') ?: 'standard';
$cols    = (int) (get_sub_field('columns') ?: 1);
$cta     = get_sub_field('cta_button');
$compact = ($size === 'compact');

if (!have_rows('episodes') && !$heading && !$intro) return;
?>

<section class="ds-section ds-section--podcast">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($intro) : ?>
            <div class="ds-section__intro"><?php echo wp_kses_post($intro); ?></div>
        <?php endif; ?>

        <?php if (have_rows('episodes')) : ?>
            <div class="ds-podcasts ds-podcasts--cols-<?php echo esc_attr($cols); ?> <?php echo $compact ? 'ds-podcasts--compact' : ''; ?>">
                <?php while (have_rows('episodes')) : the_row();
                    $url   = get_sub_field('podcast_url');
                    $title = get_sub_field('episode_title');
                    $desc  = get_sub_field('description');
                    if (!$url) continue;
                    ?>
                    <div class="ds-podcast">
                        <?php if ($title) : ?>
                            <h3 class="ds-podcast__title"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>
                        <?php if ($desc) : ?>
                            <p class="ds-podcast__desc"><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>
                        <?php echo ds_podcast_player($url, ['title' => $title, 'compact' => $compact]); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if ($cta) : ?>
            <div class="ds-section__cta">
                <a href="<?php echo esc_url($cta['url']); ?>"
                   class="ds-btn ds-btn--primary"
                   <?php echo !empty($cta['target']) ? 'target="' . esc_attr($cta['target']) . '" rel="noopener"' : ''; ?>>
                    <?php echo esc_html($cta['title']); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
