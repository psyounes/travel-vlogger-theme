<?php
/**
 * Template page
 */
get_header();
?>

    <div class="container">
        <main id="main" class="site-main" style="max-width: 900px; margin: 0 auto;">

            <?php
            while (have_posts()) {
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('travel-vlogger-featured'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>

                <?php
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
            }
            ?>

        </main>
    </div>

<?php
get_footer();