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

<article <?php post_class('red-list red-list-default'); ?>>
    <?php alacarte_post_media(['thumbnail_size' => 'large', 'default_thumb' => false]); ?>
    <?php

    alacarte_post_header([
        'class' => 'loop',
        'before_args' => [],
        'after_args'  => ['show_cat' => '0','show_author' => '0', 'show_date'=> '0', 'show_cmt' => '0', 'show_view' => '0', 'show_like' => '0','show_tag' => '0', 'sep' => '' ]]);

    alacarte_post_excerpt();
    alacarte_post_meta();
    ?>
    <?php alacarte_post_read_more(['readmore_style' => '']); ?>
</article>