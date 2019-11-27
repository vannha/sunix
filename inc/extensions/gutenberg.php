<?php
/**
 * Theme Option support Gutenberg
 * @since 1.0
*/
function alacarte_gtb(){
	$gutenberg = alacarte_get_theme_opt('gutenberg', true);
	if(!$gutenberg){
		add_filter('use_block_editor_for_post', function(){ return false;});
		add_filter('ef5_support_gtb', function(){ return false;});
	}
	return $gutenberg;
}
add_action('after_setup_theme','alacarte_gtb');

/**
 * Remove Gutenberg Editor button of VC when Classic Editor actived
 * or theme option is Disable
*/
add_action('admin_head',function(){
	if(class_exists('Classic_Editor') || class_exists('QTX_Translator') || !alacarte_gtb() ) :
    ?>
    <style>.wpb_switch-to-gutenberg{ display: none !important;}</style>
    <?php
	endif;
});

/**
 * Remove Gutenberg when active qTranslate-X
 * @since 1.0
*/
if(class_exists('QTX_Translator')){
	add_filter('use_block_editor_for_post', function(){ return false; });
}

add_filter('render_block', 'alacarte_guten_render_block', 10, 2);
function alacarte_guten_render_block( $block_content,  $block){
    $wpb_js_gutenberg_disable = get_option( 'wpb_js_gutenberg_disable', '0' );
    if(!alacarte_gtb() || class_exists('Classic_Editor') || $wpb_js_gutenberg_disable == '1' )
        return $block_content;
    $extra_css_class = ['red-gtb-block'];
    $change_class = [
        'core/separator',
        'core/quote',
        'core/button',
        'core/audio',
        'core/columns',
        'core/column',
        'core/pullquote',
        'core/cover',
        'core/cover-image',
        'core/image',
        'core/media-text',
    ];
    if(in_array($block['blockName'], $change_class)){
        $extra_css_class[]  = 'red-block-'.str_replace('core/','', $block['blockName']);
    } else {
        $extra_css_class[]  = 'wp-block-'.str_replace('core/','', $block['blockName']);
    }

    if(isset($block['attrs']['align']) && ($block['attrs']['align'] === 'wide' || $block['attrs']['align'] == 'center') ) {
        $extra_css_class[] = 'align-'.$block['attrs']['align'];
    }
    if(isset($block['attrs']['align']) && ($block['attrs']['align'] === 'left' || $block['attrs']['align'] == 'right') ) {
        $extra_css_class[] = 'align-'.$block['attrs']['align'];
    }

    if(strlen($block_content) > 2 && $block['blockName'] !== 'core/column' )
        $block_content = '<div class="'.trim(implode(' ', $extra_css_class)).'">'.$block_content.'</div>';
    return $block_content;
}
add_action('after_setup_theme', 'alacarte_theme_suport_gtb_styles');

function alacarte_remove_gtb_script()
{
    return array('wp-block-library');
}
function alacarte_theme_suport_gtb_styles(){
    if(!alacarte_gtb()) {
        add_filter('ef5_remove_scripts', function($scripts){ $scripts[] = 'wp-block-library'; return $scripts; });
        return;
    }
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'alacarte_theme_suport_gtb_styles' );