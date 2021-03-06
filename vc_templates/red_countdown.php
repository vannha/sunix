<?php
	if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_countdown
 */
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
	extract( $atts );

	$time = strtotime($time);
	$date_sever = date_i18n('Y-m-d G:i:s');   
	$gmt_offset = get_option( 'gmt_offset' );
	/* check if current time from config is empty or less than current time 
	 * && (strtotime($time) < strtotime('now'))
	 */
	if(empty($time)) $time = strtotime("+22 days 18 hours 30 minutes 55 seconds");

	$wrap_css_class = ['red-countdown','layout-'.$layout_template, $color, $shape, $size];

?>
	<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
		<div class="red-countdown-bar red-countdown-time" data-count="<?php echo esc_attr(date('Y,m,d,H,i,s', $time)); ?>" data-format="<?php echo esc_attr($time_format);?>" data-label="<?php echo esc_attr($time_label);?>" data-timezone="<?php echo esc_attr($gmt_offset); ?>"></div>
    </div>

         


