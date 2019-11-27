<?php
/**
 * OWL Nav & Dots 
 * Nav Position alacarte_carousel_nav_pos(),
 * Nav Style alacarte_carousel_nav_style(),
 * Dot style alacarte_carousel_dots_style()
*/
function alacarte_carousel_nav_pos(){
    $alacarte_carousel_nav_pos = array(
        esc_html__('Default','alacarte')          => 'default',
        esc_html__('Top Start','alacarte')        => 'top start',
        esc_html__('Top Center','alacarte')       => 'top center',
        esc_html__('Top End','alacarte')          => 'top end',
        esc_html__('Vertical Inside','alacarte')  => 'vertical inside',
        esc_html__('Vertical Outside','alacarte') => 'vertical outside',
    );
    return $alacarte_carousel_nav_pos;
}
function alacarte_carousel_nav_style(){
    $alacarte_carousel_nav_style = array(
        esc_html__('Default','alacarte')           => 'default',
        esc_html__('Only Arrow','alacarte')        => 'style-2',
        esc_html__('Circle Arrow (35)','alacarte') => 'circle arrow size-35',
        esc_html__('Dots In Nav','alacarte')       => 'dot-in-nav',
        esc_html__('Nav Text Prev/Next','alacarte')       => 'nav-text-show',
        esc_html__('Dots Beside Nav','alacarte')   => 'dot-beside-nav',
        esc_html__('Dots Beside Nav Circle Arrow (35)','alacarte')   => 'dot-beside-nav circle arrow size-35',
    );
    return $alacarte_carousel_nav_style;
}

function alacarte_carousel_dots_style(){
    $alacarte_carousel_dots_style = array(
        esc_html__('Default','alacarte')     => 'default',
        esc_html__('Line (25x4)','alacarte') => 'line-254',
        esc_html__('Thumbnail','alacarte')   => 'thumbnail',
        esc_html__('Progress','alacarte')    => 'progress',
    );
    return $alacarte_carousel_dots_style;
}
function alacarte_carousel_dot_pos(){
    return array(
        esc_html__('Default','alacarte')       => 'default',
        esc_html__('Top','alacarte')           => 'top',
        esc_html__('Bottom Inside','alacarte') => 'bottom-inside',
    );
}

function alacarte_carousel_color(){
    return array(
        esc_html__('Default','alacarte')             => 'default',
        esc_html__('White','alacarte')               => 'white',
        esc_html__('Grey','alacarte')                => 'grey',
        esc_html__('Gray(#DBDBDB)','alacarte')       => 'gray',
        esc_html__('Dark - Accent','alacarte')       => 'dark-accent',
        esc_html__('Light Dark - Accent','alacarte') => 'light-dark-accent',
    );
}

/* OWL Wrap css class */
function alacarte_owl_css_class($atts){
    extract($atts);
    $css_class_attr = ['red-owl-wrap'];
    if($nav) { 
        $css_class_attr[] = 'has-nav';
        $css_class_attr[] = 'nav-pos-'.$nav_pos;
        $css_class_attr[] = 'nav-style-'.$nav_style;
    }
    if($dots) {
        $css_class_attr[] = 'has-dots'; 
        $css_class_attr[] = 'dot-style-'.$dot_style;
        $css_class_attr[] = 'dot-pos-'.$dot_pos;
        $css_class_attr[] = 'dot-color-'.$dot_color;
    }
    return trim(implode(' ', $css_class_attr));
}

function alacarte_owl_dots_container($atts){
    extract($atts);
    if($nav_style === 'dot-in-nav') return;
    $css_class = ['red-owl-dots', $dot_style, $dot_pos, $dot_color];
    if($dot_style === 'progress') echo '<div class="red-owl-dots-progress">';
    ?>
        <div class="<?php echo trim(implode(' ', $css_class));?>"></div>
    <?php
    if($dot_style === 'progress') echo '</div>';
}

function alacarte_owl_nav_container($atts){
    extract($atts);
    if($nav_style === 'dot-in-nav') return;
    $css_class = ['red-owl-nav', $nav_style, $nav_pos, $nav_color];
    ?>
        <div class="<?php echo trim(implode(' ', $css_class));?>"></div>
    <?php
}

function alacarte_owl_dots_in_nav_container($atts){
    extract($atts);
    if($nav_style !== 'dot-in-nav') return;
    $nav_css_class = ['red-owl-nav', $nav_style, $nav_color];
    $dot_css_class = ['red-owl-dots', $dot_style, $dot_color];
    ?>
        <div class="<?php echo trim(implode(' ', $nav_css_class));?>">
            <div class="<?php echo trim(implode(' ', $dot_css_class));?>"></div>
        </div>
    <?php
}

/* Call OWL Settings */
function alacarte_owl_call_settings($atts)
{
    extract($atts);
    if ($layout_style !== 'carousel') return;
    wp_enqueue_script('owl-carousel');
    wp_enqueue_script('owl-carousel-theme');
    wp_enqueue_style( 'owl-carousel');
    /* Carousel Setting */
    $nav_icon = array('<span class="owl-nav-icon prev hint--top" data-hint="'.esc_attr__('Prev','alacarte').'"></span>','<span class="owl-nav-icon next hint--top" data-hint="'.esc_attr__('Next','alacarte').'"></span>');
    $rtl = is_rtl() ? true : false;
    $nav_small = $nav_large = $dot_small = $dot_large = $dotsData = '';

    $navContainerClass = 'red-owl-nav '.$nav_pos;
    $dotsClass = 'red-owl-dots '.$dot_style;
    
    /* Dots Style */
    if($dot_style === 'thumbnail'){
        $dotsData = true;
    }
    if($nav_style == 'nav-text-show'){
        $nav_text_show =  ['<i class="fal fa-chevron-left"></i><span class="text">'.esc_html__('Prev','alacarte').'</span>','<span class="text">'.esc_html__('Next','alacarte').'</span><i class="fal fa-chevron-right"></i>'];
       }
    else{
        $nav_text_show = ['<span class="red-owl-nav-icon prev" data-title="'.esc_attr__('Previous','alacarte').'"></span>', '<span class="red-owl-nav-icon next" data-title="'.esc_attr__('Next','alacarte').'"></span>'];

    }
    global $alacarte_owl; /* need it for multiple carousel in one page */
    $alacarte_owl[$el_id] = array(
        'rtl'                => $rtl,
        'margin'             => (int)$margin,
        'loop'               => (bool)$loop,
        'center'             => $center,
        'stagePadding'       => (int)$stagepadding,
        'autoWidth'          => $autowidth,
        'startPosition'      => (int)$startposition,
        'autoplay'           => $autoplay,
        'autoplayTimeout'    => (int)$autoplaytimeout,
        'autoplayHoverPause' => $autoplayhoverpause,
        'smartSpeed'         => (int)$smartspeed,           
        'autoHeight'         => $autoheight,
        'animateIn'          => $owlanimation_in,
        'animateOut'         => $owlanimation_out,
        'responsiveClass'    => true,
        'slideBy'            => $slideby,
        'slideTransition'    => $slidetransition,
        /* Nav */
        'nav'                => $nav,
        //'navContainerClass'  => $navContainerClass,
        'navClass'           => ['red-owl-nav-button red-owl-prev '.$nav_color,'red-owl-nav-button red-owl-next '.$nav_color],
        'navText'            =>$nav_text_show ,
        /* Dots */
        'dots'               => $dots,
        //'dotsClass'          => $dotsClass,
        'dotClass'           => 'red-owl-dot',
        'dotsData'           => (bool)$dotsData,
        /* respondive */
        'responsive'         => array(
            0 => array(
                'items' => (int)$owl_sm_items,
                'nav'   => false,
                //'dots'  => true,
            ),
            768 => array(
                'items' => (int)$owl_md_items,
                'nav'   => false,
                //'dots'  => $dots,
            ),
            992 => array(
                'items' => (int)$owl_lg_items,
                'nav'   => false,
                //'dots'  => $dots,
            ),
            1200 => array(
                'items' => (int)$owl_xl_items,
                'nav'   => false,
                //'dots'  => $dots,
            ),
            1400 => array(
                'items' => (int)$owl_xl_items,
                'nav'   => $nav,
                //'dots'  => $dots,
            )
        )
    );
    wp_localize_script('owl-carousel', 'alacarte_owl', $alacarte_owl);
}