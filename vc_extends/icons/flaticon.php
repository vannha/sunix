<?php
/* Load Flat Icon Font.
 *
 * https://www.flaticon.com/collections/NTY1NjU5OQ==
 *
 */
add_filter( 'vc_iconpicker-type-flaticon', 'vc_iconpicker_type_flaticon_icons' );
function vc_iconpicker_type_flaticon_icons( $icons ) {
	$flaticon = array(
		array('flaticon-small-calendar'                             => esc_html__('calendar','alacarte')),
		array('flaticon-angle-arrow-down'                             => esc_html__('arrow down','alacarte')),
		array('flaticon-arrow'                             => esc_html__('arrow','alacarte')),
array('flaticon-cart'                             => esc_html__('cart','alacarte')),
array('flaticon-world'                             => esc_html__('world','alacarte')),
array('flaticon-shuffle'                             => esc_html__('shuffle','alacarte')),
array('flaticon-up-and-down-opposite-double-arrows-side-by-side'                             => esc_html__('double arrows','alacarte')),
array('flaticon-arrow-1'                             => esc_html__('arrow 1','alacarte')),
array('flaticon-back-arrow'                             => esc_html__('back arrow','alacarte')),
array('flaticon-down-arrow-of-angle'                             => esc_html__('down arrow','alacarte')),
array('flaticon-show-more-button'                             => esc_html__('show more button','alacarte')),
array('flaticon-clock'                             => esc_html__('clock','alacarte')),
array('flaticon-arrow-pointing-to-right'                             => esc_html__('arrow pointing to right','alacarte')),
array('flaticon-menu'                             => esc_html__('location pin','alacarte')),
array('flaticon-supermarket'                             => esc_html__('supermarket','alacarte')),
array('flaticon-ribbon'                             => esc_html__('ribbon','alacarte')),
array('flaticon-clock-1'                             => esc_html__('clock 1','alacarte')),
array('flaticon-magnifying-glass'                             => esc_html__('magnifying glass','alacarte')),
array('flaticon-down-arrow'                             => esc_html__('down arrow','alacarte')),
array('flaticon-menu-1'                             => esc_html__('menu 1','alacarte')),
array('flaticon-placeholder'                             => esc_html__('placeholder','alacarte')),
array('flaticon-reload'                             => esc_html__('reload','alacarte')),
array('flaticon-shopping-bag'                             => esc_html__('shopping bag','alacarte')),
array('flaticon-contact'                             => esc_html__('contact','alacarte')),
array('flaticon-comment'                             => esc_html__('comment','alacarte')),
array('flaticon-comment-1'                             => esc_html__('comment1','alacarte')),
array('flaticon-organic'                             => esc_html__('organic','alacarte')),
array('flaticon-shopping-store'                             => esc_html__('shopping store','alacarte')),
array('flaticon-share'                             => esc_html__('share','alacarte')),
array('flaticon-heart'                             => esc_html__('heart','alacarte')),
array('flaticon-star'                             => esc_html__('star','alacarte')),
array('flaticon-gear'                             => esc_html__('gear','alacarte')),
array('flaticon-play-button'                             => esc_html__('play button','alacarte')),
array('flaticon-add'                             => esc_html__('add','alacarte')),
array('flaticon-substract'                             => esc_html__('substract','alacarte')),
array('flaticon-like'                             => esc_html__('like','alacarte')),
array('flaticon-search'                             => esc_html__('search','alacarte')),
array('flaticon-telephone'                             => esc_html__('telephone','alacarte')),
array('flaticon-worlwide'                             => esc_html__('worlwide','alacarte')),
array('flaticon-layers'                             => esc_html__('layers','alacarte')),
array('flaticon-down-arrow-1'                             => esc_html__('down arrow 1','alacarte')),
array('flaticon-left-arrow'                             => esc_html__('left arrow','alacarte')),
array('flaticon-up-arrow'                             => esc_html__('up arrow','alacarte')),
array('flaticon-cutlery'                             => esc_html__('cutlery','alacarte')),
array('flaticon-family'                             => esc_html__('family','alacarte')),
array('flaticon-link'                             => esc_html__('link','alacarte')),
array('flaticon-menu-3'                             => esc_html__('menu 3','alacarte')),
array('flaticon-pdf'                             => esc_html__('pdf','alacarte')),
array('flaticon-balloons'                             => esc_html__('balloons','alacarte')),
array('flaticon-bouquet'                             => esc_html__('bouquet','alacarte')),
array('flaticon-music'                             => esc_html__('music','alacarte')),
array('flaticon-birthday'                             => esc_html__('birthday','alacarte')),
array('flaticon-global'                             => esc_html__('global','alacarte')),
array('flaticon-placeholder-1'                             => esc_html__('placeholder 1','alacarte')),
array('flaticon-food'                             => esc_html__('flaticon food','alacarte')),
array('flaticon-shopping-cart'                             => esc_html__('shopping cart','alacarte')),
array('flaticon-instagram'                             => esc_html__('instagram','alacarte')),
array('flaticon-coffee-bean'                             => esc_html__('coffee bean','alacarte')),
array('flaticon-pin'                             => esc_html__('pin','alacarte')),
array('flaticon-confetti'                             => esc_html__('confetti','alacarte')),
array('flaticon-fork'                             => esc_html__('fork','alacarte')),
array('flaticon-guitar'                             => esc_html__('guitar','alacarte')),
array('flaticon-user'                             => esc_html__('user','alacarte')),
array('flaticon-champagne-glass'                             => esc_html__('champagne glass','alacarte')),
array('flaticon-language'                             => esc_html__('language','alacarte')),
array('flaticon-recipe-book'                             => esc_html__('recipe book','alacarte')),
array('flaticon-coffee-bag'                             => esc_html__('coffee bag','alacarte')),
array('flaticon-coffee-maker'                             => esc_html__('coffee maker','alacarte')),
array('flaticon-coffee-plant'                             => esc_html__('coffee plant','alacarte')),
array('flaticon-coffee-pot'                             => esc_html__('coffee pot','alacarte')),
array('flaticon-fruit'                             => esc_html__('fruit','alacarte')),
array('flaticon-plate'                             => esc_html__('plate','alacarte')),
array('flaticon-drops'                             => esc_html__('drops','alacarte')),
array('flaticon-book'                             => esc_html__('book','alacarte')),
array('flaticon-straight-quotes'                             => esc_html__('straight quotes','alacarte')),
array('flaticon-view'                             => esc_html__('view','alacarte')),
array('flaticon-tag'                             => esc_html__('tag','alacarte')),
array('flaticon-right-arrow-forward'             => esc_html__('right arrow forward','alacarte')),
array('flaticon-pizza'             => esc_html__('pizza','alacarte')),);
	return array_merge( $icons, $flaticon );
}