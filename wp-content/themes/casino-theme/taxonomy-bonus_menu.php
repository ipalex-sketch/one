<?php get_header(); ?>
<?php $term = get_queried_object(); ?>
<section class="container hero">
    <h1><?php echo esc_html($term->name); ?></h1>
    <p><?php echo esc_html($term->description ?: 'Подборка бонусов по выбранному пункту меню.'); ?></p>
</section>

<section class="container">
    <div class="filters">
        <?php
        $menu_terms = get_terms([
            'taxonomy' => 'bonus_menu',
            'hide_empty' => false,
        ]);
        if (!empty($menu_terms) && !is_wp_error($menu_terms)) :
            foreach ($menu_terms as $menu_term) :
                $is_active = ($term->term_id === $menu_term->term_id);
                ?>
                <a class="filter-chip <?php echo $is_active ? 'filter-chip--active' : ''; ?>" href="<?php echo esc_url(get_term_link($menu_term)); ?>">
                    <?php echo esc_html($menu_term->name); ?>
                </a>
            <?php endforeach; ?>
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
            <p>Бонусы не найдены.</p>
        <?php endif; ?>
    </div>
</section>

<?php $seo_text = trim((string) get_term_meta($term->term_id, 'term_seo_text', true)); ?>
<?php if ($seo_text !== '') : ?>
    <section class="container">
        <div class="legal-box">
            <h2 class="section-title">SEO текст</h2>
            <div>
                <?php echo wp_kses_post($seo_text); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php get_footer(); ?>
