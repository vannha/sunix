<?php
vc_map(array(
    'name' => 'Red Logo Footer',
    'base' => 'red_logo_footer',
    'icon' => 'red_el_icon',
    'category'      => esc_html__('RedExp', 'sunix'),
    'params' => array(
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Add Logo",'sunix'),
            "param_name" => "logo_footer",
        ),
    )
));

class WPBakeryShortCode_red_logo_footer extends WPBakeryShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
?>