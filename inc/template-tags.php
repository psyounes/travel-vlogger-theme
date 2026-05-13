<?php
/**
 * Template Tags
 */

function travel_vlogger_the_custom_logo() {
    if (function_exists('the_custom_logo')) {
        the_custom_logo();
    }
}

function travel_vlogger_the_site_title() {
    echo get_bloginfo('name');
}

function travel_vlogger_the_site_description() {
    echo get_bloginfo('description');
}

function travel_vlogger_primary_menu() {
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_class'     => 'main-navigation',
        'fallback_cb'    => 'wp_page_menu',
        'depth'          => 3,
    ));
}

function travel_vlogger_footer_menu() {
    wp_nav_menu(array(
        'theme_location' => 'footer',
        'menu_class'     => 'footer-menu',
        'fallback_cb'    => false,
        'depth'          => 1,
    ));
}

function travel_vlogger_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1\$s">%2\$s</time>';
    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date())
    );
    echo wp_kses_post($time_string);
}

function travel_vlogger_posted_by() {
    echo wp_kses_post(
        sprintf(
            esc_html__('par %s', 'travel-vlogger'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        )
    );
}

function travel_vlogger_posted_in() {
    $categories = get_the_category();
    if (!empty($categories)) {
        echo wp_kses_post(
            sprintf(
                esc_html__('Catégories: %s', 'travel-vlogger'),
                implode(', ', array_map(function($cat) {
                    return '<a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a>';
                }, $categories))
            )
        );
    }
}

function travel_vlogger_has_sidebar() {
    return get_theme_mod('travel_vlogger_show_sidebar', true);
}

function travel_vlogger_get_main_class() {
    $class = 'site-main';
    if (get_theme_mod('travel_vlogger_content_width') === 'full') {
        $class .= ' full-width';
    }
    return $class;
}

function travel_vlogger_social_links() {
    $networks = array('facebook', 'twitter', 'instagram', 'youtube', 'linkedin');
    $output = '';
    
    foreach ($networks as $network) {
        $url = get_theme_mod('travel_vlogger_' . $network);
        if ($url) {
            $output .= sprintf(
                '<a href="%s" class="social-link social-%s" target="_blank" rel="noopener noreferrer"><i class="fab fa-%s"></i></a>',
                esc_url($url),
                esc_attr($network),
                esc_attr($network)
            );
        }
    }
    echo wp_kses_post($output);
}

?>