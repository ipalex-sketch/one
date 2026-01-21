<article class="casino-card">
    <?php
    $bonus_terms = get_the_terms(get_the_ID(), 'bonus_menu');
    $bonus_label = (!empty($bonus_terms) && !is_wp_error($bonus_terms)) ? $bonus_terms[0]->name : '—';
    ?>
    <div class="casino-card__header">
        <div class="casino-card__logo">
            <?php echo esc_html(mb_substr(get_the_title(), 0, 1)); ?>
        </div>
        <div>
            <h3><?php the_title(); ?></h3>
            <div class="casino-card__rating">Категория: <?php echo esc_html($bonus_label); ?></div>
        </div>
    </div>
    <div class="casino-card__note">
        <?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?>
    </div>
    <div class="casino-card__actions">
        <a class="button button--primary" href="<?php the_permalink(); ?>">Подробнее</a>
    </div>
</article>
