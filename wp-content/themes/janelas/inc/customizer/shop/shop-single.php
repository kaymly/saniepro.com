<?php 
// Customize Services Featured Title
$wp_customize->add_setting (
    'product_featured_title',
    array(
        'default' => themesflat_customize_default('product_featured_title'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'product_featured_title',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Customize Product Featured Title', 'janelas'),
        'section'   => 'section_shop_single',
        'priority'  => 1
    )
);

//Sidebar Position
$wp_customize->add_setting(
    'shop_layout_single',
    array(
        'default'           => themesflat_customize_default('shop_layout_single'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'shop_layout_single',
    array (
        'type'      => 'select',           
        'section'   => 'section_shop_single',
        'priority'  => 1,
        'label'         => esc_html__('Sidebar Position', 'janelas'),
        'choices'   => array (
            'sidebar-right'     => esc_html__( 'Sidebar Right','janelas' ),
            'sidebar-left'      =>  esc_html__( 'Sidebar Left','janelas' ),
            'fullwidth'         =>   esc_html__( 'Full Width','janelas' ),
            'fullwidth-small'   =>   esc_html__( 'Full Width Small','janelas' ),
            'fullwidth-center'  =>   esc_html__( 'Full Width Center','janelas' ),
        ),
    )
);

// Related Products
$wp_customize->add_setting( 
  'related_products',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('related_products'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'related_products',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Related Products ( OFF | ON )', 'janelas'),
        'section' => 'section_shop_single',
        'priority' => 3,
    ))
);
// Related Gird columns
$wp_customize->add_setting(
    'related_products_columns',
    array(
        'default'           => themesflat_customize_default('related_products_columns'),
        'sanitize_callback' => 'themesflat_sanitize_grid_post_related',
    )
);
$wp_customize->add_control(
    'related_products_columns',
    array(
        'type'      => 'select',           
        'section'   => 'section_shop_single',
        'priority'  => 4,
        'label'     => esc_html__('Columns', 'janelas'),
        'choices'   => array(
            2     => esc_html__( '2 Columns', 'janelas' ),
            3     => esc_html__( '3 Columns', 'janelas' ),
            4     => esc_html__( '4 Columns', 'janelas' ),                
        )
    )
);