<?php
	vc_map( array(
		"name"            => 'Red Reservation ',
		"base"            => "reservation",
		'icon'         => 'red_el_icon',
		"category"        => esc_html__( 'RedExp', 'alacarte' ),
		"params" => array(
		),
	) );
	
	class WPBakeryShortCode_red_reservation extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			return parent::content( $atts, $content );
		}
	}

?>