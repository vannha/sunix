<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_testimonial
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$wrap_css_class = ['red-testimonial-wrap'];
$css_class_attr = $item_class = array();
$css_class_attr[] = 'red-testimonial red-testimonial-layout-'.$layout_template;
$item_class[] = 'testimonial-item';

if($layout_style === 'carousel'){
    $wrap_css_class[] = sunix_owl_css_class($atts);
    $css_class_attr[] = 'red-owl testimonial-carousel owl-carousel';
    $item_class[] = 'red-carousel-item';
} else {
    $css_class_attr[] = 'red-grid row justify-content-center';
    $item_class[] = 'red-grid-item col-'.$col_sm.' col-md-'.$col_md.' col-lg-'.$col_lg.' col-xl-'.$col_xl;
}

$css_class_attr[] = $content_align;
$css_class_attr[] = $el_class;

/* get space for owl item */
$owl_item_space = '';
if(isset($margin) && (isset($number_row) && $number_row > 1 )){
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}
// get testinomial data
$testimonials = (array) vc_param_group_parse_atts( $atts['testimonials'] );
// avatar size
switch ($layout_template) {
	default:
		$dot_thumbnail_size = $avatar_size = '50';
		break;
}
$ttmn_icon = '<div class="ttmn-icon"><span class="fa fa-quote-left"></span></div>';
$count = count($testimonials);
$i=1;
$j=0;
$author_link_open = $author_link_close = '';

$inner_css_classes = ['red-item-inner','transition'];
if($layout_template === '3') $inner_css_classes[] = 'red-box-shadow-testimonial';

?>
<div class="<?php echo trim(implode(' ', $wrap_css_class));?> red-testimonial-wrap-layout-<?php echo esc_attr($layout_template);?>">
    <div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ',$css_class_attr));?>"> 
        <?php
            foreach($testimonials as $testimonial){
                $j++;
                if($i > $number_row) $i=1;
                $testimonial['author_avatar'] = isset($testimonial['author_avatar']) ? $testimonial['author_avatar'] : null;

                if(isset($testimonial['author_name'])) {
                	if(!empty($testimonial['author_url'])){
                		$author_link_open = '<a href="'.esc_url($testimonial['author_url']).'" target="_blank">';
                		$author_link_close = '</a>';
                	}
                	// dot image
                	$dot_image = sunix_image_by_size([
						'id'    => $testimonial['author_avatar'],
						'size'  => $dot_thumbnail_size, 
						'class' => 'dot-thumb circle', 
						'echo'  => false
                	]);
                    // star rating
                    $testimonial['author_rate'] = isset($testimonial['author_rate']) ? $testimonial['author_rate'] : '';
                    if($i==1) : ?>
                        <div class="<?php echo join(' ',$item_class);?>" data-dot='<?php echo sunix_html($dot_image); ?>'>
                    <?php  
                        endif;
                        echo '<div class="'.trim(implode(' ', $inner_css_classes)).'" '.$owl_item_space.'>';
                        	switch ($layout_template) {
                                case '4':
                                    echo '<div class="row">';
                                        echo '<div class="col">';
                                            echo '<div class="ttmn-text text-large">'.$testimonial['text'].'</div>';
                                        echo '</div>';
                                    echo '</div>';
                                break;


                        		default:?>
                                    <div class="ttmn-text">
                                        &ldquo; <?php echo esc_html($testimonial['text']);?> &rdquo;
                                    </div>
                        			<?php echo '<div class="row">';
                            			//avatar
                            			sunix_image_by_size([
    										'id'      => $testimonial['author_avatar'],
    										'size'    => $avatar_size,
    										'class'   => 'avatar circle',
    										'default' => true,
    										'before'  => '<div class="col-auto"><div class="block-img">',
    										'after'	  => '</div></div>'
                            			]);
                            			echo '<div class="col col-right">';
                            				echo '<div class="ttmn-header">';
    		                        			// name
    				                            echo '<div class="ttmn-name h4-1">'.$author_link_open.$testimonial['author_name'].$author_link_close.'</div>';
    				                            // position
    				                            echo '<div class="ttmn-position ">'.$testimonial['author_position'].'</div>';
    			                            echo '</div>';
    			                        	// star rating
    					                    if(!empty($testimonial['author_rate'])) {
    					                    	$author_rate = ($testimonial['author_rate']/5)*100;
    					                    	$star_rating = '<div class="ttmn-rate"><span class="ttmn-rated" style="width:'.$author_rate.'%"></span></div>';
    			                        		echo wp_kses_post($star_rating);
    			                        	}


    		                            echo '</div>';
                                    echo '</div>';
                        		break;
                        	}
                        echo '</div>';
                    if($i == $number_row || $j==$count) echo '</div>';
                    $i ++;
                }
            }
        ?>
    </div>
    <?php if($layout_style === 'carousel'):
        sunix_loading_animation();
        sunix_owl_dots_container($atts);
        sunix_owl_nav_container($atts);
        sunix_owl_dots_in_nav_container($atts);
    endif; ?>
</div>
