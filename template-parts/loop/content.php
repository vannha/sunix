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

<article <?php post_class('red-list red-list-default'); ?>>
    <?php sunix_post_media(['thumbnail_size' => 'large', 'default_thumb' => false]); ?>
    <?php

    sunix_post_header([
        'class' => 'loop',
        'before_args' => [],
        'after_args'  => ['show_cat' => '0','show_author' => '0', 'show_date'=> '0', 'show_cmt' => '0', 'show_view' => '0', 'show_like' => '0','show_tag' => '0', 'sep' => '' ]]);

    sunix_post_excerpt();
    sunix_post_meta();
    ?>
    <?php sunix_post_read_more(['readmore_style' => '']); ?>
</article>