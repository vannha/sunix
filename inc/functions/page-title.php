<?php
/**
 * All function for page title
*/

/**
 * Page title Layout
*/
function sunix_page_title(){
    $ptitle_layout = sunix_get_opts('ptitle_layout', '1');
    if($ptitle_layout === 'none' || is_404() ) return;
    get_template_part('template-parts/page-title/layout', $ptitle_layout);
}

/**
 * Page title inner class
*/
function sunix_ptitle_inner_class($class=''){
	$classes = ['red-pagetitle-inner'];
	$full = sunix_get_opts('ptitle_full_width', '0');
	if($full === '1')
		$classes[] = 'container-fluid';
	else 
		$classes[] = 'container';

	$classes[] = $class;

	echo trim(implode(' ', $classes));
}
/**
 * Prints HTML for breadcrumbs.
 */
function sunix_breadcrumb($args = [])
{
    if ( ! class_exists( 'sunix_Breadcrumb' ) )
    {
        return;
    }
    $args = wp_parse_args($args, [
        'class'     => '',
        'separator' => ''
    ]);
    $breadcrumb = new sunix_Breadcrumb();
    $entries = $breadcrumb->get_entries();

    if ( empty( $entries ) )
    {
        return;
    }
    $separator = apply_filters('sunix_breadcrumb_separator', $args['separator']);
    ob_start();
    $count = count($entries);
    $d = 0;
    foreach ( $entries as $entry )
    {
    	$d++;
        $entry = wp_parse_args( $entry, array(
            'label' => '',
            'url'   => ''
        ) );

        if ( empty( $entry['label'] ) )
        {
            continue;
        }

        if ( ! empty( $entry['url'] ) )
        {
            printf(
                '<a class="item link" href="%1$s">%2$s</a>',
                esc_url( $entry['url'] ),
                esc_attr( $entry['label'] )
            );
        }
        else
        {
            printf( '<span class="item title" >%s</span>', esc_html( $entry['label'] ) );
        }
        if($d < $count ) echo '<span class="separator">'.$separator.'</span>';
    }

    $output = ob_get_clean();

    if ( $output )
    {
        printf( '<div class="breadcrumb %1$s">%2$s</div>', $args['class'], $output );
    }
}

/**
 * Parallax Image
*/
function sunix_ptitle_parallax_image(){
    $parallax_url = sunix_get_opts('ptitle_parallax',['url'=> get_template_directory_uri().'/assets/images/page-title/bg-pagetitle.png']);
    $titles = sunix_get_page_titles();
    if(!empty($parallax_url)){
        echo '<img src="'.esc_url($parallax_url['url']).'"  alt="" />';
    }

}
