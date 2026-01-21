<?php
/**
 * Plugin Name: Casino Core
 * Description: Registers casino post type, taxonomies, meta fields, and archive filters.
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

function casino_core_register_post_type() {
    register_post_type('casino', [
        'labels' => [
            'name' => 'Казино',
            'singular_name' => 'Казино',
            'add_new_item' => 'Добавить казино',
            'edit_item' => 'Редактировать казино',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-awards',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        'rewrite' => ['slug' => 'casinos'],
        'show_in_rest' => true,
    ]);

    register_post_type('bonus', [
        'labels' => [
            'name' => 'Бонусы',
            'singular_name' => 'Бонус',
            'add_new_item' => 'Добавить бонус',
            'edit_item' => 'Редактировать бонус',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-tickets-alt',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        'rewrite' => ['slug' => 'bonuses'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'casino_core_register_post_type');

function casino_core_register_taxonomies() {
    register_taxonomy('casino_menu', 'casino', [
        'label' => 'Меню казино',
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);

    register_taxonomy('casino_feature', 'casino', [
        'label' => 'Фильтры казино',
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);

    register_taxonomy('casino_license', 'casino', [
        'label' => 'Лицензии',
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);

    register_taxonomy('casino_provider', 'casino', [
        'label' => 'Игровые провайдеры',
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);

    register_taxonomy('casino_payment', 'casino', [
        'label' => 'Платежные методы',
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);

    register_taxonomy('casino_currency', 'casino', [
        'label' => 'Валюты',
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);

    register_taxonomy('casino_country', 'casino', [
        'label' => 'Страны',
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);

    register_taxonomy('bonus_menu', 'bonus', [
        'label' => 'Меню бонусов',
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);
}
add_action('init', 'casino_core_register_taxonomies');

function casino_core_register_menu_terms() {
    $casino_terms = [
        'Рейтинг казино',
        'Топ казино',
        'Новые казино',
        'Мобильные казино',
        'Казино с лицензией',
        'Черный список казино',
        'Для хайроллеров',
        'С минимальным депозитом',
    ];
    foreach ($casino_terms as $term_name) {
        if (!term_exists($term_name, 'casino_menu')) {
            wp_insert_term($term_name, 'casino_menu');
        }
    }

    $bonus_terms = [
        'Приветственные бонусы',
        'Фриспины',
        'Депозитные бонусы',
        'Бездепозитные бонусы',
        'HighRoller бонусы',
        'Кешбэк бонусы',
        'Reload бонусы',
        'Бонусы на день рождения',
        'Эксклюзивные бонусы',
    ];
    foreach ($bonus_terms as $term_name) {
        if (!term_exists($term_name, 'bonus_menu')) {
            wp_insert_term($term_name, 'bonus_menu');
        }
    }
}

function casino_core_render_term_seo_field($taxonomy) {
    ?>
    <div class="form-field term-seo-text-wrap">
        <label for="term_seo_text">SEO текст</label>
        <textarea name="term_seo_text" id="term_seo_text" rows="5"></textarea>
        <p class="description">Добавьте SEO текст для страницы тега.</p>
    </div>
    <?php
}

function casino_core_render_term_seo_field_edit($term) {
    $seo_text = get_term_meta($term->term_id, 'term_seo_text', true);
    ?>
    <tr class="form-field term-seo-text-wrap">
        <th scope="row"><label for="term_seo_text">SEO текст</label></th>
        <td>
            <textarea name="term_seo_text" id="term_seo_text" rows="5"><?php echo esc_textarea($seo_text); ?></textarea>
            <p class="description">Добавьте SEO текст для страницы тега.</p>
        </td>
    </tr>
    <?php
}

function casino_core_save_term_seo_text($term_id) {
    if (isset($_POST['term_seo_text'])) {
        update_term_meta($term_id, 'term_seo_text', wp_kses_post($_POST['term_seo_text']));
    }
}

add_action('casino_menu_add_form_fields', 'casino_core_render_term_seo_field');
add_action('casino_menu_edit_form_fields', 'casino_core_render_term_seo_field_edit');
add_action('created_casino_menu', 'casino_core_save_term_seo_text');
add_action('edited_casino_menu', 'casino_core_save_term_seo_text');

add_action('bonus_menu_add_form_fields', 'casino_core_render_term_seo_field');
add_action('bonus_menu_edit_form_fields', 'casino_core_render_term_seo_field_edit');
add_action('created_bonus_menu', 'casino_core_save_term_seo_text');
add_action('edited_bonus_menu', 'casino_core_save_term_seo_text');

function casino_core_register_meta_boxes() {
    add_meta_box(
        'casino_details',
        'Данные казино',
        'casino_core_render_details_metabox',
        'casino',
        'normal',
        'high'
    );

    add_meta_box(
        'casino_bonus',
        'Бонусы',
        'casino_core_render_bonus_metabox',
        'casino',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'casino_core_register_meta_boxes');

function casino_core_render_details_metabox($post) {
    wp_nonce_field('casino_core_save_meta', 'casino_core_meta_nonce');

    $rating = get_post_meta($post->ID, '_casino_rating', true);
    $min_deposit = get_post_meta($post->ID, '_casino_min_deposit', true);
    $min_withdrawal = get_post_meta($post->ID, '_casino_min_withdrawal', true);
    $payout_time = get_post_meta($post->ID, '_casino_payout_time', true);
    $has_app = get_post_meta($post->ID, '_casino_has_app', true);
    ?>
    <p>
        <label>Рейтинг (0-5)</label><br>
        <input type="number" name="casino_rating" min="0" max="5" step="0.1" value="<?php echo esc_attr($rating); ?>" />
    </p>
    <p>
        <label>Минимальный депозит</label><br>
        <input type="number" name="casino_min_deposit" value="<?php echo esc_attr($min_deposit); ?>" />
    </p>
    <p>
        <label>Минимальный вывод</label><br>
        <input type="number" name="casino_min_withdrawal" value="<?php echo esc_attr($min_withdrawal); ?>" />
    </p>
    <p>
        <label>Срок вывода</label><br>
        <input type="text" name="casino_payout_time" value="<?php echo esc_attr($payout_time); ?>" />
    </p>
    <p>
        <label>
            <input type="checkbox" name="casino_has_app" value="1" <?php checked($has_app, '1'); ?> />
            Есть приложение
        </label>
    </p>
    <?php
}

function casino_core_render_bonus_metabox($post) {
    $registration_bonus = get_post_meta($post->ID, '_casino_bonus_registration', true);
    $nodeposit_bonus = get_post_meta($post->ID, '_casino_bonus_nodeposit', true);
    $bonus_amount = get_post_meta($post->ID, '_casino_bonus_amount', true);
    $bonus_fs = get_post_meta($post->ID, '_casino_bonus_fs', true);
    $bonus_wager = get_post_meta($post->ID, '_casino_bonus_wager', true);
    $bonus_max_withdrawal = get_post_meta($post->ID, '_casino_bonus_max_withdrawal', true);
    $bonus_promocode = get_post_meta($post->ID, '_casino_bonus_promocode', true);
    $bonus_games = get_post_meta($post->ID, '_casino_bonus_games', true);
    ?>
    <p>
        <label>
            <input type="checkbox" name="casino_bonus_registration" value="1" <?php checked($registration_bonus, '1'); ?> />
            Есть бонус за регистрацию
        </label>
    </p>
    <p>
        <label>
            <input type="checkbox" name="casino_bonus_nodeposit" value="1" <?php checked($nodeposit_bonus, '1'); ?> />
            Есть бездепозитный бонус
        </label>
    </p>
    <p>
        <label>Сумма бонуса</label><br>
        <input type="text" name="casino_bonus_amount" value="<?php echo esc_attr($bonus_amount); ?>" />
    </p>
    <p>
        <label>FS</label><br>
        <input type="text" name="casino_bonus_fs" value="<?php echo esc_attr($bonus_fs); ?>" />
    </p>
    <p>
        <label>Вейджер</label><br>
        <input type="text" name="casino_bonus_wager" value="<?php echo esc_attr($bonus_wager); ?>" />
    </p>
    <p>
        <label>Макс вывод</label><br>
        <input type="text" name="casino_bonus_max_withdrawal" value="<?php echo esc_attr($bonus_max_withdrawal); ?>" />
    </p>
    <p>
        <label>Промокод</label><br>
        <input type="text" name="casino_bonus_promocode" value="<?php echo esc_attr($bonus_promocode); ?>" />
    </p>
    <p>
        <label>Игры</label><br>
        <input type="text" name="casino_bonus_games" value="<?php echo esc_attr($bonus_games); ?>" />
    </p>
    <?php
}

function casino_core_save_meta($post_id) {
    if (!isset($_POST['casino_core_meta_nonce']) || !wp_verify_nonce($_POST['casino_core_meta_nonce'], 'casino_core_save_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        'casino_rating' => '_casino_rating',
        'casino_min_deposit' => '_casino_min_deposit',
        'casino_min_withdrawal' => '_casino_min_withdrawal',
        'casino_payout_time' => '_casino_payout_time',
        'casino_bonus_amount' => '_casino_bonus_amount',
        'casino_bonus_fs' => '_casino_bonus_fs',
        'casino_bonus_wager' => '_casino_bonus_wager',
        'casino_bonus_max_withdrawal' => '_casino_bonus_max_withdrawal',
        'casino_bonus_promocode' => '_casino_bonus_promocode',
        'casino_bonus_games' => '_casino_bonus_games',
    ];

    foreach ($fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
        }
    }

    update_post_meta($post_id, '_casino_has_app', isset($_POST['casino_has_app']) ? '1' : '0');
    update_post_meta($post_id, '_casino_bonus_registration', isset($_POST['casino_bonus_registration']) ? '1' : '0');
    update_post_meta($post_id, '_casino_bonus_nodeposit', isset($_POST['casino_bonus_nodeposit']) ? '1' : '0');
}
add_action('save_post_casino', 'casino_core_save_meta');

function casino_core_filter_archive_query($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('casino')) {
        $meta_query = [];

        if (!empty($_GET['min_deposit'])) {
            $meta_query[] = [
                'key' => '_casino_min_deposit',
                'value' => (float) $_GET['min_deposit'],
                'type' => 'NUMERIC',
                'compare' => '<=',
            ];
        }

        if (!empty($_GET['rating'])) {
            $meta_query[] = [
                'key' => '_casino_rating',
                'value' => (float) $_GET['rating'],
                'type' => 'NUMERIC',
                'compare' => '>=',
            ];
        }

        if (!empty($_GET['has_app'])) {
            $meta_query[] = [
                'key' => '_casino_has_app',
                'value' => '1',
                'compare' => '=',
            ];
        }

        if ($meta_query) {
            $query->set('meta_query', $meta_query);
        }

        $tax_query = [];
        $tax_filters = [
            'casino_feature',
            'casino_license',
            'casino_provider',
            'casino_payment',
            'casino_currency',
            'casino_country',
        ];

        foreach ($tax_filters as $taxonomy) {
            if (!empty($_GET[$taxonomy])) {
                $tax_query[] = [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => array_map('sanitize_title', (array) $_GET[$taxonomy]),
                ];
            }
        }

        if ($tax_query) {
            $query->set('tax_query', $tax_query);
        }
    }
}
add_action('pre_get_posts', 'casino_core_filter_archive_query');

function casino_core_activate_plugin() {
    casino_core_register_post_type();
    casino_core_register_taxonomies();
    casino_core_register_menu_terms();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'casino_core_activate_plugin');

function casino_core_deactivate_plugin() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'casino_core_deactivate_plugin');
