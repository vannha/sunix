<?php
if(isset($args)){
    $titles = [
        'title' => $args['title'],
        'desc'  => $args['desc']
    ];
    $show_breadcrumb = $args['show_breadcrumb'];
    $ptitle_layout = $args['ptitle_layout'];
} else {
   $titles = sunix_get_page_titles();
   $show_breadcrumb = sunix_get_opts( 'breadcrumb_on', '1' );
   $ptitle_layout = sunix_get_opts('ptitle_layout','1');
}


$pt_cls = array(
    'red-pagetitle',
    'ptitle-layout-'.$ptitle_layout
);
$title_css_class = ['col-12', 'text-lg-center'];

if(!$show_breadcrumb) {
    $pt_cls[] = 'no-breadcrumb';
} 
if($show_breadcrumb && (!is_home() || !is_front_page())) {
    $title_css_class[] = 'col-lg-12';
}
$show_bg_image = sunix_get_opts( 'pagetitle_image_bg', '0' );
var_dump($show_bg_image);
?>
<div class="red-pagetitle-wrap <?php if($show_bg_image == '0'){ echo 'no-image';}?>">
    <div class="<?php echo implode(' ', $pt_cls);?>">
        <?php if($show_bg_image =='1'){?>
            <div class="parallax"><?php sunix_ptitle_parallax_image(); ?></div>
        <?php }?>
        <div class="<?php sunix_ptitle_inner_class();?>">
            <div class="row align-items-center">
                <div class="title-wrap <?php echo trim(implode(' ', $title_css_class));?>">
                    <?php
                    if (is_front_page()){
                        printf( '<div class="page-title h1">%s</div>', esc_html('Blog','sunix'));
                    }
                    elseif ( $titles['title'] )
                    {
                        printf( '<div class="page-title h1">%s</div>', $titles['title']);
                    }

                    ?>

                </div>
                <?php if($show_breadcrumb && (!is_home() || !is_front_page())) { ?>
                <div class="red-breadcrumb col-lg-12">
                    <?php
                    sunix_breadcrumb(['class'=>'']);
                
                    ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>