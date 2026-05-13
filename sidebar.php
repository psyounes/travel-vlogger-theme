<?php
/**
 * Barre latérale
 */

if (!is_active_sidebar('primary-sidebar')) {
    return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
    <?php dynamic_sidebar('primary-sidebar'); ?>
</aside>