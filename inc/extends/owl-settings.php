<?php
/**
 * OWL Nav & Dots 
 * Nav Position sunix_carousel_nav_pos(),
 * Nav Style sunix_carousel_nav_style(),
 * Dot style sunix_carousel_dots_style()
*/
function sunix_carousel_nav_pos(){
    $sunix_carousel_nav_pos = array(
        esc_html__('Default','sunix')          => 'default',
        esc_html__('Top Start','sunix')        => 'top start',
        esc_html__('Top Center','sunix')       => 'top center',
        esc_html__('Top End','sunix')          => 'top end',
        esc_html__('Vertical Inside','sunix')  => 'vertical inside',
        esc_html__('Vertical Outside','sunix') => 'vertical outside',
    );
    return $sunix_carousel_nav_pos;
}
function sunix_carousel_nav_style(){
    $sunix_carousel_nav_style = array(
        esc_html__('Default','sunix')           => 'default',
        esc_html__('Only Arrow','sunix')        => 'style-2',
        esc_html__('Circle Arrow (35)','sunix') => 'circle arrow size-35',
        esc_html__('Dots In Nav','sunix')       => 'dot-in-nav',
        esc_html__('Nav Text Prev/Next','sunix')       => 'nav-text-show',
        esc_html__('Dots Beside Nav','sunix')   => 'dot-beside-nav',
        esc_html__('Dots Beside Nav Circle Arrow (35)','sunix')   => 'dot-beside-nav circle arrow size-35',
    );
    return $sunix_carousel_nav_style;
}

function sunix_carousel_dots_style(){
    $sunix_carousel_dots_style = array(
        esc_html__('Default','sunix')     => 'default',
        esc_html__('Line (25x4)','sunix') => 'line-254',
        esc_html__('Thumbnail','sunix')   => 'thumbnail',
        esc_html__('Progress','sunix')    => 'progress',
    );
    return $sunix_carousel_dots_style;
}
function sunix_carousel_dot_pos(){
    return array(
        esc_html__('Default','sunix')       => 'default',
        esc_html__('Top','sunix')           => 'top',
        esc_html__('Bottom Inside','sunix') => 'bottom-inside',
    );
}

function sunix_carousel_color(){
    return array(
        esc_html__('Default','sunix')             => 'default',
        esc_html__('White','sunix')               => 'white',
        esc_html__('Grey','sunix')                => 'grey',
        esc_html__('Gray(#DBDBDB)','sunix')       => 'gray',
        esc_html__('Dark - Accent','sunix')       => 'dark-accent',
        esc_html__('Light Dark - Accent','sunix') => 'light-dark-accent',
    );
}

/* OWL Wrap css class */
function sunix_owl_css_class($atts){
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

function sunix_owl_dots_container($atts){
    extract($atts);
    if($nav_style === 'dot-in-nav') return;
    $css_class = ['red-owl-dots', $dot_style, $dot_pos, $dot_color];
    if($dot_style === 'progress') echo '<div class="red-owl-dots-progress">';
    ?>
        <div class="<?php echo trim(implode(' ', $css_class));?>"></div>
    <?php
    if($dot_style === 'progress') echo '</div>';
}

function sunix_owl_nav_container($atts){
    extract($atts);
    if($nav_style === 'dot-in-nav') return;
    $css_class = ['red-owl-nav', $nav_style, $nav_pos, $nav_color];
    ?>
        <div class="<?php echo trim(implode(' ', $css_class));?>"></div>
    <?php
}

function sunix_owl_dots_in_nav_container($atts){
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
function sunix_owl_call_settings($atts)
{
    extract($atts);
    if ($layout_style !== 'carousel') return;
    wp_enqueue_script('owl-carousel');
    wp_enqueue_script('owl-carousel-theme');
    wp_enqueue_style( 'owl-carousel');
    /* Carousel Setting */
    $nav_icon = array('<span class="owl-nav-icon prev hint--top" data-hint="'.esc_attr__('Prev','sunix').'"></span>','<span class="owl-nav-icon next hint--top" data-hint="'.esc_attr__('Next','sunix').'"></span>');
    $rtl = is_rtl() ? true : false;
    $nav_small = $nav_large = $dot_small = $dot_large = $dotsData = '';

    $navContainerClass = 'red-owl-nav '.$nav_pos;
    $dotsClass = 'red-owl-dots '.$dot_style;
    
    /* Dots Style */
    if($dot_style === 'thumbnail'){
        $dotsData = true;
    }
    if($nav_style == 'nav-text-show'){
        $nav_text_show =  ['<i class="fal fa-chevron-left"></i><span class="text">'.esc_html__('Prev','sunix').'</span>','<span class="text">'.esc_html__('Next','sunix').'</span><i class="fal fa-chevron-right"></i>'];
       }
    else{
        $nav_text_show = ['<span class="red-owl-nav-icon prev" data-title="'.esc_attr__('Previous','sunix').'"></span>', '<span class="red-owl-nav-icon next" data-title="'.esc_attr__('Next','sunix').'"></span>'];

    }
    global $sunix_owl; /* need it for multiple carousel in one page */
    $sunix_owl[$el_id] = array(
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
    wp_localize_script('owl-carousel', 'sunix_owl', $sunix_owl);
}