<?php
/**
 * Template archive
 */
get_header();
?>

    <div class="container">
        <div class="row">
            <main id="main" class="<?php echo esc_attr(travel_vlogger_get_main_class()); ?>" <?php echo travel_vlogger_has_sidebar() ? 'style="flex: 1; margin-right: 40px;"' : 'style="width: 100%;"'; ?>>

                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                        if (is_category()) {
                            single_cat_title();
                        } elseif (is_tag()) {
                            single_tag_title();
                        } elseif (is_author()) {
                            esc_html_e('Articles de ', 'travel-vlogger');
                            the_author();
                        } else {
                            esc_html_e('Archive', 'travel-vlogger');
                        }
                        ?>
                    </h1>
                </header>

                <?php
                if (have_posts()) {
                    ?>
                    <div class="posts-grid" style="display: grid; grid-template-columns: repeat(<?php echo intval(get_theme_mod('travel_vlogger_grid_columns', 3)); ?>, 1fr); gap: 40px;">
                        <?php
                        while (have_posts()) {
                            the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('travel-vlogger-grid'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>

                                    <div class="entry-meta">
                                        <?php travel_vlogger_posted_on(); ?>
                                    </div>
                                </header>

                                <?php if (get_theme_mod('travel_vlogger_show_excerpt', true)) : ?>
                                    <div class="entry-content">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                            </article>
                            <?php
                        }
                        ?>
                    </div>

                    <?php
                    the_posts_pagination();
                } else {
                    ?>
                    <p><?php esc_html_e('Aucun article trouvé.', 'travel-vlogger'); ?></p>
                    <?php
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