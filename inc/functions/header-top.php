<?php
/**
 * Header Top
 * Need add custom post type: header_top
 *
*/
if(!function_exists('alacarte_header_top')){
    function alacarte_header_top($class = ''){
        $classes = array();
        $classes[] = $class;
        $header_top = alacarte_get_opts('header_top', '');
        $header_enable = alacarte_get_opts('header_top_enable', '');
        if (is_singular() && !is_page()){
            $header_top = alacarte_get_opts('single_header_top', '');
        }
        if(empty($header_top) || 'none' === $header_top || is_404()) return;
        if ($header_enable=='0') return;
    ?>
        <div id="red-header-top" class="red-header-top <?php echo trim(implode(' ',$classes));?>">
        	<?php alacarte_content_by_slug($header_top,'ef5_header_top'); ?>
        </div>
    <?php
    }
}