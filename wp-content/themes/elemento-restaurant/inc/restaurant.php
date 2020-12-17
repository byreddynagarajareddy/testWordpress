<?php
$wp_customize->add_panel( 'elemento_restaurant_front_option', array(
		'priority' => 10,
        'capability'     => 'edit_theme_options',
		'title' => __( 'Restaurent Item Options', 'elemento-restaurant' ),
		'description' => __( 'Front Page Options', 'elemento-restaurant' ),
	)
);	


$wp_customize->add_section( 'elemento_restaurant_section', array(
    'capability'            => 'edit_theme_options',
    'priority'              => 10,
    'title'                 => __( 'Front Restaurant Section', 'elemento-restaurant' ),
    'description'           => __( 'Input Title and Category For Menu', 'elemento-restaurant' ),
    'panel'				=> 'elemento_restaurant_front_option'
) );

$wp_customize->add_setting( 'elemento_restaurant_title', array(
    'capability'            => 'edit_theme_options',
    'default'               => __('Our Menu','elemento-restaurant'),
    'sanitize_callback'     => 'sanitize_text_field'
) );

$wp_customize->add_control( 'elemento_restaurant_title', array(
    'label'                 =>  __( 'Restaurant Menu Title', 'elemento-restaurant' ),
    'description'           =>  __( 'Change the Title', 'elemento-restaurant' ),
    'section'               => 'elemento_restaurant_section',
    'type'                  => 'text',
    'priority'              => 30,
    'settings' => 'elemento_restaurant_title',
) );
$wp_customize->add_setting('elemento_restaurant_category_id',array(
'sanitize_callback' => 'elemento_restaurant_sanitize_category',
'default' =>  '1',
   )
);
    
$wp_customize->add_control(new Elemento_Restaurant_Customize_Dropdown_Taxonomies_Control($wp_customize,'elemento_restaurant_category_id',                                                     
    array(
       'label' => __('Select Category for Blog','elemento-restaurant'),
        'section' => 'elemento_restaurant_section',
        'settings' => 'elemento_restaurant_category_id',
        'type'=> 'dropdown-taxonomies',
        'priority'              => 40,
    )
));