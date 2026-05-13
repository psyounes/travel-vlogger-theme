<?php
/**
 * Travel Vlogger Theme Functions
 */

// Version du thème
define('TRAVEL_VLOGGER_VERSION', '1.0.0');
define('TRAVEL_VLOGGER_THEME_DIR', get_template_directory());
define('TRAVEL_VLOGGER_THEME_URI', get_template_directory_uri());

/**
 * Configuration initiale du thème
 */
function travel_vlogger_setup() {
    // Support des langues
    load_theme_textdomain('travel-vlogger', TRAVEL_VLOGGER_THEME_DIR . '/languages');

    // Support des fonctionnalités
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');

    // Enregistrement des menus
    register_nav_menus(array(
        'primary' => esc_html__('Menu Principal', 'travel-vlogger'),
        'footer'  => esc_html__('Menu Pied de Page', 'travel-vlogger'),
    ));

    // Tailles d'images
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
    wp_enqueue_style('travel-vlogger-customizer', TRAVEL_VLOGGER_THEME_URI . '/css/customizer.css', array(), TRAVEL_VLOGGER_VERSION);

    // Scripts
    wp_enqueue_script('travel-vlogger-main', TRAVEL_VLOGGER_THEME_URI . '/js/main.js', array(), TRAVEL_VLOGGER_VERSION, true);
    wp_enqueue_script('travel-vlogger-navigation', TRAVEL_VLOGGER_THEME_URI . '/js/navigation.js', array(), TRAVEL_VLOGGER_VERSION, true);

    // Localisation pour JS
    wp_localize_script('travel-vlogger-main', 'travelVloggerData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('travel_vlogger_nonce'),
    ));

    // Comment Reply Script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'travel_vlogger_scripts');

/**
 * Customizer WordPress
 */
require_once TRAVEL_VLOGGER_THEME_DIR . '/inc/customizer.php';

/**
 * Widgets Elementor personnalisés
 */
require_once TRAVEL_VLOGGER_THEME_DIR . '/inc/elementor-widgets.php';

/**
 * Template Tags
 */
require_once TRAVEL_VLOGGER_THEME_DIR . '/inc/template-tags.php';

/**
 * Sidebar / Widgets
 */
function travel_vlogger_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Barre latérale', 'travel-vlogger'),
        'id'            => 'primary-sidebar',
        'description'   => esc_html__('Zone de widgets principale', 'travel-vlogger'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Pied de page', 'travel-vlogger'),
        'id'            => 'footer-sidebar',
        'description'   => esc_html__('Zone de widgets du pied de page', 'travel-vlogger'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'travel_vlogger_widgets_init');

/**
 * Support Elementor
 */
add_theme_support('elementor');

/**
 * Hooks Elementor
 */
function travel_vlogger_elementor_localize() {
    if (defined('ELEMENTOR_VERSION')) {
        wp_enqueue_style('travel-vlogger-elementor', TRAVEL_VLOGGER_THEME_URI . '/css/elementor-integration.css', array(), TRAVEL_VLOGGER_VERSION);
    }
}
add_action('wp_enqueue_scripts', 'travel_vlogger_elementor_localize');

?>