<?php
/**
 * Page title class for the theme.
 * 
 * @package AlaCarte
 * @subpackage AlaCarte
 * @since 1.0.0
 * @author EF5 Team
 */

if ( ! defined( 'ABSPATH' ) )
{
    die();
}

/**
 * Get page title and description.
 *
 * @return array Contains 'title' and 'desc'
 */
function alacarte_get_page_titles()
{
    $title = $desc = '';
    // Default titles
    if (!is_archive()) {
        // Posts / page view
        if (is_home()) {

            $page_for_posts = get_option('page_for_posts');
            // Only available if posts page is set.
            if (!is_front_page() && $page_for_posts ) {
                $title = get_the_title($page_for_posts);
                $desc = get_post_meta($page_for_posts, 'page_desc', true);
            } else {
                $title = get_bloginfo('name');
                $desc = get_bloginfo('description');
            }
        }
        // Single page view
        elseif (is_singular()) {
            $title = get_post_meta(get_the_ID(), 'custom_title', true);
            if (!$title) {
                if (is_singular('post')){
                    $title = esc_html__('Single Post','alacarte');
                }
                else{
                    $title= get_the_title();
                }

            }
            $desc = get_post_meta(get_the_ID(), 'custom_desc', true);
            /* Single Events */
            if ( is_singular( 'event' ) ) {
                $title = esc_html__('Event Details', 'alacarte');

            }
           if(is_singular('product') ){
               $title = esc_html__( 'Shop Single', 'alacarte' );
           }

        }

        // 404
        elseif (is_404()) {
            $title = alacarte_get_opts('ptitle_404_title', esc_html__('Error 404', 'alacarte'));
        } 
        // Search result
        elseif (is_search()) {
            $title = esc_html__('Search results', 'alacarte');
            $desc = esc_html__('You searched for:','alacarte').' "'. get_search_query(). '" ';
        } 
        // Anything else
        else {
            $title = get_the_title();
        }
    } elseif (function_exists('is_shop') && is_shop()){
        $title = get_the_title(get_option('woocommerce_shop_page_id'));
        $desc  = get_the_archive_description();
    } else {
		$title = get_the_archive_title();
		$desc  = get_the_archive_description();
    }
    return array(
        'title' => $title,
        'desc'  => $desc
    );
}