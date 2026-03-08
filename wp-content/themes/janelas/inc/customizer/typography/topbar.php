<?php 
// Topbar fonts
$wp_customize->add_setting(
    'typography_topbar',
    array(
        'default' => themesflat_customize_default('typography_topbar'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new themesflat_Typography($wp_customize,
    'typography_topbar',
    array(
        'label' => esc_html__( 'Font name/style/sets', 'janelas' ),
        'section' => 'section_typo_topbar',
        'type' => 'typography',
        'fields' => array('family','style','line_height','size','letter_spacing'),
        'priority' => 1
    ))
);

// Top bar text color
$wp_customize->add_setting(
    'topbar_textcolor',
    array(
        'default'           => themesflat_customize_default('topbar_textcolor'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'topbar_textcolor',
        array(
            'label'         => esc_html__('Text Color', 'janelas'),
            'section'       => 'section_typo_topbar',
            'settings'      => 'topbar_textcolor',
            'priority'      => 3
        )
    )
);

// Topbar Link Color Hover
$wp_customize->add_setting(
    'topbar_link_color',
    array(
        'default'           => themesflat_customize_default('topbar_link_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'topbar_link_color',
        array(
            'label'         => esc_html__('Link Color', 'janelas'),
            'section'       => 'section_typo_topbar',
            'settings'      => 'topbar_link_color',
            'priority'      => 4
        )
    )
);

// Topbar Link Color Hover
$wp_customize->add_setting(
    'topbar_link_color_hover',
    array(
        'default'           => themesflat_customize_default('topbar_link_color_hover'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'topbar_link_color_hover',
        array(
            'label'         => esc_html__('Link Color Hover', 'janelas'),
            'section'       => 'section_typo_topbar',
            'settings'      => 'topbar_link_color_hover',
            'priority'      => 5
        )
    )
);

