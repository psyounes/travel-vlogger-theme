<?php
/**
 * Template 404
 */
get_header();
?>

    <div class="container">
        <main id="main" class="site-main" style="text-align: center; padding: 100px 0;">

            <h1 style="font-size: 72px; margin-bottom: 20px;">404</h1>
            <h2><?php esc_html_e('Page non trouvée', 'travel-vlogger'); ?></h2>
            <p style="margin-bottom: 40px;"><?php esc_html_e('Désolé, la page que vous recherchez n\'existe pas.', 'travel-vlogger'); ?></p>

            <a href="<?php echo esc_url(home_url()); ?>" class="btn-primary">
                <?php esc_html_e('Retour à l\'accueil', 'travel-vlogger'); ?>
            </a>

        </main>
    </div>

<?php
get_footer();