<?php get_header(); ?>
<?php
$rating = get_post_meta(get_the_ID(), '_casino_rating', true);
$min_deposit = get_post_meta(get_the_ID(), '_casino_min_deposit', true);
$min_withdrawal = get_post_meta(get_the_ID(), '_casino_min_withdrawal', true);
$payout_time = get_post_meta(get_the_ID(), '_casino_payout_time', true);
$has_app = get_post_meta(get_the_ID(), '_casino_has_app', true);
$bonus_amount = get_post_meta(get_the_ID(), '_casino_bonus_amount', true);
$bonus_fs = get_post_meta(get_the_ID(), '_casino_bonus_fs', true);
$bonus_wager = get_post_meta(get_the_ID(), '_casino_bonus_wager', true);
$bonus_max_withdrawal = get_post_meta(get_the_ID(), '_casino_bonus_max_withdrawal', true);
$bonus_promocode = get_post_meta(get_the_ID(), '_casino_bonus_promocode', true);
$bonus_games = get_post_meta(get_the_ID(), '_casino_bonus_games', true);
?>

<section class="container hero">
    <h1><?php the_title(); ?></h1>
    <p><?php the_excerpt(); ?></p>
</section>

<section class="container layout">
    <div>
        <div class="casino-card">
            <h2>Бонусы</h2>
            <div class="casino-card__details">
                <div>Сумма: <?php echo esc_html($bonus_amount ?: '—'); ?></div>
                <div>FS: <?php echo esc_html($bonus_fs ?: '—'); ?></div>
                <div>Вейджер: <?php echo esc_html($bonus_wager ?: '—'); ?></div>
                <div>Макс вывод: <?php echo esc_html($bonus_max_withdrawal ?: '—'); ?></div>
                <div>Промокод: <?php echo esc_html($bonus_promocode ?: '—'); ?></div>
                <div>Игры: <?php echo esc_html($bonus_games ?: '—'); ?></div>
            </div>
            <div class="casino-card__actions">
                <a class="button button--primary" href="#">Получить бонус</a>
            </div>
        </div>

        <div class="author-box" style="margin-top: 20px;">
            <h2>Обзор</h2>
            <?php the_content(); ?>
        </div>
    </div>

    <aside class="sidebar">
        <h3>Характеристики</h3>
        <label>Рейтинг: <?php echo esc_html($rating ?: '—'); ?>/5</label>
        <label>Мин. депозит: <?php echo esc_html($min_deposit ?: '—'); ?></label>
        <label>Мин. вывод: <?php echo esc_html($min_withdrawal ?: '—'); ?></label>
        <label>Срок вывода: <?php echo esc_html($payout_time ?: '—'); ?></label>
        <label>Приложение: <?php echo $has_app === '1' ? 'Есть' : 'Нет'; ?></label>
    </aside>
</section>

<section class="container">
    <div class="author-box">
        <h2>Автор</h2>
        <p><strong>Эксперт по бонусам</strong></p>
        <p>Пишет обзоры и следит за актуальностью рейтингов.</p>
        <a class="button button--ghost" href="#">Страница автора</a>
    </div>
</section>

<section class="container">
    <div class="legal-box">
        <h2>Юридическая информация</h2>
        <p>Сайт носит информационный характер. Играйте ответственно.</p>
    </div>
</section>
<?php get_footer(); ?>
