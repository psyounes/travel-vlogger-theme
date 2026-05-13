<?php
/**
 * Pied de page du thème
 */
?>
        </div><!-- #content -->

        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="container">
                <?php if (get_theme_mod('travel_vlogger_show_footer_widgets', true)) : ?>
                    <div class="footer-content">
                        <?php
                        if (is_active_sidebar('footer-sidebar')) {
                            dynamic_sidebar('footer-sidebar');
                        } else {
                            ?>
                            <div class="footer-widget">
                                <h3><?php esc_html_e('À propos', 'travel-vlogger'); ?></h3>
                                <p><?php esc_html_e('Bienvenue sur notre blog de voyage. Découvrez les plus belles destinations du monde.', 'travel-vlogger'); ?></p>
                            </div>
                            <div class="footer-widget">
                                <h3><?php esc_html_e('Navigation', 'travel-vlogger'); ?></h3>
                                <?php travel_vlogger_footer_menu(); ?>
                            </div>
                            <div class="footer-widget">
                                <h3><?php esc_html_e('Réseaux Sociaux', 'travel-vlogger'); ?></h3>
                                <div class="social-links">
                                    <?php travel_vlogger_social_links(); ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <div class="footer-bottom">
                    <p><?php echo wp_kses_post(get_theme_mod('travel_vlogger_copyright_text', '&copy; 2026 Travel Vlogger. Tous droits réservés.')); ?></p>
                </div>
            </div>
        </footer>

    </div><!-- #page -->

    <?php wp_footer(); ?>
</body>
</html>