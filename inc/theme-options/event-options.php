<?php
function sunix_event_options($metabox)
{
    /* Config event Options */
    if (!$metabox->isset_args('event')) {
        $metabox->set_args('event', array(
            'opt_name'     => sunix_get_page_opt_name(),
            'display_name' => esc_html__('Events Settings', 'sunix'),
        ), array(
            'context'  => 'advanced',
            'priority' => 'default',
            'panels'   => true
        ));
    }

    $metabox->add_section('event', array(
        'title'  => esc_html__('Event Details', 'sunix'),
        'desc'   => esc_html__('Details settings for the event.', 'sunix'),
        'icon'   => 'el-icon-adjust-alt',
        'fields' => array_merge(
            array(
                array(
                    'id'       => 'event_time',
                    'type'     => 'text',
                    'placeholder'     => '7.00 PM',
                    'title'    => esc_html__('Event Time', 'sunix'),
                ),
                array(
                    'id'       => 'event_date',
                    'type'     => 'date',
                    'title'    => esc_html__('Event Date', 'sunix'),
                ),
                array(
                    'id'       => 'event_duration',
                    'type'     => 'text',
                    'placeholder'     => '3 Hours',
                    'title'    => esc_html__('Event Duration', 'sunix'),
                ),
                array(
                    'id'       => 'event_type',
                    'type'     => 'button_set',
                    'placeholder'     => ' Event Type',
                    'options' => array(
                        '0' => 'Close',
                        '1' => 'Open',
                    ),
                    'default' => array('1'),
                    'title'    => esc_html__('Event Duration', 'sunix'),
                ),

                array(
                    'id'       => 'event_entrants',
                    'type'     => 'text',
                    'title'    => esc_html__('Entrants Number', 'sunix'),
                ),
            )
        )
    ));
    $metabox->add_section('event', array(
        'title'  => esc_html__('Gallery', 'sunix'),
        'icon'   => 'el-icon-picture',
        'fields' => array(
            array(
                'id'          => 'event-gallery-images',
                'type'        => 'gallery',
                'title'       => esc_html__('Gallery Images ', 'sunix'),
                'subtitle'    => esc_html__('Upload images or add from media library.', 'sunix')
            )
        )
    ));
}
add_action('ef5_post_metabox_register', 'sunix_event_options');