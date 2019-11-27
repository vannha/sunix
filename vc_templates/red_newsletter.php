<?php
if(!class_exists('NewsletterWidgetMinimal') && !class_exists('NewsletterWidget')) return;

    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $wrapper_class = array('red-newsletter', $layout_mode, 'red-newsletter-'.$layout_template, $el_class);
?>
<div class="<?php echo trim(implode(' ',$wrapper_class)); ?>">
    <?php switch ($layout_mode) {
        case 'minimal':
            the_widget(
                'NewsletterWidgetMinimal', 
                array(
					'button'   => $btn_text,
					'el_class' => $el_class
                ),
                array(
                    'before_widget' => '', 
                    'after_widget'  => ''
                )
            );
            break;
        default:
            the_widget(
                'NewsletterWidget', 
                array(
					'button'            => $btn_text,
					'lists_layout'      => $lists_layout, 
					'lists_empty_label' => $lists_empty_label, 
					'lists_field_label' => $lists_field_label,
					'el_class'          => $el_class
                ), 
                array(
                    'before_widget' => '', 
                    'after_widget'  => ''
                ) 
            );
            break;
    } ?>
</div>