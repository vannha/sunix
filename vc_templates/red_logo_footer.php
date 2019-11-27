<?php 
    
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    if(empty($el_id)) $el_id = uniqid();
    $html_id = 'red-logo-'.$el_id;
    /* Default */

?>
<div id="<?php echo esc_attr($html_id);?>" class="red-logo-element clearfix">
    <?php
    $default_logo = get_template_directory_uri() . '/assets/images/logo.png';
    $logo         = alacarte_get_opts( 'logo', array( 'url' => '', 'id' => '' ) );

    $main_logo = !empty($logo['url']) ? $logo['url'] : $default_logo;
    $page_logo = alacarte_get_opts('page_footer_logo',array( 'url' => '', 'id' => ''));
    if(!empty($page_logo['url'])) {
        $main_logo = $page_logo['url'];
    }
    else if (!empty($logo_footer)){
        $ids1 = explode(',', $logo_footer);
        $image1 = wp_get_attachment_url($ids1[0]);
        $main_logo=$image1;
    }

    ?>
    <div class="footer_logo"><?php
        echo '<a href="' . esc_url(home_url('/')) . '">';
        echo '<img class="main-logo" alt="logo-footer" src="' . esc_url($main_logo) . '"/>';
        echo '</a>';
        ?>
    </div>

</div>