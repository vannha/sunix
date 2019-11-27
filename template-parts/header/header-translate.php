<?php
/**
 * AlaCarte
 */
$header_translate = alacarte_get_opts( 'header_translate', '0' );

if($header_translate === '0') return;
?>
<div class="header-translate header-icon">
    <?php echo do_shortcode('[gtranslate]') ?>
</div>
