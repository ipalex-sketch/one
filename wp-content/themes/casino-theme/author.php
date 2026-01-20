<?php get_header(); ?>
<?php
$author_id = get_queried_object_id();
$author_name = get_the_author_meta('display_name', $author_id);
$author_description = get_the_author_meta('description', $author_id);
?>
<section class="container hero">
    <h1>Автор: <?php echo esc_html($author_name ?: 'Редактор'); ?></h1>
    <p><?php echo esc_html($author_description ?: 'Пишет обзоры, проверяет бонусы и обновляет рейтинги казино.'); ?></p>
</section>

<section class="container author-profile">
    <?php get_template_part('template-parts/author-box'); ?>

    <div class="author-posts">
        <h2 class="section-title">Последние статьи автора</h2>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="author-posts__item">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="author-posts__meta"><?php echo esc_html(get_the_date()); ?></div>
                    <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                    <a class="button button--ghost" href="<?php the_permalink(); ?>">Читать</a>
                </article>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p>У автора пока нет опубликованных материалов.</p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
