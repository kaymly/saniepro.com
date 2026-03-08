<?php 
// Menu fonts
$wp_customize->add_setting('themesflat_options[info]', array(
        'type'              => 'info_control',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',            
    )
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'menu_fonts', array(
    'label' => esc_html__('Menu', 'janelas'),
    'section' => 'section_typo_navigation',
    'settings' => 'themesflat_options[info]',
    'priority' => 1
    ) )
);

$wp_customize->add_setting(
    'typography_menu',
    array(
        'default' => themesflat_customize_default('typography_menu'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new themesflat_Typography($wp_customize,
    'typography_menu',
    array(
        'label' => esc_html__( 'Font name/style/sets', 'janelas' ),
        'section' => 'section_typo_navigation',
        'type' => 'typography',
        'fields' => array('family','style','line_height','size','letter_spacing'),
        'priority' => 2
    ))
);

// Menu a color
$wp_customize->add_setting(
    'mainnav_color',
    array(
        'default'           => themesflat_customize_default('mainnav_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'mainnav_color',
        array(
            'label' => esc_html__('Regular', 'janelas'),
            'section' => 'section_typo_navigation',
            'priority' => 4
        )
    )
);
// Menu hover color
$wp_customize->add_setting(
    'mainnav_hover_color',
    array(
        'default'           => themesflat_customize_default('mainnav_hover_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'mainnav_hover_color',
        array(
            'label' => esc_html__('Hover', 'janelas'),
            'section' => 'section_typo_navigation',
            'priority' => 5
        )
    )
);

// Menu active color
$wp_customize->add_setting(
    'mainnav_active_color',
    array(
        'default'           => themesflat_customize_default('mainnav_active_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'mainnav_active_color',
        array(
            'label' => esc_html__('Active', 'janelas'),
            'section' => 'section_typo_navigation',
            'priority' => 6
        )
    )
);

// Sub Menu fonts
$wp_customize->add_setting('themesflat_options[info]', array(
        'type'              => 'info_control',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',            
    )
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'sub_menu_fonts', array(
    'label' => esc_html__('Sub Menu', 'janelas'),
    'section' => 'section_typo_navigation',
    'settings' => 'themesflat_options[info]',
    'priority' => 20
    ) )
);

$wp_customize->add_setting(
    'typography_sub_menu',
    array(
        'default' => themesflat_customize_default('typography_sub_menu'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new themesflat_Typography($wp_customize,
    'typography_sub_menu',
    array(
        'label' => esc_html__( 'Font name/style/sets', 'janelas' ),
        'section' => 'section_typo_navigation',
        'type' => 'typography',
        'fields' => array('family','style','line_height','size','letter_spacing'),
        'priority' => 21
    ))
);

// Sub menu a color
$wp_customize->add_setting(
    'sub_nav_color',
    array(
        'default'           => themesflat_customize_default('sub_nav_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_color',
        array(
            'label' => esc_html__('Regular', 'janelas'),
            'section' => 'section_typo_navigation',
            'priority' => 23
        )
    )
);    

// Sub nav background hover
$wp_customize->add_setting(
    'sub_nav_color_hover',
    array(
        'default'   => themesflat_customize_default('sub_nav_color_hover'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_color_hover',
        array(
            'label' => esc_html__('Hover & Active', 'janelas'),
            'section' => 'section_typo_navigation',
            'priority' => 24
        )
    )
);

// Sub nav background
$wp_customize->add_setting(
    'sub_nav_background',
    array(
        'default'           => themesflat_customize_default('sub_nav_background'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_background',
        array(
            'label' => esc_html__('Background', 'janelas'),
            'section' => 'section_typo_navigation',
            'priority' => 25
        )
    )
);

// Sub nav background hover
$wp_customize->add_setting(
    'sub_nav_background_hover',
    array(
        'default'   => themesflat_customize_default('sub_nav_background_hover'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_background_hover',
        array(
            'label' => esc_html__('Background Hover & Active', 'janelas'),
            'section' => 'section_typo_navigation',
            'priority' => 26
        )
    )
);

// Sub nav line color between link
$wp_customize->add_setting(
    'sub_nav_border_color',
    array(
        'default'           => themesflat_customize_default('sub_nav_border_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_border_color',
        array(
            'label' => esc_html__('Border Line', 'janelas'),
            'section' => 'section_typo_navigation',
            'priority' => 27
        )
    )
);