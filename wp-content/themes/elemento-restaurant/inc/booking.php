<?php
//call to  section enable disable

$wp_customize->add_section( 'elemento_restaurant_callto_section', array(
    'capability'            => 'edit_theme_options',
    'priority'              => 80,
    'title'                 => __( 'Front Call To Action Section', 'elemento-restaurant' ),
    'description'           => __( 'Select pages for Call to section, you can also change the icon per page', 'elemento-restaurant' ),
    'panel'             => 'elemento_restaurant_front_option'
) );

$wp_customize->add_setting( 'elemento_restaurant_callto_section_enable', array(
    'capability'            => 'edit_theme_options',
    'default'               => 0,
    'sanitize_callback'     => 'elemento_restaurant_sanitize_checkbox'
) );

$wp_customize->add_control( 'elemento_restaurant_callto_section_enable', array(
    'label'                 =>  __( 'Enable Call to Action', 'elemento-restaurant' ),
    'section'               => 'elemento_restaurant_callto_section',
    'type'                  => 'checkbox',
    'priority'              => 10,
    'settings'              => 'elemento_restaurant_callto_section_enable',
) );

// Call to action

$wp_customize->add_setting( 'elemento_restaurant_callto_page_1', array(
    'capability'            => 'edit_theme_options',
    'default'               => '',
    'sanitize_callback'     => 'elemento_restaurant_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'elemento_restaurant_callto_page_1', array(
    'label'                 =>  __( 'Select Page for Call to Section', 'elemento-restaurant' ),
    'section'               => 'elemento_restaurant_callto_section',
    'type'                  => 'dropdown-pages',
    'priority'              => 20,
    'settings'              => 'elemento_restaurant_callto_page_1',
) );

$wp_customize->add_setting('elemento_restaurant_callto_button_text_1',array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '',
        )
    );

$wp_customize->add_control(new WP_Customize_Control($wp_customize,'elemento_restaurant_callto_button_text_1',array(
            'label' => __('Call to Action button Text','elemento-restaurant'),
            'type' => 'text',
            'priority' => 30,
            'section' => 'elemento_restaurant_callto_section',
            'settings' => 'elemento_restaurant_callto_button_text_1',
        )
    ));
 $wp_customize->add_setting('elemento_restaurant_callto_button_url_1',array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
            'default' =>'',
        )
    );

$wp_customize->add_control(new WP_Customize_Control($wp_customize,'elemento_restaurant_callto_button_url_1',array(
            'label' => __('Call to Action Button URL','elemento-restaurant'),
            'type' => 'text',
            'priority'  => 40,
            'section' => 'elemento_restaurant_callto_section',
            'settings' => 'elemento_restaurant_callto_button_url_1',
        )
    ));

