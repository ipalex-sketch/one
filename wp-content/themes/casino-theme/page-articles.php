<?php
/**
 * Template Name: Articles Page
 */
get_header();
?>
<section class="container hero">
    <h1><?php the_title(); ?></h1>
    <p><?php the_excerpt(); ?></p>
</section>

<section class="container">
    <h2 class="section-title">Последние статьи</h2>
    <div class="casino-grid">
        <?php
        $articles_query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 9,
        ]);
        if ($articles_query->have_posts()) :
            while ($articles_query->have_posts()) : $articles_query->the_post();
                ?>
                <article class="author-posts__item">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="author-posts__meta"><?php echo esc_html(get_the_date()); ?> · <?php the_author(); ?></div>
                    <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                    <a class="button button--ghost" href="<?php the_permalink(); ?>">Читать</a>
                </article>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p>Пока нет опубликованных статей.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>

<section class="container" style="margin-top: 32px;">
    <?php get_template_part('template-parts/author-box'); ?>
</section>
<?php get_footer(); ?>
