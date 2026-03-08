<?php 
//Header Style
$wp_customize->add_setting(
    'style_header',
    array(
        'default'           => themesflat_customize_default('style_header'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_RadioImages($wp_customize,
    'style_header',
    array (
        'type'      => 'radio-images',           
        'section'   => 'section_options',
        'priority'  => 1,
        'label'         => esc_html__('Header Style', 'janelas'),
        'choices'   => array (
            'header-default' => array (
                'tooltip'   => esc_html__( 'Header Default','janelas' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header-default.jpg'
            ),
            'header-01'=>  array (
                'tooltip'   => esc_html__( 'Header 01','janelas' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header01.jpg'
            ),
        ),
    ))
); 

// Enable Header Absolute
$wp_customize->add_setting(
  'header_absolute',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_absolute'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_absolute',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Absolute ( OFF | ON )', 'janelas'),
        'section' => 'section_options',
        'priority' => 1,
    ))
);

// Enable Header Sticky
$wp_customize->add_setting(
  'header_sticky',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_sticky'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_sticky',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Sticky ( OFF | ON )', 'janelas'),
        'section' => 'section_options',
        'priority' => 2,
    ))
);    

// Show search 
$wp_customize->add_setting(
  'header_search_box',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_search_box'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_search_box',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Search Box ( OFF | ON )', 'janelas'),
        'section' => 'section_options',
        'priority' => 5,
    ))
);

// Show search 
$wp_customize->add_setting(
  'header_sidebar_toggler',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_sidebar_toggler'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_sidebar_toggler',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Sidebar Toggler ( OFF | ON )', 'janelas'),
        'section' => 'section_options',
        'priority' => 5,
    ))
);

// Enable Header Cart
$wp_customize->add_setting(
  'header_cart_icon',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_cart_icon'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_cart_icon',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Cart ( OFF | ON )', 'janelas'),
        'section' => 'section_options',
        'priority' => 6,
    ))
);

// Enable Header Cart
$wp_customize->add_setting(
  'header_wishlist_icon',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_wishlist_icon'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_wishlist_icon',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Wishlist ( OFF | ON )', 'janelas'),
        'section' => 'section_options',
        'priority' => 7,
    ))
); 