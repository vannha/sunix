<?php
/**
 * Template Name: Coming soon
 * @package RedExp
 * @subpackage syring
 * @since 1.0.0
 * @author Red Team
 */
?>
<!doctype html>
<html id="html-page-comming-soon" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body id="page-comming-soon" <?php body_class(); ?>>
<?php sunix_page_loading(); ?>
<div id="red-page" class="<?php sunix_page_css_class();?>">
    <?php
    sunix_header_top();
    sunix_header_main();
    sunix_page_title();
    ?>
    <main id="red-main" class="red-main">
        <div class="row">
            <div class="container">
                <?php
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </main>
</div>
<?php wp_footer(); ?>
</body>
</html>