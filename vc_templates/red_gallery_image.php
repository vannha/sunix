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

$wrap_css_class = ['red-single-image', 'transition', $el_class];
/**
 * Images
 * @var $image
 * @var $img_size
 * @var $img_css_class
 * @var $img_src
 * @var $img_attrs
 * @var $img_meta
*/
$image_ids=explode(',',$img_id);
// Masonry
$originLeft = is_rtl() ? false : true;
$masonry_opts = array();
if (($layout_template !='6') && ($layout_template !='5')){
    $masonry_opts = array(
        'itemSelector'    => '.red-masonry-item',
        'columnWidth'     => '.red-masonry-sizer',
        'gutter'          => '.red-masonry-gutter',
        'percentPosition' => true,
        'originLeft'      => $originLeft,
        'horizontalOrder' => true,

    );
}
switch ($layout_template) {
    case '3':
        $item_class='col-md-4';
        break;
    case '4':
        $item_class='col-md-6';
        break;
    default:
        $item_class='col-md-3';
        break;
}

?>
<div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ', $wrap_css_class));?>">
	<div class="red-gallery-images <?php if (($layout_template !='6') && ($layout_template !='5')) echo 'red-masonry row'?> red-gallery layout-<?php echo esc_attr($layout_template);?>" <?php if (($layout_template !='6') && ($layout_template !='5')){echo 'data-masonry="'.esc_attr(json_encode($masonry_opts)).'"';}?>>
        <?php if (($layout_template !='6') && ($layout_template !='5'))  { ?>
        <div class="red-masonry-sizer"></div>
		<div class="red-masonry-gutter"></div>
        <?php } ?>

		<?php
        switch ($layout_template) {
            case '6':
                ?>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="item-1">
                            <div class="red-img red-masonry-item">
                                <?php  $image_url1 = wp_get_attachment_image_src($image_ids[0], 'full'); ?>
                                <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url1[0]);?>);">
                                    <a class="light-box" href="<?php echo esc_url($image_url1[0]);?>" >
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="item-2">
                                    <div class="red-img red-masonry-item ">
                                        <?php  $image_url2 = wp_get_attachment_image_src($image_ids[1], 'full'); ?>
                                        <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url2[0]);?>);">
                                            <a class="light-box" href="<?php echo esc_url($image_url2[0]);?>" >
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="item-3">
                                    <div class="red-img red-masonry-item ">
                                        <?php  $image_url3 = wp_get_attachment_image_src($image_ids[2], 'full'); ?>
                                        <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url3[0]);?>);">
                                            <a class="light-box" href="<?php echo esc_url($image_url3[0]);?>" >
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="item-4">
                            <div class="red-img red-masonry-item ">
                                <?php  $image_url4 = wp_get_attachment_image_src($image_ids[3], 'full'); ?>
                                <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url4[0]);?>);">
                                    <a class="light-box" href="<?php echo esc_url($image_url4[0]);?>" >
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item-5">
                            <div class="red-img red-masonry-item ">
                                <?php  $image_url5 = wp_get_attachment_image_src($image_ids[4], 'full'); ?>
                                <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url5[0]);?>);">
                                    <a class="light-box" href="<?php echo esc_url($image_url5[0]);?>" >
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <?php $i=0; foreach( $image_ids as $image_id ){
                        $i++;
                        $image_url=wp_get_attachment_image_src( $image_id, 'full' );
                        if ($i>5){
                            ?>
                            <div class="red-img red-masonry-item col-12 col-md-3">
                                <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url[0]);?>);">
                                    <a class="light-box" href="<?php echo esc_url($image_url[0]);?>" >
                                    </a>
                                </div>
                            </div>
                        <?php } }?>
                </div>
                <?php break;
            case '5':
            ?>
                <div class="row">
                    <div class="col-item1">
                       <div class="item-1">
                           <div class="red-img red-masonry-item">
                               <?php  $image_url1 = wp_get_attachment_image_src($image_ids[0], 'full'); ?>
                               <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url1[0]);?>);">
                                   <a class="light-box" href="<?php echo esc_url($image_url1[0]);?>" >
                                   </a>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="col-item-2">
                        <div class="item-2">
                            <div class="red-img red-masonry-item ">
                                <?php  $image_url2 = wp_get_attachment_image_src($image_ids[1], 'full'); ?>
                                <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url2[0]);?>);">
                                    <a class="light-box" href="<?php echo esc_url($image_url2[0]);?>" >
                                    </a>
                                </div>
                            </div>
                        </div>
                       <div class="row">
                           <div class="col-12 col-md-6">
                               <div class="item-3">
                                   <div class="red-img red-masonry-item">
                                       <?php  $image_url3 = wp_get_attachment_image_src($image_ids[2], 'full'); ?>
                                       <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url3[0]);?>);">
                                           <a class="light-box" href="<?php echo esc_url($image_url3[0]);?>" >
                                           </a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-12 col-md-6">
                               <div class="item-4">
                                   <div class="red-img red-masonry-item">
                                       <?php  $image_url4 = wp_get_attachment_image_src($image_ids[3], 'full'); ?>
                                       <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url4[0]);?>);">
                                           <a class="light-box" href="<?php echo esc_url($image_url4[0]);?>" >
                                           </a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="col-item-3">
                        <div class="item-5">
                            <div class="red-img red-masonry-item">
                                <?php  $image_url5 = wp_get_attachment_image_src($image_ids[4], 'full'); ?>
                                <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url5[0]);?>);">
                                    <a class="light-box" href="<?php echo esc_url($image_url5[0]);?>" >
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                     <?php $i=0; foreach( $image_ids as $image_id ){
                         $i++;
                         $image_url=wp_get_attachment_image_src( $image_id, 'full' );
                         if ($i>5){
                         ?>
                         <div class="red-img red-masonry-item col-12 col-md-3">
                             <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url[0]);?>);">
                                 <a class="light-box" href="<?php echo esc_url($image_url[0]);?>" >
                                 </a>
                             </div>
                         </div>
                     <?php } }?>
                  </div>
               <?php break;
            default:
                foreach( $image_ids as $image_id ){
                    $image_url=wp_get_attachment_image_src( $image_id, 'full' )
                    ?>
                    <div class="red-img red-masonry-item <?php echo esc_attr($item_class);?>">
                        <div class="gallery-item" style="background-image:url(<?php echo esc_attr($image_url[0]);?>);">
                            <a class="light-box" href="<?php echo esc_url($image_url[0]);?>" >
                            </a>
                        </div>
                    </div>
                <?php }
                break;
        }
		?>

	</div>
</div>
