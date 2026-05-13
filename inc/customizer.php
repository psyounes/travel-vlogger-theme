<?php
/**
 * Customizer Settings
 */

function travel_vlogger_customize_register($wp_customize) {
    
    // COULEURS
    $wp_customize->add_section('travel_vlogger_colors', array(
        'title'    => esc_html__('Couleurs', 'travel-vlogger'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('travel_vlogger_primary_color', array(
        'default'           => '#FF6B6B',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'travel_vlogger_primary_color', array(
        'label'       => esc_html__('Couleur Primaire', 'travel-vlogger'),
        'section'     => 'travel_vlogger_colors',
        'settings'    => 'travel_vlogger_primary_color',
    )));

    $wp_customize->add_setting('travel_vlogger_secondary_color', array(
        'default'           => '#4A90E2',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'travel_vlogger_secondary_color', array(
        'label'       => esc_html__('Couleur Secondaire', 'travel-vlogger'),
        'section'     => 'travel_vlogger_colors',
        'settings'    => 'travel_vlogger_secondary_color',
    )));

    $wp_customize->add_setting('travel_vlogger_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'travel_vlogger_text_color', array(
        'label'       => esc_html__('Couleur du Texte', 'travel-vlogger'),
        'section'     => 'travel_vlogger_colors',
        'settings'    => 'travel_vlogger_text_color',
    )));

    $wp_customize->add_setting('travel_vlogger_footer_bg', array(
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'travel_vlogger_footer_bg', array(
        'label'       => esc_html__('Fond du Pied de Page', 'travel-vlogger'),
        'section'     => 'travel_vlogger_colors',
        'settings'    => 'travel_vlogger_footer_bg',
    )));

    // TYPOGRAPHIE
    $wp_customize->add_section('travel_vlogger_typography', array(
        'title'    => esc_html__('Typographie', 'travel-vlogger'),
        'priority' => 31,
    ));

    $wp_customize->add_setting('travel_vlogger_heading_font', array(
        'default'           => 'system',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('travel_vlogger_heading_font', array(
        'label'       => esc_html__('Police des Titres', 'travel-vlogger'),
        'section'     => 'travel_vlogger_typography',
        'type'        => 'select',
        'choices'     => array(
            'system'   => 'Système',
            'georgia'  => 'Georgia',
            'times'    => 'Times New Roman',
            'garamond' => 'Garamond',
        ),
    ));

    $wp_customize->add_setting('travel_vlogger_h1_size', array(
        'default'           => '48',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('travel_vlogger_h1_size', array(
        'label'       => esc_html__('Taille H1 (px)', 'travel-vlogger'),
        'section'     => 'travel_vlogger_typography',
        'type'        => 'range',
        'input_attrs' => array('min' => 24, 'max' => 72, 'step' => 2),
    ));

    $wp_customize->add_setting('travel_vlogger_body_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('travel_vlogger_body_size', array(
        'label'       => esc_html__('Taille du Corps (px)', 'travel-vlogger'),
        'section'     => 'travel_vlogger_typography',
        'type'        => 'range',
        'input_attrs' => array('min' => 12, 'max' => 24, 'step' => 1),
    ));

    // EN-TÊTE
    $wp_customize->add_section('travel_vlogger_header', array(
        'title'    => esc_html__('En-tête', 'travel-vlogger'),
        'priority' => 32,
    ));

    $wp_customize->add_setting('travel_vlogger_header_style', array(
        'default'           => 'light',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('travel_vlogger_header_style', array(
        'label'       => esc_html__('Style de l\'En-tête', 'travel-vlogger'),
        'section'     => 'travel_vlogger_header',
        'type'        => 'radio',
        'choices'     => array(
            'light'   => esc_html__('Clair', 'travel-vlogger'),
            'dark'    => esc_html__('Sombre', 'travel-vlogger'),
            'colored' => esc_html__('Coloré', 'travel-vlogger'),
        ),
    ));

    $wp_customize->add_setting('travel_vlogger_header_height', array(
        'default'           => '80',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('travel_vlogger_header_height', array(
        'label'       => esc_html__('Hauteur de l\'En-tête (px)', 'travel-vlogger'),
        'section'     => 'travel_vlogger_header',
        'type'        => 'range',
        'input_attrs' => array('min' => 60, 'max' => 150, 'step' => 5),
    ));

    // LAYOUT
    $wp_customize->add_section('travel_vlogger_layout', array(
        'title'    => esc_html__('Mise en Page', 'travel-vlogger'),
        'priority' => 33,
    ));

    $wp_customize->add_setting('travel_vlogger_content_width', array(
        'default'           => 'full',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('travel_vlogger_content_width', array(
        'label'       => esc_html__('Largeur du Contenu', 'travel-vlogger'),
        'section'     => 'travel_vlogger_layout',
        'type'        => 'radio',
        'choices'     => array(
            'full'      => esc_html__('Pleine Largeur', 'travel-vlogger'),
            'container' => esc_html__('Conteneur', 'travel-vlogger'),
        ),
    ));

    $wp_customize->add_setting('travel_vlogger_show_sidebar', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('travel_vlogger_show_sidebar', array(
        'label'       => esc_html__('Afficher la Barre Latérale', 'travel-vlogger'),
        'section'     => 'travel_vlogger_layout',
        'type'        => 'checkbox',
    ));

    // BLOG
    $wp_customize->add_section('travel_vlogger_blog', array(
        'title'    => esc_html__('Blog', 'travel-vlogger'),
        'priority' => 34,
    ));

    $wp_customize->add_setting('travel_vlogger_posts_per_page', array(
        'default'           => 9,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('travel_vlogger_posts_per_page', array(
        'label'       => esc_html__('Articles par Page', 'travel-vlogger'),
        'section'     => 'travel_vlogger_blog',
        'type'        => 'number',
    ));

    $wp_customize->add_setting('travel_vlogger_grid_columns', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('travel_vlogger_grid_columns', array(
        'label'       => esc_html__('Colonnes de la Grille', 'travel-vlogger'),
        'section'     => 'travel_vlogger_blog',
        'type'        => 'range',
        'input_attrs' => array('min' => 1, 'max' => 4, 'step' => 1),
    ));

    $wp_customize->add_setting('travel_vlogger_show_excerpt', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('travel_vlogger_show_excerpt', array(
        'label'       => esc_html__('Afficher l\'Extrait', 'travel-vlogger'),
        'section'     => 'travel_vlogger_blog',
        'type'        => 'checkbox',
    ));

    // PIED DE PAGE
    $wp_customize->add_section('travel_vlogger_footer_section', array(
        'title'    => esc_html__('Pied de Page', 'travel-vlogger'),
        'priority' => 35,
    ));

    $wp_customize->add_setting('travel_vlogger_copyright_text', array(
        'default'           => '&copy; 2026 Travel Vlogger. Tous droits réservés.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('travel_vlogger_copyright_text', array(
        'label'       => esc_html__('Texte du Copyright', 'travel-vlogger'),
        'section'     => 'travel_vlogger_footer_section',
        'type'        => 'textarea',
    ));

    $wp_customize->add_setting('travel_vlogger_show_footer_widgets', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('travel_vlogger_show_footer_widgets', array(
        'label'       => esc_html__('Afficher les Widgets du Pied de Page', 'travel-vlogger'),
        'section'     => 'travel_vlogger_footer_section',
        'type'        => 'checkbox',
    ));

    // RÉSEAUX SOCIAUX
    $wp_customize->add_section('travel_vlogger_social', array(
        'title'    => esc_html__('Réseaux Sociaux', 'travel-vlogger'),
        'priority' => 36,
    ));

    $social_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'linkedin');
    foreach ($social_networks as $network) {
        $wp_customize->add_setting('travel_vlogger_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        ));

        $wp_customize->add_control('travel_vlogger_' . $network, array(
            'label'       => ucfirst($network),
            'section'     => 'travel_vlogger_social',
            'type'        => 'url',
        ));
    }
}
add_action('customize_register', 'travel_vlogger_customize_register');

/**
 * CSS dynamique
 */
function travel_vlogger_customizer_css() {
    $primary_color = get_theme_mod('travel_vlogger_primary_color', '#FF6B6B');
    $secondary_color = get_theme_mod('travel_vlogger_secondary_color', '#4A90E2');
    $text_color = get_theme_mod('travel_vlogger_text_color', '#333333');
    $footer_bg = get_theme_mod('travel_vlogger_footer_bg', '#1a1a1a');
    $h1_size = get_theme_mod('travel_vlogger_h1_size', 48);
    $body_size = get_theme_mod('travel_vlogger_body_size', 16);
    $grid_columns = get_theme_mod('travel_vlogger_grid_columns', 3);
    
    $css = "
        :root {
            --tv-primary-color: {$primary_color};
            --tv-secondary-color: {$secondary_color};
            --tv-text-color: {$text_color};
            --tv-footer-bg: {$footer_bg};
        }
        body {
            color: {$text_color};
            font-size: {$body_size}px;
        }
        h1, .h1 {
            font-size: {$h1_size}px;
        }
        a {
            color: {$primary_color};
        }
        a:hover {
            color: {$secondary_color};
        }
        .site-footer {
            background-color: {$footer_bg};
        }
        .posts-grid {
            grid-template-columns: repeat({$grid_columns}, 1fr) !important;
        }
        .btn-primary {
            background-color: {$primary_color};
            color: #fff;
        }
        .btn-primary:hover {
            background-color: {$secondary_color};
        }
    ";

    wp_add_inline_style('travel-vlogger-customizer', $css);
}
add_action('wp_enqueue_scripts', 'travel_vlogger_customizer_css');

?>