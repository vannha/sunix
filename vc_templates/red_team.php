<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_cms_team
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$wrap_css_class = ['red-team-wrap'];
$css_class_attr = $item_class = array();
$css_class_attr[] = 'red-team red-team-layout-'.$layout_template;
$item_class[] = 'team-item';

if($layout_style === 'carousel'){
	$wrap_css_class[] = alacarte_owl_css_class($atts);
	$css_class_attr[] = 'red-owl team-carousel owl-carousel';
	$item_class[]     = 'red-carousel-item';
} else {
	$css_class_attr[] = 'red-grid row align-items-center justify-content-center';
	$item_class[]     = 'red-grid-item col-'.$col_sm.' col-md-'.$col_md.' col-lg-'.$col_lg.' col-xl-'.$col_xl;
}
$text_align = '';
if(!empty($content_align)) {
    $text_align = 'text-'.$content_align;
} else {
    if(in_array($layout_template, ['2','3'])) {
        $text_align = 'text-center';
        $content_align = 'center';
    }
}
$css_class_attr[] = $text_align;
$css_class_attr[] = $el_class;

/* get space for owl item */
$owl_item_space = '';
if(isset($margin) && (isset($number_row) && $number_row > 1 )){
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}
// Inner class 
$item_inner_class = ['inner-box'];

// get testinomial data
$teams = (array) vc_param_group_parse_atts( $atts['teams'] );
// Team Image Size
if( $thumbnail_size === 'custom')
	$thumbnail_size = $thumbnail_size_custom;
if(empty($thumbnail_size)){
    switch ($layout_template) {
        case '5':
            $thumbnail_size = '240';
            break;
        case '4':
            $thumbnail_size = '270x350';
            break;
        case '3':
            $thumbnail_size = '370x578';
            break;
        case '2':
            $thumbnail_size = '270x350';
            break;
        default:
            $thumbnail_size = '270';
            break;
    }
}
// OWL Dots thumbnail Size
switch ($layout_template) {
    case '4': 
        $item_inner_class[] = 'shadow-hover'; 
        break;
	default:
		$dot_thumbnail_size = '80';
		break;
}
$count = count($teams);
$i=1;
$j=0;
$team_link_open = $team_link_close = $socials = '';
?>
<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
    <div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ',$css_class_attr));?>"> 
        <?php
            foreach($teams as $team){
                $team['image']  = isset($team['image']) ? $team['image'] : null;
                $j++;
                if($i > $number_row) $i=1;
                
                if(isset($team['name'])) {
                	if(!empty($team['link'])){
					    $team_link = vc_build_link( $team['link']);
					    $team_link = ( $team_link == '||' ) ? '' : $team_link;  
					    if ( strlen( $team_link['url'] ) > 0 ) {
					        $a_href = $team_link['url'];
					        $a_title = !empty($team_link['title']) ? $team_link['title'] : $team['name'];
					        $a_target = strlen( $team_link['target'] ) > 0 ? $team_link['target'] : '_blank';
					    }
					    $team_link_open = '<a href="'.esc_url($a_href).'" title="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'">';
                		$team_link_close = '</a>';
					}
					if(!empty($team['social'])){
						$socials_list = '';
						$socials = (array) vc_param_group_parse_atts( $team['social']);
                        foreach($socials as $social){
                            if(isset($social['icon'])) $icon = '<span class="'.$social['icon'].'"></span>';
                            /* parse social link */
                            $link = false;
                            if(isset($social['link'])){
                                $icon_link = vc_build_link( $social['link'] );
                                $icon_link = ( $icon_link == '||' ) ? '' : $icon_link;
                                if ( strlen( $icon_link['url'] ) > 0 ) {
                                    $link = true;
                                    $social_href = $icon_link['url'];
                                    $social_title = $icon_link['title'] ? $icon_link['title'] : '';
                                    $social_target = strlen( $icon_link['target'] ) > 0 ? str_replace(' ','',$icon_link['target']) : '_self';
                                }
                            }
                            if($link){
                                $link_open = '<a href="'.esc_url($social_href).'" title="'.esc_attr($social_title).'" target="'.esc_attr($social_target).'">';
                                $link_close = '</a>';
                                $socials_list .= $link_open.$icon.$link_close;
                            }     
                        }
					}
                	// dot image
                	if(!empty($team['image']))
                    	$dot_image = alacarte_image_by_size(['id'=>$team['image'], 'size'=>$dot_thumbnail_size, 'class'=>'dot-thumb circle', 'echo' => false]);
                    else 
                    	$dot_image = alacarte_default_image_thumbnail(['size' => $dot_thumbnail_size, 'class' => 'dot-thumb circle']);
                    if($i==1) : ?>
                        <div class="<?php echo join(' ',$item_class);?>" data-dot='<?php echo wp_kses_post($dot_image); ?>'>
                    <?php  
                        endif;
                        echo '<div class="red-item-inner" '.$owl_item_space.'><div class="'.implode(' ', $item_inner_class).'">';
                        	switch ($layout_template) {
                                case '5':
                            ?>
                                <div class="row">
                                    <div class="col-auto team-images">
                                        <?php
                                            // image            
                                            alacarte_image_by_size([
                                                'id'      => $team['image'],
                                                'size'    => $thumbnail_size,
                                                'class'   => 'team-img transition',
                                                'default' => true
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col team-info">
                                        <div class="team-header">
                                            <?php
                                                // name
                                                echo '<div class="team-name h4 text-truncate">'.$team_link_open.$team['name'].$team_link_close.'</div>';
                                                // position
                                                echo '<div class="team-position text-truncate">'.$team['position'].'</div>';
                                            ?>
                                        </div>                                        
                                        <?php // desc 
                                            if(!empty($team['desc'])) echo '<div class="team-desc">'.$team['desc'].'</div>';
                                        ?>
                                        <div class="team-social red-social size-30"><?php echo alacarte_html($socials_list);?></div>
                                    </div>
                                </div>
                                <?php
                                break;
                                case '4':
                            ?>
                                <div class="team-images">
                                    <?php
                                        // image            
                                        alacarte_image_by_size([
                                            'id'      => $team['image'],
                                            'size'    => $thumbnail_size,
                                            'class'   => 'team-img transition',
                                            'default' => true
                                        ]);
                                    ?>
                                </div>
                                <div class="team-info red-shadow-hover transition">
                                    <div class="team-header"><?php
                                        // name
                                        echo '<div class="team-name h4 text-truncate">'.$team_link_open.$team['name'].$team_link_close.'</div>';
                                        // position
                                        echo '<div class="team-position text-truncate">'.$team['position'].'</div>';
                                    ?></div>
                                    <?php 
                                        // desc 
                                        if(!empty($team['desc'])) echo '<div class="team-desc">'.$team['desc'].'</div>';
                                    ?>
                                    <div class="team-social red-social size-30"><?php echo alacarte_html($socials_list);?></div>
                                </div>
                                <?php
                                break;
                                case '3':
                            ?>
                                <div class="team-images transition">
                                    <?php
                                        // image            
                                        alacarte_image_by_size([
                                            'id'      => $team['image'],
                                            'size'    => $thumbnail_size,
                                            'class'   => 'team-img transition',
                                            'default' => true
                                        ]);
                                    ?>
                                </div>
                                <div class="team-info transition red-box-shadow-3">
                                    <div class="team-name h3 text-truncate">
                                        <?php echo alacarte_html($team_link_open.$team['name'].$team_link_close);?>
                                    </div>
                                    <div class="team-position text-truncate"><?php echo alacarte_html($team['position']);?></div>
                                    <?php if(!empty($team['desc'])) : ?><div class="team-desc"><?php echo alacarte_html($team['desc']);?></div><?php endif; ?>
                                    <div class="team-social red-social size-30 <?php echo esc_attr($text_align);?>">
                                        <?php echo alacarte_html($socials_list);?>
                                    </div>
                                </div>
                                <?php
                                break;
                                case '2':
                            ?>
                                <div class="hoverdir-wrap slide">
                                    <div class="hover-inner team-images">
                                        <?php
                                            // image            
                                            alacarte_image_by_size([
                                                'id'      => $team['image'],
                                                'size'    => $thumbnail_size,
                                                'class'   => 'team-img transition',
                                                'default' => true
                                            ]);
                                        ?>
                                    </div>
                                    <div class="team-info">
                                        <div class="team-info-top">
                                            <?php
                                            // name
                                            echo '<div class="team-name h3 text-truncate">'.$team_link_open.$team['name'].$team_link_close.'</div>';
                                            // position
                                            echo '<div class="team-position text-truncate">'.$team['position'].'</div>';
                                            ?>
                                        </div>
                                        <?php
                                            if(!empty($team['desc'])) echo '<div class="team-desc">'.$team['desc'].'</div>';

                                        ?>
                                        <div class="team-social red-social shape-circle size-28 "><?php echo alacarte_html($socials_list);?></div>
                                        <div class="team-link-button">
                                            <?php
                                            if(!empty($team['link'])){
                                                $team_link_open = '<a class="red-btn accent outline" href="'.esc_url($a_href).'" title="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'">';
                                                $team_link_close = '</a>';
                                                $team_link_full= $team_link_open.$a_title.$team_link_close;
                                                echo wp_kses_post($team_link_full);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                break;
                        		default:
                            ?>
                                <div class="hoverdir-wrap slide">
                                    <div class="hover-inner team-images">
                                        <?php
                                            // image            
                                            alacarte_image_by_size([
                                                'id'      => $team['image'],
                                                'size'    => $thumbnail_size,
                                                'class'   => 'team-img transition',
                                                'default' => true
                                            ]);
                                		?>
                                    </div>
                            		<div class="team-info">
    	                        		<?php
    	                        			// name
    			                            echo '<div class="team-name h3 text-truncate">'.$team_link_open.$team['name'].$team_link_close.'</div>';
    			                            // position
    			                            echo '<div class="team-position text-truncate">'.$team['position'].'</div>';

    			                        	
    			                        ?>
                                        <div class="wrap-team-social">
                                            <div class="team-social red-social shape-circle size-28 "><?php echo alacarte_html($socials_list);?></div>
                                        </div>
    			                    </div>
                                </div>
			                    <?php
                        		break;
                        	}
                        echo '</div></div>';
                    if($i == $number_row || $j==$count) echo '</div>';
                    $i++;
                    }
            }
        ?>
    </div>
    <?php if($layout_style === 'carousel'):
        alacarte_loading_animation();
        alacarte_owl_dots_container($atts);
        alacarte_owl_nav_container($atts);
        alacarte_owl_dots_in_nav_container($atts);
    endif; ?>
</div>
