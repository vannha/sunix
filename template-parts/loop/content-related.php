<?php
/**
 * Template part for displaying posts in loop
 *
 * @package AlaCarte
 * @subpackage AlaCarte
 */
?>

<article <?php post_class('related-item'); ?>>
    <?php 
        alacarte_post_media();
        alacarte_post_header(['heading_tag' => 'h3'])
    ?>
</article>