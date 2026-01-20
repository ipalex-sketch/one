<?php get_header(); ?>
<section class="container hero">
    <h1>Рейтинг казино</h1>
    <p>Фильтруйте список казино по ключевым характеристикам и выбирайте лучшие предложения.</p>
</section>

<form method="get">
    <section class="container">
        <div class="filters-toolbar">
            <div class="filters-meta">Найдено казино: <?php echo esc_html($wp_query->found_posts); ?></div>
            <div class="filters-actions">
                <button class="button button--primary mobile-filters-toggle" type="button" data-filters-toggle>Фильтры</button>
                <a class="button button--ghost" href="<?php echo esc_url(get_post_type_archive_link('casino')); ?>">Сбросить фильтры</a>
            </div>
        </div>
        <div class="filters">
            <?php
            $feature_terms = get_terms([
                'taxonomy' => 'casino_feature',
                'hide_empty' => false,
            ]);
            $selected_features = isset($_GET['casino_feature']) ? (array) $_GET['casino_feature'] : [];
            if (!empty($feature_terms) && !is_wp_error($feature_terms)) :
                foreach ($feature_terms as $term) :
                    $is_active = in_array($term->slug, $selected_features, true);
                    ?>
                    <label class="filter-chip <?php echo $is_active ? 'filter-chip--active' : ''; ?>">
                        <input type="checkbox" name="casino_feature[]" value="<?php echo esc_attr($term->slug); ?>" <?php checked($is_active); ?> />
                        <?php echo esc_html($term->name); ?>
                    </label>
                <?php endforeach; ?>
            <?php else : ?>
                <span class="filter-chip">Добавьте теги фильтров в админке</span>
            <?php endif; ?>
        </div>
    </section>

    <section class="container layout">
        <div>
            <div class="casino-grid">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('template-parts/casino-card'); ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>Нет результатов. Попробуйте изменить фильтры.</p>
                <?php endif; ?>
            </div>

            <div class="section-title">Навигация</div>
            <?php the_posts_pagination(); ?>
        </div>

        <aside class="sidebar">
            <button class="sidebar__close" type="button" aria-label="Закрыть фильтры" data-filters-close-btn>×</button>
            <h3>Характеристики</h3>
            <div class="filter-group">
                <label>Рейтинг (от)</label>
                <input type="number" name="rating" min="0" max="5" step="0.1" value="<?php echo isset($_GET['rating']) ? esc_attr($_GET['rating']) : ''; ?>" />
            </div>
            <div class="filter-group">
                <label>Минимум депозит (до)</label>
                <input type="number" name="min_deposit" value="<?php echo isset($_GET['min_deposit']) ? esc_attr($_GET['min_deposit']) : ''; ?>" />
            </div>
            <div class="filter-group">
                <label>
                    <input type="checkbox" name="has_app" value="1" <?php checked(isset($_GET['has_app'])); ?> />
                    Приложение
                </label>
            </div>
            <?php
            $taxonomies = [
                'casino_license' => 'Лицензия',
                'casino_provider' => 'Игровой провайдер',
                'casino_payment' => 'Платежный метод',
                'casino_currency' => 'Валюта',
                'casino_country' => 'Страна',
            ];
            foreach ($taxonomies as $taxonomy => $label) :
                $terms = get_terms([
                    'taxonomy' => $taxonomy,
                    'hide_empty' => false,
                ]);
                $selected_terms = isset($_GET[$taxonomy]) ? (array) $_GET[$taxonomy] : [];
                if (!empty($terms) && !is_wp_error($terms)) :
                    ?>
                    <div class="filter-group">
                        <strong><?php echo esc_html($label); ?></strong>
                        <?php foreach ($terms as $term) : ?>
                            <label>
                                <input type="checkbox" name="<?php echo esc_attr($taxonomy); ?>[]" value="<?php echo esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $selected_terms, true)); ?> />
                                <?php echo esc_html($term->name); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <button class="button button--primary" type="submit">Применить</button>
        </aside>
    </section>
</form>
<div class="filters-backdrop" data-filters-close></div>
<?php get_footer(); ?>
