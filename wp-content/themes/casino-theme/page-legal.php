<?php
/**
 * Template Name: Legal Content Page
 */
get_header();
?>
<section class="container hero">
    <h1><?php the_title(); ?></h1>
    <p><?php the_excerpt(); ?></p>
</section>

<section class="container">
    <h2 class="section-title">Общие положения</h2>
    <p>Сайт предоставляет информационные материалы о казино, бонусах и игровых брендах. Мы не принимаем ставки и не обрабатываем платежи.</p>
</section>

<section class="container">
    <h2 class="section-title">Ответственная игра</h2>
    <p>Играйте только на средства, которые готовы потерять. Ознакомьтесь с лимитами и инструментами самоконтроля у выбранного оператора.</p>
</section>

<section class="container">
    <h2 class="section-title">Рекламные материалы</h2>
    <ul>
        <li>Мы можем получать комиссию за переходы по партнёрским ссылкам.</li>
        <li>Условия бонусов могут отличаться для разных стран и валют.</li>
        <li>Перед регистрацией проверяйте актуальные правила на сайте оператора.</li>
    </ul>
</section>

<section class="container">
    <div class="legal-box">
        <h2 class="section-title">Политика конфиденциальности</h2>
        <p>Мы используем аналитические инструменты для улучшения качества сервиса. Персональные данные обрабатываются в соответствии с локальным законодательством.</p>
    </div>
</section>

<section class="container" style="margin-top: 32px;">
    <?php get_template_part('template-parts/author-box'); ?>
</section>
<?php get_footer(); ?>
