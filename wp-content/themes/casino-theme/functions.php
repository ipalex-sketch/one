<?php

if (!defined('ABSPATH')) {
    exit;
}

function casino_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'casino_theme_setup');

function casino_enqueue_assets() {
    wp_enqueue_style('casino-style', get_stylesheet_uri(), [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'casino_enqueue_assets');
