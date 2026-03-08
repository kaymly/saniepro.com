<?php 
//Sidebar Position
$wp_customize->add_setting(
    'shop_layout',
    array(
        'default'           => themesflat_customize_default('shop_layout'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'shop_layout',
    array (
        'type'      => 'select',           
        'section'   => 'section_shop_archive',
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

// Gird columns
$wp_customize->add_setting(
    'shop_columns',
    array(
        'default'           => themesflat_customize_default('shop_columns'),
        'sanitize_callback' => 'themesflat_sanitize_grid_post_related',
    )
);
$wp_customize->add_control(
    'shop_columns',
    array(
        'type'      => 'select',           
        'section'   => 'section_shop_archive',
        'priority'  => 2,
        'label'     => esc_html__('Columns', 'janelas'),
        'choices'   => array(
            2     => esc_html__( '2 Columns', 'janelas' ),
            3     => esc_html__( '3 Columns', 'janelas' ),
            4     => esc_html__( '4 Columns', 'janelas' ),
            5     => esc_html__( '5 Columns', 'janelas' ),                
        )
    )
);

// Number Posts Portfolios
$wp_customize->add_setting (
    'shop_products_per_page',
    array(
        'default' => themesflat_customize_default('shop_products_per_page'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'shop_products_per_page',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Show Number Products', 'janelas'),
        'section'   => 'section_shop_archive',
        'priority'  => 3
    )
);

// Product Style
$wp_customize->add_setting(
    'product_style',
    array(
        'default'           => themesflat_customize_default('product_style'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    'product_style',
    array(
        'type'      => 'select',           
        'section'   => 'section_shop_archive',
        'priority'  => 4,
        'label'     => esc_html__('Product Style', 'janelas'),
        'choices'   => array(
            'product-style1'     => esc_html__( 'Product Style 1', 'janelas' ),
            'product-style2'     => esc_html__( 'Product Style 2', 'janelas' ),             
        )
    )
);