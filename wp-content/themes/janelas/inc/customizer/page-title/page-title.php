<?php 
// Page title heading
$wp_customize->add_setting(
  'page_title_heading_enabled',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('page_title_heading_enabled'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'page_title_heading_enabled',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Heading ( OFF | ON )', 'janelas'),
        'section' => 'section_page_title',
        'priority' => 1,
    ))
);

$wp_customize->add_setting('themesflat_options[info]', array(
        'type'              => 'info_control',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',            
    )
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'page-title-style', array(
    'label' => esc_html__('Page Title Style', 'janelas'),
    'section' => 'section_page_title',
    'settings' => 'themesflat_options[info]',
    'priority' => 20
    ) )
);

$wp_customize->add_setting(
    'page_title_styles',
    array(
        'default'           => themesflat_customize_default('page_title_styles'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'page_title_styles',
    array (
        'type'      => 'select',           
        'section'   => 'section_page_title',
        'priority'  => 21,
        'label'         => esc_html__('Page Title Style', 'janelas'),
        'choices'   => array (
            'inline' =>  esc_html__( 'Inline Heading & Breadcrumbs','janelas' ),
            'default' =>  esc_html__( 'Default','janelas' ),
            'parallax' =>  esc_html__( 'Parallax','janelas' ),
            'video' =>  esc_html__( 'Video','janelas' )
            ) ,
    )
);

$wp_customize->add_setting(
    'page_title_alignment',
    array(
        'default'           => themesflat_customize_default('page_title_alignment'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'page_title_alignment',
    array (
        'type'      => 'select',           
        'section'   => 'section_page_title',
        'priority'  => 22,
        'label'         => esc_html__('Page Title Alignment', 'janelas'),
        'choices'   => array (
            'left' =>  esc_html__( 'Left','janelas' ),
            'center' =>  esc_html__( 'Center','janelas' ),
            'right' =>  esc_html__( 'Right','janelas' )
            ) ,
    )
); 

//Page Title Background
$wp_customize->add_setting(
    'page_title_background_image',
    array(
        'default' => themesflat_customize_default('page_title_background_image'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'page_title_background_image',
        array(
           'label'          => esc_html__( 'Upload Background Image', 'janelas' ),
           'type'           => 'image',
           'section'        => 'section_page_title',
           'priority'       => 23,
        )
    )
);

$wp_customize->add_setting(
    'page_title_image_size',
    array(
        'default'           => themesflat_customize_default('page_title_image_size'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'page_title_image_size',
    array (
        'type'      => 'select',           
        'section'   => 'section_page_title',
        'priority'  => 24,
        'label'         => esc_html__('Page Title Image Size', 'janelas'),
        'choices'   => array (
            'auto' =>  esc_html__( 'Original','janelas' ),
            'contain' =>  esc_html__( 'Fit to Screen','janelas' ),
            'cover' =>  esc_html__( 'Fill Screen','janelas' )
            ) ,
    )
);

$wp_customize->add_setting (
    'page_title_video_url',
    array(
        'default' => themesflat_customize_default('page_title_video_url') ,
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'page_title_video_url',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Page Title Background Video URL', 'janelas'),
        'section'   => 'section_page_title',
        'priority'  => 25,
        'active_callback' => function() use ( $wp_customize ) {
            return 'video' === $wp_customize->get_setting( 'page_title_styles' )->value();
        },
    )
);

// Page Title Overlay
$wp_customize->add_setting(
    'page_title_background_color',
    array(
        'default'           => themesflat_customize_default('page_title_background_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'page_title_background_color',
        array(
            'label'         => esc_html__('Background Color', 'janelas'),
            'section'       => 'section_page_title',
            'priority'      => 26
        )
    )
);   

$wp_customize->add_setting(
    'page_title_background_color_opacity',
    array(
        'default'   =>  themesflat_customize_default('page_title_background_color_opacity'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_Slide_Control( $wp_customize,
    'page_title_background_color_opacity',
        array(
            'type'      =>  'slide-control',
            'section'   =>  'section_page_title',
            'label'     =>  'Opacity for Background Color (%)',
            'priority'  => 27,
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
            ),
        )

    )
);  

// Box control
$wp_customize->add_setting(
    'page_title_controls',
    array(
        'default' => themesflat_customize_default('page_title_controls'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control( new themesflat_BoxControls($wp_customize,
    'page_title_controls',
    array(
        'label' => esc_html__( 'Page Title Controls (px)', 'janelas' ),
        'section' => 'section_page_title',
        'type' => 'box-controls',
        'priority' => 28
    ))
);  