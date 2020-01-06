<?php
/**
 * Template part for displaying posts in loop
 *
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>

<article <?php post_class('red-single'); ?>>
    <?php 

        sunix_post_media();
    sunix_post_header();
        sunix_post_content();
        sunix_link_pages();
    ?>
    <footer class="red-post-footer"><?php
        do_action('sunix_single_post_footer');
        sunix_tagged_in();

    ?></footer>
</article>