<?php
/**
 * En-tête du thème
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site">
        <header id="masthead" class="site-header" role="banner">
            <div class="container">
                <div class="header-inner">
                    <div class="site-logo">
                        <?php
                        if (has_custom_logo()) {
                            travel_vlogger_the_custom_logo();
                        } else {
                            echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">';
                            travel_vlogger_the_site_title();
                            echo '</a>';
                        }
                        ?>
                    </div>

                    <nav id="site-navigation" class="site-navigation" role="navigation">
                        <?php travel_vlogger_primary_menu(); ?>
                    </nav>

                    <button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </header>

        <div id="content" class="site-content">