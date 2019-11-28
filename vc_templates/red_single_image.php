<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_single_image
*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
/**
 * html Attributes
 * @var $el_id
 * @var $el_class
*/
if(empty($el_id)) 
	$el_id = uniqid('red-single-image');
else
	$el_id = 'red-single-image'.$el_id;

$wrap_css_class = ['red-single-image','layout-'.$layout_template, $shape, $box_shadow, 'transition', $el_class];
$outline = [
	'square outline',
    'rounded outline',
    'circle outline'
];
if(in_array($shape, $outline)) $wrap_css_class[] = 'outline-'.$box_outline_w;	
/**
 * Images
 * @var $image
 * @var $img_size
 * @var $img_css_class
 * @var $img_src
 * @var $img_attrs
 * @var $img_meta
*/
$img_meta    = get_post( $img_id );
$img_title   = $img_meta->post_title;
$img_caption = $img_meta->post_excerpt;
$img_desc    = $img_meta->post_content;
$img_alt     = !empty(trim( strip_tags( get_post_meta( $img_id, '_wp_attachment_image_alt', true ) ) )) ? trim( strip_tags( get_post_meta( $img_id, '_wp_attachment_image_alt', true ) ) ) : $img_meta->post_title;

$img_css_class = ['red-img', $img_style];
if(in_array($img_style, $outline)) $img_css_class[] = 'outline-'.$img_outline_w;

if(empty($img_id)){
	$img_src = sunix_default_image_thumbnail_url(['size' => $img_size]);
} else {
	$img_src = sunix_get_image_url_by_size(['id'=>$img_id, 'size'=>$img_size]);
}
$img_attrs = [];
if($img_hover_action === 'zoom')
	$img_attrs[] =  'data-zoom="'.sunix_get_image_url_by_size(['id'=>$img_id, 'size'=>'full']).'"';

$image = '<img '.implode(' ', $img_attrs).' src="'.esc_url($img_src).'" alt="'.esc_attr($img_alt).'" />';

// Link 
$link_open = $link_close = '';
/* parse img_link */
if(!empty($img_link)){
    $img_link = vc_build_link( $img_link);
    $img_link = ( $img_link == '||' ) ? '' : $img_link;  
    if ( strlen( $img_link['url'] ) > 0 ) {
        $a_href = $img_link['url'];
        $a_title = !empty($img_link['title']) ? $img_link['title'] : esc_html__('View Detail','sunix');
        $a_target = strlen( $img_link['target'] ) > 0 ? $img_link['target'] : '_self';
        if($img_hover_action === 'custom_link'){
	        $link_open = '<a class="hint--top" href="'.esc_url( $a_href ).'" data-hint="'. esc_attr( $a_title ).'" target="'.trim( esc_attr( $a_target ) ).'">';
	        $link_close = '</a>';
	    }
    }
}
?>
<div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ', $wrap_css_class));?>">
	<div class="red-single-image-inner">
		<div class="<?php echo trim(implode(' ', $img_css_class));?>">
			<?php echo ''.$link_open.$image.$link_close; ?>
		</div>
		<?php if('1' === $img_show_caption && !empty($img_caption)) echo sunix_html('<div class="red-img-caption">'.$img_caption.'</div>'); ?>
	</div>
</div>
