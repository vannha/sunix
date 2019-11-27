<?php
/**
 * AlaCarte
 */
$header_social = alacarte_get_opts( 'header_social', '0' );

if($header_social === '0') return;

$header_layout = alacarte_get_opts('header_layout', '1');
$classes = ['header-socials col-auto'];

if(!empty(alacarte_get_theme_opt('social_facebook_url')) || !empty(alacarte_get_theme_opt('social_twitter_url')) || !empty(alacarte_get_theme_opt('social_inkedin_url')) || !empty(alacarte_get_theme_opt('social_instagram_url')) || !empty(alacarte_get_theme_opt('social_google_url')) || !empty(alacarte_get_theme_opt('social_pinterest_url')) || !empty(alacarte_get_theme_opt('social_skype_url')) || !empty(alacarte_get_theme_opt('social_vimeo_url')) || !empty(alacarte_get_theme_opt('social_youtube_url')) || !empty(alacarte_get_theme_opt('social_yelp_url')) || !empty(alacarte_get_theme_opt('social_tumblr_url')) || !empty(alacarte_get_theme_opt('social_tripadvisor_url')) ) :
?>
<div class="header-social">
    <?php
    if(!empty(alacarte_get_theme_opt('social_facebook_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_facebook_url')); ?>" target="_blank">
            <i class="fab fa-facebook-f"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_twitter_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_twitter_url')); ?>" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_inkedin_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_inkedin_url')); ?>" target="_blank">
            <i class="fab fa-linkedin"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_instagram_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_instagram_url')); ?>" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_google_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_google_url')); ?>" target="_blank">
            <i class="fab fa-google-plus-g"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_pinterest_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_pinterest_url')); ?>" target="_blank">
            <i class="fab fa-pinterest-p"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_skype_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_skype_url')); ?>" target="_blank">
            <i class="fab fa-heart"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_vimeo_url'))) { ?>
        <a class="header-icon" href="http://<?php echo esc_url(alacarte_get_theme_opt('social_vimeo_url')); ?>" target="_blank">
            <i class="fab fa-tumblr"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_youtube_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_youtube_url')); ?>" target="_blank">
            <i class="fab fa-youtube"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_yelp_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_yelp_url')); ?>" target="_blank">
            <i class="fab fa-yelp"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_tumblr_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_tumblr_url')); ?>" target="_blank">
            <i class="fab fa-tumblr"></i>
        </a>
    <?php }
    if(!empty(alacarte_get_theme_opt('social_tripadvisor_url'))) { ?>
        <a class="header-icon" href="<?php echo esc_url(alacarte_get_theme_opt('social_tripadvisor_url')); ?>" target="_blank">
            <i class="fab fa-tripadvisor"></i>
        </a>
    <?php } 
endif;?>
</div>
