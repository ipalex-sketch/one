<?php get_header(); ?>
<section class="container hero">
    <h1><?php bloginfo('name'); ?></h1>
    <p><?php bloginfo('description'); ?></p>
</section>
<section class="container">
    <?php get_template_part('template-parts/author-box'); ?>
</section>
<?php get_footer(); ?>
