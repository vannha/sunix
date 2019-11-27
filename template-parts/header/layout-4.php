<?php
/**
 * Template part for displaying default header layout
 */
$header_menu    = alacarte_get_opts('header_menu','');
$show_search    = alacarte_get_opts('header_search', '0');
$show_cart      = alacarte_get_opts('header_cart', '0');

$nav_extra_class = [
    'nav-extra',
    'd-flex',
    'align-items-center',
    'col-auto',
    alacarte_get_opts('header_atts_icon_style','icon')
];
if($header_menu === 'none') $nav_extra_class[] = 'no-menu';
if($show_search == '0' && $show_cart === '0') $nav_extra_class[] = 'no-icon';
?>
<header id="red-header" <?php alacarte_header_class(); ?>>
    <div id="red-headroom" class="main-header">
        <div class="<?php alacarte_header_inner_class();?>">
            <div class="row justify-content-between align-items-center">
                <div class="red-logo col-auto red-logo-mobile">
                    <?php get_template_part( 'template-parts/header/header-logo' ); ?>
                </div>
                <div class="col-auto">
                    <?php get_template_part('template-parts/header/header-social'); ?>
                </div>
                <div class="red-navigation-wrap col">
                    <?php alacarte_header_helper_menu(); ?>
                    <div class="row align-items-center justify-content-center">
                        <?php alacarte_header_menu_header4(['class' => ' col-xl-auto']); ?>
                    </div>
                </div>
                <div class="<?php echo trim(implode(' ', $nav_extra_class)); ?>">
                    <?php
                        alacarte_header_search(['type' => 'popup']);
                        alacarte_header_wishlist();
                        alacarte_header_compare();
                        alacarte_header_cart();
                        alacarte_header_signin_signup();
                        alacarte_header_contact();
                        alacarte_header_popup_nav_icon();
                        alacarte_header_mobile_menu_icon();
                        alacarte_header_side_nav_icon();
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>