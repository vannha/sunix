<?php
/* Load Linear Icons (lnr) Icon Font.
 *
 * https://linearicons.com/free
 *
 * @param $icons - taken from filter - vc_map param field settings['source'] provided icons (default empty array).
 * If array categorized it will auto-enable category dropdown
 *
 * @since 1.0
 * @return array - of icons for iconpicker, can be categorized, or not.
 */
add_filter( 'vc_iconpicker-type-etline', 'vc_iconpicker_type_etline_icons' );

function vc_iconpicker_type_etline_icons( $icons ) {
	$etline_icons = array(
		array('icon-mobile'           => esc_html('icon-mobile')),
		array('icon-laptop'           => esc_html('icon-laptop')),
		array('icon-desktop'          => esc_html('icon-desktop')),
		array('icon-tablet'           => esc_html('icon-tablet')),
		array('icon-phone'            => esc_html('icon-phone')),
		array('icon-document'         => esc_html('icon-document')),
		array('icon-documents'        => esc_html('icon-documents')),
		array('icon-search'           => esc_html('icon-search')),
		array('icon-clipboard'        => esc_html('icon-clipboard')),
		array('icon-newspaper'        => esc_html('icon-newspaper')),
		array('icon-notebook'         => esc_html('icon-notebook')),
		array('icon-book-open'        => esc_html('icon-book-open')),
		array('icon-browser'          => esc_html('icon-browser')),
		array('icon-calendar'         => esc_html('icon-calendar')),
		array('icon-presentation'     => esc_html('icon-presentation')),
		array('icon-picture'          => esc_html('icon-picture')),
		array('icon-pictures'         => esc_html('icon-pictures')),
		array('icon-video'            => esc_html('icon-video')),
		array('icon-camera'           => esc_html('icon-camera')),
		array('icon-printer'          => esc_html('icon-printer')),
		array('icon-toolbox'          => esc_html('icon-toolbox')),
		array('icon-briefcase'        => esc_html('icon-briefcase')),
		array('icon-wallet'           => esc_html('icon-wallet')),
		array('icon-gift'             => esc_html('icon-gift')),
		array('icon-bargraph'         => esc_html('icon-bargraph')),
		array('icon-grid'             => esc_html('icon-grid')),
		array('icon-expand'           => esc_html('icon-expand')),
		array('icon-focus'            => esc_html('icon-focus')),
		array('icon-edit'             => esc_html('icon-edit')),
		array('icon-adjustments'      => esc_html('icon-adjustments')),
		array('icon-ribbon'           => esc_html('icon-ribbon')),
		array('icon-hourglass'        => esc_html('icon-hourglass')),
		array('icon-lock'             => esc_html('icon-lock')),
		array('icon-megaphone'        => esc_html('icon-megaphone')),
		array('icon-shield'           => esc_html('icon-shield')),
		array('icon-trophy'           => esc_html('icon-trophy')),
		array('icon-flag'             => esc_html('icon-flag')),
		array('icon-map'              => esc_html('icon-map')),
		array('icon-puzzle'           => esc_html('icon-puzzle')),
		array('icon-basket'           => esc_html('icon-basket')),
		array('icon-envelope'         => esc_html('icon-envelope')),
		array('icon-streetsign'       => esc_html('icon-streetsign')),
		array('icon-telescope'        => esc_html('icon-telescope')),
		array('icon-gears'            => esc_html('icon-gears')),
		array('icon-key'              => esc_html('icon-key')),
		array('icon-paperclip'        => esc_html('icon-paperclip')),
		array('icon-attachment'       => esc_html('icon-attachment')),
		array('icon-pricetags'        => esc_html('icon-pricetags')),
		array('icon-lightbulb'        => esc_html('icon-lightbulb')),
		array('icon-layers'           => esc_html('icon-layers')),
		array('icon-pencil'           => esc_html('icon-pencil')),
		array('icon-tools'            => esc_html('icon-tools')),
		array('icon-tools-2'          => esc_html('icon-tools-2')),
		array('icon-scissors'         => esc_html('icon-scissors')),
		array('icon-paintbrush'       => esc_html('icon-paintbrush')),
		array('icon-magnifying-glass' => esc_html('icon-magnifying-glass')),
		array('icon-circle-compass'   => esc_html('icon-circle-compass')),
		array('icon-linegraph'        => esc_html('icon-linegraph')),
		array('icon-mic'              => esc_html('icon-mic')),
		array('icon-strategy'         => esc_html('icon-strategy')),
		array('icon-beaker'           => esc_html('icon-beaker')),
		array('icon-caution'          => esc_html('icon-caution')),
		array('icon-recycle'          => esc_html('icon-recycle')),
		array('icon-anchor'           => esc_html('icon-anchor')),
		array('icon-profile-male'     => esc_html('icon-profile-male')),
		array('icon-profile-female'   => esc_html('icon-profile-female')),
		array('icon-bike'             => esc_html('icon-bike')),
		array('icon-wine'             => esc_html('icon-wine')),
		array('icon-hotairballoon'    => esc_html('icon-hotairballoon')),
		array('icon-globe'            => esc_html('icon-globe')),
		array('icon-genius'           => esc_html('icon-genius')),
		array('icon-map-pin'          => esc_html('icon-map-pin')),
		array('icon-dial'             => esc_html('icon-dial')),
		array('icon-chat'             => esc_html('icon-chat')),
		array('icon-heart'            => esc_html('icon-heart')),
		array('icon-cloud'            => esc_html('icon-cloud')),
		array('icon-upload'           => esc_html('icon-upload')),
		array('icon-download'         => esc_html('icon-download')),
		array('icon-target'           => esc_html('icon-target')),
		array('icon-hazardous'        => esc_html('icon-hazardous')),
		array('icon-piechart'         => esc_html('icon-piechart')),
		array('icon-speedometer'      => esc_html('icon-speedometer')),
		array('icon-global'           => esc_html('icon-global')),
		array('icon-compass'          => esc_html('icon-compass')),
		array('icon-lifesaver'        => esc_html('icon-lifesaver')),
		array('icon-clock'            => esc_html('icon-clock')),
		array('icon-aperture'         => esc_html('icon-aperture')),
		array('icon-quote'            => esc_html('icon-quote')),
		array('icon-scope'            => esc_html('icon-scope')),
		array('icon-alarmclock'       => esc_html('icon-alarmclock')),
		array('icon-refresh'          => esc_html('icon-refresh')),
		array('icon-happy'            => esc_html('icon-happy')),
		array('icon-sad'              => esc_html('icon-sad')),
		array('icon-facebook'         => esc_html('icon-facebook')),
		array('icon-twitter'          => esc_html('icon-twitter')),
		array('icon-googleplus'       => esc_html('icon-googleplus')),
		array('icon-rss'              => esc_html('icon-rss')),
		array('icon-tumblr'           => esc_html('icon-tumblr')),
		array('icon-linkedin'         => esc_html('icon-linkedin')),
		array('icon-dribbble'         => esc_html('icon-dribbble')),
	);
	return array_merge( $icons, $etline_icons );
}