<?php 
// Top bar Background
$wp_customize->add_setting(
    'topbar_background_color',
    array(
        'default'           => themesflat_customize_default('topbar_background_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'topbar_background_color',
        array(
            'label'         => esc_html__('Background', 'janelas'),
            'section'       => 'color_topbar',
            'priority'      => 1
        )
    )
);

