<?php
/**
 * Template part for displaying posts in loop
 *
 * @package AlaCarte
 * @subpackage AlaCarte
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>

<article <?php post_class('red-single'); ?>>
    <?php 

        alacarte_post_media();
    alacarte_post_header();
        alacarte_post_content();
        alacarte_link_pages();
    ?>
    <footer class="red-post-footer row justify-content-between align-items-center empty-none"><?php
        do_action('alacarte_single_post_footer');
        alacarte_tagged_in();
        alacarte_post_share(array('show_title' => false, 'social_args' => ['class' => 'size-28 shape-circle outline colored-hover']));
    ?></footer>
</article>