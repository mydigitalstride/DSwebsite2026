<?php
/**
 * Partial: Article Card
 * Featured image with category pill overlay, title, 30-word excerpt,
 * read more button + date pinned to the bottom of the card.
 */
$categories   = get_the_category();
$category     = $categories ? $categories[0] : null;
$fallback_img = get_template_directory_uri() . '/assets/img/fallback-article.svg';
?>
<article class="ds-article-card">

    <!-- Image + category pill -->
    <div class="ds-article-card__image">
        <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('card-thumb', ['class' => 'ds-article-card__img']); ?>
            <?php else : ?>
                <img class="ds-article-card__img" src="<?php echo esc_url($fallback_img); ?>" alt="">
            <?php endif; ?>
        </a>
        <?php if ($category) : ?>
            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
               class="ds-article-card__category">
                <?php echo esc_html($category->name); ?>
            </a>
        <?php endif; ?>
    </div>

    <!-- Card body: title + excerpt grow; footer sticks to bottom -->
    <div class="ds-article-card__body">
        <div class="ds-article-card__top">
            <h3 class="ds-article-card__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <p class="ds-article-card__excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
            </p>
        </div>
        <div class="ds-article-card__footer">
            <a href="<?php the_permalink(); ?>" class="ds-article-card__readmore">
                Read More <i class="fa-solid fa-arrow-right"></i>
            </a>
            <time class="ds-article-card__date" datetime="<?php echo get_the_date('c'); ?>">
                <i class="fa-regular fa-calendar"></i>
                <?php echo get_the_date('F j, Y'); ?>
            </time>
        </div>
    </div>

</article>
