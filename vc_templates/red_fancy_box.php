<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_fancy_icon
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Default */
$title_css = $content_css = array();

// Heading Color
$heading_styles = isset($heading_color) && !empty($heading_color) ? 'style="color:'.$heading_color.'"' : '';
// Description Color
$desc_styles = isset($desc_color) && !empty($desc_color) ? 'style="color:'.$desc_color.'"' : '';

/* parse button link */
$use_link = false;
if(!empty($atts['button_link'])){
    $button_link = vc_build_link( $atts['button_link'] );
    $button_link = ( $button_link == '||' ) ? '' : $button_link;
    if ( strlen( $button_link['url'] ) > 0 ) {
        $use_link = true; 
        $a_href = $button_link['url'];
        $a_title = strlen($button_link['title']) > 0 ? $button_link['title'] : esc_html__('Read more','sunix') ;
        $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';
    }
}
// Wrap css class
$wrap_css_class = ['red-fancybox','red-fancybox-'.$layout_template, 'transition', 'red-line-corner-wrap', $bg_color , $el_class];
//if($layout_template === '4') $wrap_css_class[] = 'red-box-shadow-5';
// Button
$btn_type = '';

/* Icons */
$icon_css_class = ['red-fancybox-icon', 'transition', 'icon-'.$i_shape, 'text-accent', $i_color, 'red-bg-'.$i_bg_color];
$icon_name = "i_icon_" . $i_type;
$iconClass = isset($atts[$icon_name]) ? $atts[$icon_name]: '';
$iconStyle = !empty($i_custom_color) ? 'style="color:'.$i_custom_color.'"' : '';
// icon output
$fancybox_icon = ob_start();
?>
<div class="<?php echo trim(implode(' ', $icon_css_class));?>" <?php echo sunix_html($iconStyle);?>>
	<?php switch ($add_icon) {
		case 'upload':
			sunix_image_by_size([
				'id'    => $icon_upload,
				'size'  => $icon_size,
				'class' => 'red-pricing-img'
		    ]);
			break;
		default:
	?>
		<span class="<?php echo esc_attr($iconClass); ?>" <?php if (!empty($i_size)){ echo 'style="font-size:'.esc_attr($i_size).'"';} ?>></span>
	<?php
			break;
	}
	?>
</div>
<?php $fancybox_icon = ob_get_clean(); ?>
<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
	<?php switch ($layout_template) {
        case '7':
            ?>
            <?php if(!empty($fancybox_icon)): ?>
            <?php if($add_icon !== 'none') { ?>
                <div class="red-fancy-icon-wrap">
                    <?php printf('%s', $fancybox_icon); ?>
                </div>
            <?php } ?>
        <?php endif; ?>
            <div class="fancy-right">
                <?php if(!empty($heading)): ?>
                    <div class="red-fancybox-heading red-heading" <?php echo sunix_html($heading_styles);?>><?php echo sunix_html($heading); ?></div>
                <?php endif; ?>
                <?php if(!empty($desc)): ?><div class="desc" <?php echo sunix_html($desc_styles);?>><?php echo sunix_html($desc); ?></div><?php endif; ?>
                <?php if($use_link) { ?>
                    <footer class="red-fancy-footer">
                        <a href="<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" class="<?php echo esc_attr($btn_type); ?>">
                            <span><?php echo esc_html($a_title);?></span>
                        </a>
                    </footer>
                <?php } ?>
            </div>


            <?php
            break;
		case '6':
	?>
		<div class="align-items-center">
			<?php if($add_icon !== 'none') { ?>
				<div class="red-fancy-icon-wrap">
		            <?php printf('%s', $fancybox_icon); ?>
		        </div>
	        <?php } ?>
			<div class="">
				<?php if(!empty($heading)): ?><div class="red-fancybox-heading red-heading" <?php echo sunix_html($heading_styles);?>><?php echo sunix_html($heading); ?></div><?php endif; ?>
				<?php if(!empty($desc)): ?><div class="desc" <?php echo sunix_html($desc_styles);?>><?php echo sunix_html($desc); ?> <i class="far fa-long-arrow-right"></i></div><?php endif; ?>
				<?php if($use_link) { ?>
	            <footer class="red-fancy-footer">
	                <a href="<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" class="<?php echo esc_attr($btn_type); ?>">
	                <span><?php echo esc_html($a_title);?></span>
	                </a>
	            </footer>
	            <?php } ?>
			</div>
		</div>
	<?php break;
		case '5':
	?>
		<?php if($add_icon !== 'none') { ?>
			<div class="red-fancy-icon-wrap">
	            <?php printf('%s', $fancybox_icon); ?>
	        </div>
        <?php } ?>
		<?php if(!empty($heading)): ?><div class="red-fancybox-heading red-heading" <?php echo sunix_html($heading_styles);?>><?php echo sunix_html($heading); ?></div><?php endif; ?>
		<?php if(!empty($desc)): ?><div class="desc" <?php echo sunix_html($desc_styles);?>><?php echo sunix_html($desc); ?></div><?php endif; ?>
		<?php if($use_link) { ?>
        <footer class="red-fancy-footer">
            <a href="<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" class="<?php echo esc_attr($btn_type); ?>">
            <span><?php echo esc_html($a_title);?></span>
            </a>
        </footer>
        <?php } ?>
	<?php
		break;
		case '4':
	?>
		<div class="red-fancybox-inner transition">
			<div class="row">
				<?php if($add_icon !== 'none') { ?>
					<div class="red-fancy-icon-wrap col-12">
			            <?php printf('%s', $fancybox_icon); ?>
			        </div>
		        <?php } ?>
				<div class="col-12">
					<?php if(!empty($heading)): ?><div class="red-fancybox-heading red-heading transition" <?php echo sunix_html($heading_styles);?>><?php echo sunix_html($heading); ?></div><?php endif; ?>
					<?php if(!empty($desc)): ?><div class="desc" <?php echo sunix_html($desc_styles);?>><?php echo sunix_html($desc); ?></div><?php endif; ?>
					<?php if($use_link) { ?>
		            <footer class="red-fancy-footer">
		                <a href="<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" class="<?php echo esc_attr($btn_type); ?>">
		                <span><?php echo esc_html($a_title);?></span>
		                </a>
		            </footer>
		            <?php } ?>
				</div>
			</div>
		</div>
	<?php
		break;
		case '3':
	?>
		<?php if(!empty($fancybox_icon)): ?>
				<?php if($add_icon !== 'none') { ?>
					<div class="red-fancy-icon-wrap">
			            <?php printf('%s', $fancybox_icon); ?>
			        </div>
		        <?php } ?>
		<?php endif; ?>
        <div class="fancy-right">
            <?php if(!empty($heading)): ?>
                <div class="red-fancybox-heading red-heading" <?php echo sunix_html($heading_styles);?>><?php echo sunix_html($heading); ?></div>
            <?php endif; ?>
            <?php if(!empty($desc)): ?><div class="desc" <?php echo sunix_html($desc_styles);?>><?php echo sunix_html($desc); ?></div><?php endif; ?>
            <?php if($use_link) { ?>
                <footer class="red-fancy-footer">
                    <a href="<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" class="<?php echo esc_attr($btn_type); ?>">
                        <span><?php echo esc_html($a_title);?></span>
                    </a>
                </footer>
            <?php } ?>
        </div>


	<?php
			break;
		default:
	?>

        <?php if($add_icon !== 'none') { ?>
            <div class="red-fancy-icon-wrap">
                <?php printf('%s', $fancybox_icon); ?>
            </div>
        <?php } ?>
        <div class="">
            <?php if(!empty($heading)): ?><div class="red-fancybox-heading red-heading" <?php echo sunix_html($heading_styles);?>><?php echo sunix_html($heading); ?></div><?php endif; ?>
            <?php if(!empty($desc)): ?><div class="desc" <?php echo sunix_html($desc_styles);?>><?php echo sunix_html($desc); ?></div><?php endif; ?>
            <?php if($use_link) { ?>
            <footer class="red-fancy-footer">
                <a href="<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>" class="<?php echo esc_attr($btn_type); ?>">
                <span><?php echo esc_html($a_title);?></span>
                </a>
            </footer>
            <?php } ?>
        </div>
	<?php break;
	} ?>
</div>