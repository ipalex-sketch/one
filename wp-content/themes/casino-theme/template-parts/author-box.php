<?php
$author_id = get_the_author_meta('ID');
$author_name = get_the_author_meta('display_name', $author_id);
$author_description = get_the_author_meta('description', $author_id);
$author_role = get_the_author_meta('role', $author_id);
$author_url = get_author_posts_url($author_id);
$compact = !empty($args['compact']);

if (!$author_name) {
    $author_name = 'Редактор обзора';
}
if (!$author_description) {
    $author_description = 'Пишет обзоры, проверяет бонусы и обновляет рейтинги казино.';
}
$classes = 'author-box' . ($compact ? ' author-box--compact' : '');
?>
<div class="<?php echo esc_attr($classes); ?>">
    <div class="author-box__header">
        <div class="author-box__avatar">
            <?php echo get_avatar($author_id ?: 0, 56); ?>
        </div>
        <div>
            <p class="author-box__name"><?php echo esc_html($author_name); ?></p>
            <?php if ($author_role) : ?>
                <div class="author-box__role"><?php echo esc_html($author_role); ?></div>
            <?php else : ?>
                <div class="author-box__role">Эксперт по бонусам</div>
            <?php endif; ?>
        </div>
    </div>
    <p class="author-box__bio"><?php echo esc_html($author_description); ?></p>
    <div class="author-box__links">
        <a class="button button--ghost" href="<?php echo esc_url($author_url); ?>">Страница автора</a>
    </div>
</div>
