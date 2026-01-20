<?php
$rating = get_post_meta(get_the_ID(), '_casino_rating', true);
$min_deposit = get_post_meta(get_the_ID(), '_casino_min_deposit', true);
$bonus_registration = get_post_meta(get_the_ID(), '_casino_bonus_registration', true);
$bonus_nodeposit = get_post_meta(get_the_ID(), '_casino_bonus_nodeposit', true);
$bonus_promocode = get_post_meta(get_the_ID(), '_casino_bonus_promocode', true);
$currency_terms = get_the_terms(get_the_ID(), 'casino_currency');
$currency_label = $currency_terms && !is_wp_error($currency_terms) ? $currency_terms[0]->name : '—';
?>
<article class="casino-card">
    <div class="casino-card__header">
        <div class="casino-card__logo">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('thumbnail'); ?>
            <?php else : ?>
                <?php echo esc_html(mb_substr(get_the_title(), 0, 1)); ?>
            <?php endif; ?>
        </div>
        <div>
            <h3><?php the_title(); ?></h3>
            <div class="casino-card__rating">Рейтинг: <?php echo esc_html($rating ?: '—'); ?>/5</div>
        </div>
    </div>

    <div class="casino-card__badges">
        <?php if ($bonus_registration === '1') : ?>
            <span class="badge">Бонус за регистрацию</span>
        <?php endif; ?>
        <?php if ($bonus_nodeposit === '1') : ?>
            <span class="badge">Бездепозитный бонус</span>
        <?php endif; ?>
    </div>

    <div class="casino-card__details">
        <div>Мин. депозит: <?php echo esc_html($min_deposit ?: '—'); ?></div>
        <div>Валюта: <?php echo esc_html($currency_label); ?></div>
    </div>

    <?php if (!empty($bonus_promocode)) : ?>
        <div class="casino-card__promo">
            <span>Промокод: <?php echo esc_html($bonus_promocode); ?></span>
            <button type="button" data-copy="<?php echo esc_attr($bonus_promocode); ?>">Копировать</button>
        </div>
    <?php endif; ?>

    <input class="casino-card__note" type="text" placeholder="Введите текст для заметки" />

    <div class="casino-card__actions">
        <a class="button button--primary" href="<?php the_permalink(); ?>">Получить бонус</a>
        <a class="button button--ghost" href="<?php the_permalink(); ?>">Читать обзор</a>
    </div>
</article>
