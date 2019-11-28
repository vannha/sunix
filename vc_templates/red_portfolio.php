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
	$el_id = uniqid('red-portfolio');
else
	$el_id = 'red-portfolio'.$el_id;

$wrap_css_class = ['red-portfolio', 'transition', $el_class];
/**
 * Images
 * @var $image
 * @var $img_size
 * @var $img_css_class
 * @var $img_src
 * @var $img_attrs
 * @var $img_meta
*/
// Masonry
$originLeft = is_rtl() ? false : true;
$masonry_opts = array(
	'itemSelector'    => '.red-masonry-item',
	'columnWidth'     => '.red-masonry-sizer',
	'gutter'          => '.red-masonry-gutter',
	'percentPosition' => true,
	'originLeft'      => $originLeft,
	'horizontalOrder' => true,

);
$args = array(
    'post_type'           => 'portfolio',
    'posts_per_page'      => $posts_per_page,
    'ignore_sticky_posts' => 1,
);
$posts = new WP_Query($args);
?>
<div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ', $wrap_css_class));?>">
	<div class="red-portfolios red-masonry row red-gallery " data-masonry="<?php echo esc_attr(json_encode($masonry_opts));?>">
		<div class="red-masonry-sizer"></div>
		<div class="red-masonry-gutter"></div>
        <?php if ($posts -> have_posts() )  : ?>
                <?php
                while ( $posts -> have_posts() ) : $posts -> the_post();
                    $portfolio_style = sunix_get_post_format_value('portfolio_style','');
                    $portfolio_subtitle = sunix_get_post_format_value('portfolio_subtitle','');
                    $portfolio_link = sunix_get_post_format_value('portfolio_link','');
                    switch ($portfolio_style) {
                        case '2':
                            $item_class='col-md-6';
                            break;
                        default:
                            $item_class='col-md-6 col-lg-3';
                            break;
                    }

                ?>
                <div class="red-blog-item red-masonry-item layout-item-<?php echo esc_attr($portfolio_style);?> <?php echo esc_attr($item_class);?>">
                        <div class=" cms-grid-item-inner">
                            <div class="red-blog-post-thumbnail">
                                <?php
                                sunix_post_media([
                                    'class'          => 'margin-0',
                                    'default_thumb'  => true,
                                    'thumbnail_size' => 'large'
                                ]);
                                ?>
                            </div>
                            <div class="content-right">
                                <div class="content-main">
                                    <?php if (!empty($portfolio_subtitle)){?>
                                        <div class="subtitle">
                                            <?php echo esc_html($portfolio_subtitle);?>
                                        </div>
                                    <?php }?>
                                    <h3 class="portfolio-title">
                                        <?php the_title(); ?>
                                    </h3>
                                    <i class="flaticon-ribbon"></i>
                                    <?php if (!empty($portfolio_link)){?>
                                        <div class="portfolio-footer">
                                            <a class="red-btn primary fill" href="<?php echo esc_url( get_page_link($portfolio_link[0] ) ); ?>"><?php echo esc_html__('Read More','sunix');?></a>
                                        </div>
                                    <?php }?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
        <?php
        endif;
    ?>
	</div>
</div>
