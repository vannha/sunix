<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>
<!doctype html>
<html id="html-wrap" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <meta name="format-detection" content="telephone=no">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>> 
    <?php sunix_page_loading(); ?>
    <div id="red-page" class="<?php sunix_page_css_class();?>">
    <?php
        sunix_header_top();
        sunix_header_main();
        sunix_page_title();

    ?>
    <main id="red-main" class="red-main">
