<?php 
$wp_customize->add_setting(
    'show_footer_info',
    array(
        'default'   => themesflat_customize_default('show_footer_info'),
        'sanitize_callback'  => 'themesflat_sanitize_checkbox',
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
        'show_footer_info',
        array(
            'type'      => 'checkbox',
            'label'     => esc_html__('Info Box ( OFF | ON )', 'janelas'),
            'section'   => 'section_info_footer',
            'priority'  => 2
        )
    )
);

$wp_customize->add_setting(
    'footer_info_text_address',
    array(
        'default'   =>  themesflat_customize_default('footer_info_text_address'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_text_address',
    array(
        'type'      =>  'text',
        'label'     =>  esc_html__('Text Address', 'janelas'),
        'section'   =>  'section_info_footer',
        'priority'  =>  3
    )
);
$wp_customize->add_setting(
    'footer_info_address',
    array(
        'default'   =>  themesflat_customize_default('footer_info_address'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_address',
    array(
        'type'      =>  'text',
        'section'   =>  'section_info_footer',
        'label'     =>  esc_html__('Address', 'janelas'),
        'priority'  => 4
    )
);

$wp_customize->add_setting(
    'footer_info_text_phone',
    array(
        'default'   =>  themesflat_customize_default('footer_info_text_phone'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_text_phone',
    array(
        'type'      =>  'text',
        'label'     =>  esc_html__('Text Phone', 'janelas'),
        'section'   =>  'section_info_footer',
        'priority'  =>  5
    )
);
$wp_customize->add_setting(
    'footer_info_phone',
    array(
        'default'   =>  themesflat_customize_default('footer_info_phone'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_phone',
    array(
        'type'      =>  'text',
        'section'   =>  'section_info_footer',
        'label'     =>  esc_html__('Phone', 'janelas'),
        'priority'  => 6
    )
);

$wp_customize->add_setting(
    'footer_info_text_phone',
    array(
        'default'   =>  themesflat_customize_default('footer_info_text_phone'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_text_phone',
    array(
        'type'      =>  'text',
        'label'     =>  esc_html__('Text Phone', 'janelas'),
        'section'   =>  'section_info_footer',
        'priority'  =>  5
    )
);
$wp_customize->add_setting(
    'footer_info_phone',
    array(
        'default'   =>  themesflat_customize_default('footer_info_phone'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_phone',
    array(
        'type'      =>  'text',
        'section'   =>  'section_info_footer',
        'label'     =>  esc_html__('Phone', 'janelas'),
        'priority'  => 6
    )
);

$wp_customize->add_setting(
    'footer_info_text_mail',
    array(
        'default'   =>  themesflat_customize_default('footer_info_text_mail'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_text_mail',
    array(
        'type'      =>  'text',
        'label'     =>  esc_html__('Text Mail', 'janelas'),
        'section'   =>  'section_info_footer',
        'priority'  =>  7
    )
);
$wp_customize->add_setting(
    'footer_info_mail',
    array(
        'default'   =>  themesflat_customize_default('footer_info_mail'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_mail',
    array(
        'type'      =>  'text',
        'section'   =>  'section_info_footer',
        'label'     =>  esc_html__('Mail', 'janelas'),
        'priority'  => 8
    )
);