<?php
/**
 * Travel Vlogger Theme Functions - MISE À JOUR
 */

// Version du thème
define('TRAVEL_VLOGGER_VERSION', '2.0.0');
define('TRAVEL_VLOGGER_THEME_DIR', get_template_directory());
define('TRAVEL_VLOGGER_THEME_URI', get_template_directory_uri());

/**
 * Configuration initiale du thème
 */
function travel_vlogger_setup() {
    load_theme_textdomain('travel-vlogger', TRAVEL_VLOGGER_THEME_DIR . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ));
    add_theme_support('custom-logo', array(
        'height' => 100, 'width' => 300, 'flex-height' => true, 'flex-width' => true,
    ));
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('elementor');

    register_nav_menus(array(
        'primary' => esc_html__('Menu Principal', 'travel-vlogger'),
        'footer' => esc_html__('Menu Pied de Page', 'travel-vlogger'),
    ));

    set_post_thumbnail_size(400, 300, true);
    add_image_size('travel-vlogger-featured', 1200, 600, true);
    add_image_size('travel-vlogger-grid', 400, 300, true);
}
add_action('after_setup_theme', 'travel_vlogger_setup');

/**
 * Chargement des styles et scripts
 */
function travel_vlogger_scripts() {
    // Styles
    wp_enqueue_style('travel-vlogger-style', TRAVEL_VLOGGER_THEME_URI . '/style.css', array(), TRAVEL_VLOGGER_VERSION);
    wp_enqueue_style('travel-vlogger-responsive', TRAVEL_VLOGGER_THEME_URI . '/css/responsive.css', array('travel-vlogger-style'), TRAVEL_VLOGGER_VERSION);

    // Scripts
    wp_enqueue_script('travel-vlogger-main', TRAVEL_VLOGGER_THEME_URI . '/js/main.js', array(), TRAVEL_VLOGGER_VERSION, true);
    wp_enqueue_script('travel-vlogger-navigation', TRAVEL_VLOGGER_THEME_URI . '/js/navigation.js', array(), TRAVEL_VLOGGER_VERSION, true);

    wp_localize_script('travel-vlogger-main', 'travelVloggerData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('travel_vlogger_nonce'),
    ));

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'travel_vlogger_scripts');

/**
 * Admin Panel
 */
require_once TRAVEL_VLOGGER_THEME_DIR . '/inc/admin-panel.php';

/**
 * Template Tags
 */
require_once TRAVEL_VLOGGER_THEME_DIR . '/inc/template-tags.php';

/**
 * Widgets
 */
function travel_vlogger_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Barre latérale', 'travel-vlogger'),
        'id' => 'primary-sidebar',
        'description' => esc_html__('Zone de widgets principale', 'travel-vlogger'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'travel_vlogger_widgets_init');

/**
 * Elementor Support - CORRIGÉ
 */
if (did_action('elementor/loaded')) {
    require_once TRAVEL_VLOGGER_THEME_DIR . '/inc/elementor-widgets.php';
}

/**
 * CSS dynamique basé sur les options du thème
 */
function travel_vlogger_dynamic_css() {
    $primary = get_option('travel_vlogger_primary_color', '#FF6B6B');
    $secondary = get_option('travel_vlogger_secondary_color', '#4A90E2');
    $text = get_option('travel_vlogger_text_color', '#333333');
    $footer_bg = get_option('travel_vlogger_footer_bg', '#1a1a1a');
    $grid_columns = get_option('travel_vlogger_grid_columns', 3);

    $css = "
        :root {
            --tv-primary-color: {$primary};
            --tv-secondary-color: {$secondary};
            --tv-text-color: {$text};
            --tv-footer-bg: {$footer_bg};
        }
        body {
            color: {$text};
        }
        a {
            color: {$primary};
        }
        a:hover {
            color: {$secondary};
        }
        .btn-primary {
            background-color: {$primary};
        }
        .btn-primary:hover {
            background-color: {$secondary};
        }
        .site-footer {
            background-color: {$footer_bg};
        }
        .posts-grid {
            grid-template-columns: repeat({$grid_columns}, 1fr) !important;
        }
        .main-navigation > li > a:hover {
            color: {$primary};
        }
    ";

    wp_register_style('travel-vlogger-dynamic', false);
    wp_enqueue_style('travel-vlogger-dynamic');
    wp_add_inline_style('travel-vlogger-dynamic', $css);
}
add_action('wp_enqueue_scripts', 'travel_vlogger_dynamic_css');

?>