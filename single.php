<?php
/**
 * Template article unique
 */
get_header();
?>

    <div class="container">
        <div class="row">
            <main id="main" class="site-main" style="<?php echo travel_vlogger_has_sidebar() ? 'flex: 1; margin-right: 40px;' : 'width: 100%;'; ?>">

                <?php
                while (have_posts()) {
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>

                            <div class="entry-meta">
                                <?php travel_vlogger_posted_on(); ?> |
                                <?php travel_vlogger_posted_by(); ?> |
                                <?php travel_vlogger_posted_in(); ?>
                            </div>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('travel-vlogger-featured'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>

                        <footer class="entry-footer">
                            <?php the_tags('<div class="tags">', ' ', '</div>'); ?>
                        </footer>
                    </article>

                    <div style="margin: 40px 0; padding: 20px; background: #f5f5f5; border-radius: 8px;">
                        <h3><?php esc_html_e('À propos de l\'auteur', 'travel-vlogger'); ?></h3>
                        <p><?php the_author_meta('description'); ?></p>
                    </div>

                    <?php
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                }
                ?>

            </main>

            <?php if (travel_vlogger_has_sidebar()) : ?>
                <aside id="secondary" class="widget-area">
                    <?php dynamic_sidebar('primary-sidebar'); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>

<?php
get_footer();