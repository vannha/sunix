<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_heading
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrap_css_class = ['red-heading-wrap','red-heading-'.$layout_template, $content_align, $el_class];
// Small Heading 
$small_heading_attrs = $small_heading_css = [];
$small_heading_css_class = [
	'small-heading',
];
$small_heading_attrs[] = 'class="'.sunix_optimize_css_class(implode(' ', $small_heading_css_class)).'"';

if(!empty($small_heading_color)) $small_heading_css[] = 'color:'.$small_heading_color;
$small_heading_attrs[] = 'style="'.trim(implode(';',$small_heading_css)).'"';
// Heading 
$heading_attrs = $heading_css = [];

$heading_css_class = [
	'heading',
	'red-heading',
	!empty($heading_style) ? 'font-style-'.$heading_style : '', 
	!empty($heading_text_transform) ? 'text-'.$heading_text_transform : '',
	!empty($heading_font_color) ? 'text-'.$heading_font_color : '',
];
$heading_attrs[] = 'class="'.sunix_optimize_css_class(implode(' ', $heading_css_class)).'"';
if(!empty($heading_size)) $heading_css[]           = 'font-size:'.(int)$heading_size.'px'; 
if(!empty($heading_color)) $heading_css[]          = 'color:'.$heading_color;
if(!empty($heading_letter_spacing)) $heading_css[] = 'letter-spacing:'.(int)$heading_letter_spacing.'px';
if(!empty($heading_line_height)) $heading_css[]    = 'line-height:'.$heading_line_height;
if(!empty($heading_css)) 
	$heading_attrs[] = 'style="'.trim(implode(';',$heading_css)).'"';
// Heading 2
$heading2_attrs = $heading2_css = [];
$heading2_css_class = [
    'heading',
   'red-heading',
    !empty($heading2_style) ? 'font-style-'.$heading2_style : '', 
    !empty($heading2_text_transform) ? 'text-'.$heading2_text_transform : '',
    !empty($heading2_font_color) ? 'text-'.$heading2_font_color : ''
];
$heading2_attrs[] = 'class="'.sunix_optimize_css_class(implode(' ', $heading2_css_class)).'"';
if(!empty($heading2_size)) $heading2_css[]           = 'font-size:'.(int)$heading2_size.'px'; 
if(!empty($heading2_color)) $heading2_css[]          = 'color:'.$heading2_color;
if(!empty($heading2_letter_spacing)) $heading2_css[] = 'letter-spacing:'.(int)$heading2_letter_spacing.'px';
if(!empty($heading2_line_height)) $heading2_css[]    = 'line-height:'.$heading2_line_height;
if(!empty($heading2_css)) 
    $heading2_attrs[] = 'style="'.trim(implode(';',$heading2_css)).'"';
// Description 
$desc_attrs = $desc_css = [];
$desc_css_class = [
	'desc',
	!empty($heading2_text) ? 'has-heading2' : '',
	!empty($desc_style) ? 'font-style-'.$desc_style : '', 
	!empty($desc_text_transform) ? 'text-'.$desc_text_transform : ''
];
$desc_attrs[] = 'class="'.sunix_optimize_css_class(implode(' ', $desc_css_class)).'"';

if(!empty($desc_size)) $desc_css[]           = 'font-size:'.(int)$desc_size.'px'; 
if(!empty($desc_color)) $desc_css[]          = 'color:'.$desc_color;
if(!empty($desc_letter_spacing)) $desc_css[] = 'letter-spacing:'.(int)$desc_letter_spacing.'px';

if(!empty($desc_css)) 
	$desc_attrs[] = 'style="'.trim(implode(';',$desc_css)).'"';

?>
<div class="<?php echo sunix_optimize_css_class(implode(' ', $wrap_css_class)); ?>">
	<?php 

	switch ($layout_template) {
        case'4':
            if(!empty($small_heading_text)){
                ?>
                <h5 <?php echo implode(' ', $small_heading_attrs);?>><?php
                    echo sunix_html($small_heading_text);
                    ?></h5>
                <?php
            }
            if(!empty($heading_text) || !empty($heading2_text)) {
                ?>
                <h3 <?php echo implode(' ', $heading_attrs);?>><?php
                    echo sunix_html($heading_text);
                    if(!empty($heading2_text)) {
                        ?>
                        <span <?php echo implode(' ', $heading2_attrs);?>><?php
                            echo sunix_html($heading2_text);
                            ?></span>
                    <?php }
                    ?></h3>
            <?php }

            if(!empty($desc_text)) { ?>
                <div <?php echo implode(' ', $desc_attrs);?>><?php
                    echo sunix_html($desc_text);
                    ?></div>
            <?php }
            break;
		case '2':
			if(!empty($heading_text) || !empty($heading2_text) || !empty($small_heading_text)) {
				?>
				<div class="heading-top">
					<h3 <?php echo implode(' ', $heading_attrs);?>><?php
						echo sunix_html($heading_text);
						if(!empty($heading2_text)) {
							?>
							<span <?php echo implode(' ', $heading2_attrs);?>><?php
								echo sunix_html($heading2_text);
								?></span>
						<?php }
				  ?></h3>
					<h5 <?php echo implode(' ', $small_heading_attrs);?>><?php
						echo sunix_html($small_heading_text);
						?>
					</h5>
				</div>
			<?php }
			if(!empty($desc_text)) { ?>
				<div <?php echo implode(' ', $desc_attrs);?>><?php
					echo sunix_html($desc_text);
					?></div>
			<?php }
			break;
		 default:
			 if(!empty($small_heading_text)){
				 ?>
				 <h5 <?php echo implode(' ', $small_heading_attrs);?>><?php
					 echo sunix_html($small_heading_text);
					 ?></h5>
				 <?php
			 }
			 if(!empty($heading_text) || !empty($heading2_text)) {
				 ?>
				 <h3 <?php echo implode(' ', $heading_attrs);?>><?php
					 echo sunix_html($heading_text);
					 if(!empty($heading2_text)) {
						 ?>
						 <span <?php echo implode(' ', $heading2_attrs);?>><?php
							 echo sunix_html($heading2_text);
							 ?></span>
					 <?php }
					 ?></h3>
			 <?php }
			 if(!empty($desc_text)) { ?>
				 <div <?php echo implode(' ', $desc_attrs);?>><?php
					 echo sunix_html($desc_text);
					 ?></div>
			 <?php }
			break;
	}
	?>
</div>