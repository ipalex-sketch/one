<?php get_header(); ?>
<section class="container hero">
    <h1>Бонусы казино</h1>
    <p>Выбирайте бонусы по категориям и изучайте актуальные предложения.</p>
</section>

<section class="container">
    <div class="filters">
        <?php
        $menu_terms = get_terms([
            'taxonomy' => 'bonus_menu',
            'hide_empty' => false,
        ]);
        if (!empty($menu_terms) && !is_wp_error($menu_terms)) :
            foreach ($menu_terms as $term) :
                $is_active = is_tax('bonus_menu', $term->slug);
                ?>
                <a class="filter-chip <?php echo $is_active ? 'filter-chip--active' : ''; ?>" href="<?php echo esc_url(get_term_link($term)); ?>">
                    <?php echo esc_html($term->name); ?>
                </a>
            <?php endforeach; ?>
        <?php else : ?>
            <span class="filter-chip">Добавьте пункты меню бонусов</span>
        <?php endif; ?>
    </div>
</section>

<section class="container">
    <div class="casino-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/bonus-card'); ?>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p>Пока нет бонусов для отображения.</p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
