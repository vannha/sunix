<?php
/**
 * Template part for displaying default header layout
 */
$header_menu    = sunix_get_opts('header_menu','');
$show_search    = sunix_get_opts('header_search', '0');
$show_cart      = sunix_get_opts('header_cart', '0');

$nav_extra_class = [
    'nav-extra',
    'align-items-center',
    sunix_get_opts('header_atts_icon_style','icon')
];
if($header_menu === 'none') $nav_extra_class[] = 'no-menu';
if($show_search == '0' && $show_cart === '0') $nav_extra_class[] = 'no-icon';
?>
<header id="red-header" <?php sunix_header_class(); ?>>
    <div id="red-headroom" class="main-header">
        <div class="<?php sunix_header_inner_class();?>">
            <div class="row justify-content-between align-items-center">
                <div class="red-logo col-auto red-logo-mobile">
                    <?php get_template_part( 'template-parts/header/header-logo' ); ?>
                </div>
                <div class="red-navigation-wrap col">
                    <?php sunix_header_helper_menu(); ?>
                    <div class="row align-items-center justify-content-start">
                        <?php sunix_header_menu(['class' => ' col-xl-auto']); ?>
                    </div>
                </div>
                <div class="red-logo col-lg-2">
                    <?php get_template_part( 'template-parts/header/header-logo' ); ?>
                </div>
                <div class="<?php echo trim(implode(' ', $nav_extra_class)); ?> col">
                        <?php
                        get_template_part('template-parts/header/header-social');
                        sunix_header_contact_plain_text([
                            'layout'      => '5',
                            'class'       => 'd-none d-xl-flex',
                            'inner_class' => 'row gutters-10 align-items-center',
                            'page_only'   => true,
                        ]);
                        sunix_header_contact_plain_icon();
                        sunix_header_search(['type' => 'popup']);
                        sunix_header_wishlist();
                        sunix_header_cart();
                        sunix_header_signin_signup();
                        sunix_header_contact();
                        sunix_header_popup_nav_icon();
                        sunix_header_mobile_menu_icon();
                        sunix_header_side_nav_icon();

                        ?>

                </div>
            </div>
        </div>
    </div>
</header>