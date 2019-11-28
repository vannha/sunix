<?php
/**
 * Template part for displaying posts in loop
 *
 * @package sunix
 * @subpackage sunix
 */
?>

<article <?php post_class('related-item'); ?>>
    <?php 
        sunix_post_media();
        sunix_post_header(['heading_tag' => 'h3'])
    ?>
</article>