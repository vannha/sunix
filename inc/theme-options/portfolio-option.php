<?php
function alacarte_portfolio_options($metabox)
{
    /* Config Portfolio Options */
    if (!$metabox->isset_args('portfolio')) {
        $metabox->set_args('portfolio', array(
            'opt_name'     => alacarte_get_page_opt_name(),
            'display_name' => esc_html__('Portfolio Settings', 'alacarte'),
        ), array(
            'context'  => 'advanced',
            'priority' => 'default',
            'panels'   => true
        ));
    }

    $metabox->add_section('portfolio', array(
        'title'  => esc_html__('Portfolio Details', 'alacarte'),
        'desc'   => esc_html__('Details settings for the portfolio.', 'alacarte'),
        'icon'   => 'el-icon-adjust-alt',
        'fields' => array_merge(
            array(
                array(
                    'id'       => 'portfolio_style',
                    'type'     => 'select',
                    'title'    => __('Portfolio Style Layout', 'alacarte'),
                    'options'  => array(
                        '1' => 'Image Equal Width Height',
                        '2' => 'Image 2 Width Height',
                        '3' => 'Hover Text Background Image Style 1',
                        '4' => 'Hover Text Background Color',
                        '5' => 'Hover Text Background Image Style 2',
                        '6' => 'Hover Text Background Image Style 3'
                    ),
                    'default'  => '1',
                ),
                array(
                    'id'       => 'portfolio_subtitle',
                    'type'     => 'text',
                    'title'    => esc_html__('Subtitle', 'alacarte'),
                    'required'  => array(
                        array('portfolio_style', '!=', '1'),
                        array('portfolio_style', '!=', '2'),
                    )
                ),
                array(
                    'id'        => 'portfolio_link',
                    'title'     => esc_html__('Link Page', 'alacarte'),
                    'type'      => 'select',
                    'data'      => 'pages',
                    'multi'     => 'true',
                    'placeholder'   => esc_html__('Choose a page','alacarte'),
                    'required'  => array(
                        array('portfolio_style', '!=', '1'),
                        array('portfolio_style', '!=', '2'),
                    )
                ),
            )

        )
    ));
}
add_action('ef5_post_metabox_register', 'alacarte_portfolio_options');