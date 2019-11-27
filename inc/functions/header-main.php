<?php
/**
 * Header Main 
*/
if(!function_exists('alacarte_header_main')){
    function alacarte_header_main($class = ''){
        $header_layout = alacarte_get_opts('header_layout','1');
        get_template_part('template-parts/header/layout', $header_layout);
    }
}
/**
 * Header Class 
**/
if(!function_exists('alacarte_header_class')){
    function alacarte_header_class($class = ''){
        $classes = [];
        $classes[] = 'red-header';
        $header_ontop  = alacarte_get_opts('header_ontop','0');
        $header_sticky = alacarte_get_opts('header_sticky','0');
        $header_layout = alacarte_get_opts('header_layout','1');
        if(is_404()){
            $header_ontop= '1';
        }
        $classes[] = 'header-layout-'.$header_layout;
        if($header_layout === '3') $classes[] = 'side-header';

        if(!$header_ontop && !$header_sticky){
            $classes[] = 'header-default';
        } elseif ($header_ontop && !$header_sticky){
            $classes[] = 'header-ontop';
        } elseif (!$header_ontop && $header_sticky){
            $classes[] = 'header-default header-default-sticky sticky-on';
        } elseif($header_ontop && $header_sticky){
            $classes[] = 'header-ontop header-ontop-sticky sticky-on';
        } elseif($header_ontop){
            $classes[] = 'header_ontop';
        } elseif($header_sticky){
            $classes[] = 'header-default header-default-sticky sticky-on';
        }

        if(!empty($class)) $classes[] = $class;
        
        echo 'class="'.trim(implode(' ', $classes)).'"';
    }
}
if(!function_exists('alacarte_header_inner_class')){
    function alacarte_header_inner_class($class = ''){
        $header_fullwidth = alacarte_get_opts('header_fullwidth', '0');
        $classes = array('header-inner');
        if('1' === $header_fullwidth){
            $classes[] = 'no-container';
        }elseif(is_singular() && (alacarte_get_opts('body_single_boxed', '-1') === 'bordered')  && !is_page()){
            $classes[] = 'no-container';
        }
        else {
            $classes[] = 'container';
        }
        if(!empty($class)) $classes[] = $class;
        echo trim(implode(' ', $classes));
    }
}
if(!function_exists('alacarte_header_ontop')){
    function alacarte_header_ontop(){
        $header_ontop = alacarte_get_opts('header_ontop');
        return  $header_ontop;
    }
}

if(!function_exists('alacarte_header_sticky')){
    function alacarte_header_sticky(){
        $header_sticky = alacarte_get_opts('header_sticky');
        return  $header_sticky;
    }
}

if(!function_exists('alacarte_header_menu')){
    function alacarte_header_menu($args = []){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $header_menu = alacarte_get_opts('header_menu','red-primary');
        if('none' === $header_menu) return;
        ?>
            <nav id="red-navigation" class="<?php echo trim(implode(' ', (array)$args['class']));?>">
                <?php get_template_part( 'template-parts/header/header-menu' ); ?>
            </nav>
        <?php
    }
}
if(!function_exists('alacarte_header_menu_header4')){
    function alacarte_header_menu_header4($args = []){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        ?>
            <nav id="red-navigation" class="<?php echo trim(implode(' ', (array)$args['class']));?> row align-items-center justify-content-center">
                <div class="red-menu-left col-auto">
                    <?php
                    /* Mega Menu */
                    $megamenu = apply_filters('ef5_enable_megamenu', false);
                    $args = array(
                        'theme_location' => 'red-primary-left',
                        'menu' => 'red-menu-left',
                        'container' => '',
                        'menu_id' => 'red-header-menu',
                        'menu_class' => alacarte_header_menu_class(),
                        'link_before' => '<span class="menu-title">',
                        'link_after' => '</span>',
                        'walker' => ($megamenu && class_exists('EF5Systems_MegaMenu_Walker')) ? new EF5Systems_MegaMenu_Walker : new alacarte_Main_Menu_Walker,
                        'fallback_cb' => 'alacarte_header_menu_fallback'
                    );
                    wp_nav_menu($args);

                    ?>
                </div>
                <div class="red-logo col-auto">
                    <?php get_template_part( 'template-parts/header/header-logo' ); ?>
                </div>
                <div class="red-menu-right col-auto">
                    <?php
                    /* Mega Menu */
                    $megamenu = apply_filters('ef5_enable_megamenu', false);
                    $args = array(
                        'theme_location' => 'red-primary-right',
                        'menu' => 'red-menu-right',
                        'container' => '',
                        'menu_id' => 'red-header-menu',
                        'menu_class' => alacarte_header_menu_class(),
                        'link_before' => '<span class="menu-title">',
                        'link_after' => '</span>',
                        'walker' => ($megamenu && class_exists('EF5Systems_MegaMenu_Walker')) ? new EF5Systems_MegaMenu_Walker : new alacarte_Main_Menu_Walker,
                        'fallback_cb' => 'alacarte_header_menu_fallback'
                    );
                    wp_nav_menu($args);

                    ?>
                </div>


            </nav>
        <?php
    }
}
if(!function_exists('alacarte_header_side_menu')){
    function alacarte_header_side_menu($args = []){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $header_menu = alacarte_get_opts('header_menu','red-primary');
        if('none' === $header_menu) return;
        ?>
            <nav id="red-navigation" class="<?php echo trim(implode(' ', (array)$args['class']));?>">
                <?php get_template_part( 'template-parts/header/header-side-menu' ); ?>
            </nav>
        <?php
    }
}

if(!function_exists('alacarte_header_menu_fallback')){
    function alacarte_header_menu_fallback(){
        printf(
            '<ul id="red-header-menu" class="%1$s"><li class="menu-item required"><a href="%2$s">%3$s</a></li></ul>',
            esc_attr(alacarte_header_menu_class('primary-menu-not-set')),
            esc_url( admin_url( 'nav-menus.php?action=locations' ) ),
            esc_html__( 'Primary menu is not set, please location to "Primary Menu".', 'alacarte' )
        );
    }
}

/**
 * Header Menu Class
 * add class to menu container class
 *
*/
if(!function_exists('alacarte_header_menu_class')){
    function alacarte_header_menu_class($class=''){
        $classes = ['red-menu'];
        $header_layout = alacarte_get_opts('header_layout', '1');
        $header_ontop  = alacarte_get_opts('header_ontop','0');
        $header_sticky = alacarte_get_opts('header_sticky','0');
        $header_helper_menu = alacarte_get_opts('header_helper_menu','');

        if($header_layout === '7')
            $classes[] = 'red-side-menu';
        else 
            $classes[] = 'red-header-menu';

        if(!$header_ontop && !$header_sticky){
            $classes[] = 'menu-default';
        } elseif ($header_ontop && !$header_sticky){
            $classes[] = 'menu-ontop';
        } elseif (!$header_ontop && $header_sticky){
            $classes[] = 'menu-default';
        } elseif($header_ontop && $header_sticky){
            $classes[] = 'menu-ontop';
        }

        if(is_nav_menu($header_helper_menu)) $classes[] = 'has-helper-menu';

        $classes[] = $class;

        return trim(implode(' ', $classes));
    }
}