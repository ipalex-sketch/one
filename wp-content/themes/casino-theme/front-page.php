<?php get_header(); ?>
<section class="hero">
    <div class="container">
        <h1>Лучшие казино с бездепозитными бонусами</h1>
        <p>Сравнивайте казино по рейтингу, бонусам и ключевым характеристикам. Мы собрали минималистичный и честный рейтинг с удобными фильтрами.</p>
    </div>
</section>

<section class="container">
    <h2 class="section-title">Топ казино</h2>
    <div class="casino-grid">
        <?php
        $top_query = new WP_Query([
            'post_type' => 'casino',
            'posts_per_page' => 6,
        ]);
        if ($top_query->have_posts()) :
            while ($top_query->have_posts()) : $top_query->the_post();
                get_template_part('template-parts/casino-card');
            endwhile;
        else :
            echo '<p>Добавьте казино в админке.</p>';
        endif;
        wp_reset_postdata();
        ?>
    </div>
</section>

<section class="container">
    <h2 class="section-title">Как мы оцениваем казино</h2>
    <p>Мы учитываем лицензии, провайдеров, выплаты, бонусы и репутацию бренда. Все критерии прозрачны и обновляются регулярно.</p>
</section>

<section class="container">
    <div class="layout">
        <div>
            <h2 class="section-title">Последние обзоры</h2>
            <div class="casino-grid">
                <?php
                $reviews_query = new WP_Query([
                    'post_type' => 'casino',
                    'posts_per_page' => 3,
                ]);
                if ($reviews_query->have_posts()) :
                    while ($reviews_query->have_posts()) : $reviews_query->the_post();
                        get_template_part('template-parts/casino-card');
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <aside class="sidebar">
            <?php get_template_part('template-parts/author-box', null, ['compact' => true]); ?>
        </aside>
    </div>
</section>

<section class="container">
    <div class="legal-box">
        <h2 class="section-title">Юридическая информация</h2>
        <p>Сайт носит информационный характер. Пожалуйста, играйте ответственно и соблюдайте законодательство вашей страны.</p>
    </div>
</section>
<?php get_footer(); ?>
