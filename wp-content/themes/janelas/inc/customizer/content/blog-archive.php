<?php 
$wp_customize->add_setting(
    'sidebar_layout',
    array(
        'default'           => themesflat_customize_default('sidebar_layout'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'sidebar_layout',
    array (
        'type'      => 'select',           
        'section'   => 'section_content_blog_archive',
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

$wp_customize->add_setting(
    'blog_archive_layout',
    array(
        'default'           => themesflat_customize_default('blog_archive_layout'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'blog_archive_layout',
    array (
        'type'      => 'select',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 2,
        'label'         => esc_html__('Blog Layout', 'janelas'),
        'choices'   => array (
            'blog-list' =>  esc_html__( 'Blog List','janelas' ),                  
            'blog-grid'=> esc_html__( 'Blog Grid','janelas' ),
            )  
    )
);

// Gird columns Posts
$wp_customize->add_setting(
    'blog_grid_columns',
    array(
        'default'           => themesflat_customize_default('blog_grid_columns'),
        'sanitize_callback' => 'themesflat_sanitize_grid_post_related',
    )
);
$wp_customize->add_control(
    'blog_grid_columns',
    array(
        'type'      => 'select',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 3,
        'label'     => esc_html__('Post Grid Columns', 'janelas'),
        'choices'   => array(
            2     => esc_html__( '2 Columns', 'janelas' ),
            3     => esc_html__( '3 Columns', 'janelas' ),
            4     => esc_html__( '4 Columns', 'janelas' ),                
        ),
        'active_callback' => function() use ( $wp_customize ) {
            return 'blog-grid' === $wp_customize->get_setting( 'blog_archive_layout' )->value();
        },
    )
);

$wp_customize->add_setting (
    'blog_sidebar_list',
    array(
        'default'           => themesflat_customize_default('blog_sidebar_list'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new themesflat_DropdownSidebars($wp_customize,
    'blog_sidebar_list',
    array(
        'type'      => 'dropdown',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 4,
        'label'         => esc_html__('List Sidebar', 'janelas'),
        
    ))
);

// Entry Content Elements
$wp_customize->add_setting (
    'post_content_elements',
    array (
        'sanitize_callback' => 'themesflat_sanitize_text',
        'default' => themesflat_customize_default('post_content_elements'),     
    )
);
$wp_customize->add_control( new themesflat_Control_Drag_And_Drop( $wp_customize,
    'post_content_elements',
    array(
        'type'      => 'draganddrop-controls',
        'label'     => esc_html__('Post Content Elements', 'janelas'),
        'description' => esc_html__( 'Drag and drop elements to re-order.', 'janelas' ),
        'section'   => 'section_content_blog_archive',
        'priority'  => 5,
        'choices' => array(
            'meta'            => esc_html__( 'Meta', 'janelas' ),
            'title'           => esc_html__( 'Title', 'janelas' ),
            'excerpt_content' => esc_html__( 'Excerpt', 'janelas' ),
            'readmore'        => esc_html__( 'Read More', 'janelas' ),
        ),        
    ))
); 

// Excerpt
$wp_customize->add_setting(
    'blog_archive_post_excepts_length',
    array(
        'default'   =>  themesflat_customize_default('blog_archive_post_excepts_length'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_Slide_Control( $wp_customize,
    'blog_archive_post_excepts_length',
        array(
            'type'      =>  'slide-control',
            'section'   =>  'section_content_blog_archive',
            'label'     =>  'Post Excepts Length',
            'priority'  => 6,
            'input_attrs' => array(
                'min' => 0,
                'max' => 500,
                'step' => 1,
            ),
        )

    )
); 

// Read More Text
$wp_customize->add_setting (
    'blog_archive_readmore_text',
    array(
        'default' => themesflat_customize_default('blog_archive_readmore_text'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'blog_archive_readmore_text',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Read More Text', 'janelas'),
        'section'   => 'section_content_blog_archive',
        'priority'  => 7
    )
);

// Meta Elements
$wp_customize->add_setting (
    'meta_elements',
    array (
        'sanitize_callback' => 'themesflat_sanitize_text',
        'default' => themesflat_customize_default('meta_elements'),     
    )
);
$wp_customize->add_control( new themesflat_Control_Drag_And_Drop( $wp_customize,
    'meta_elements',
    array(
        'type'      => 'draganddrop-controls',
        'label'     => esc_html__('Meta Elements', 'janelas'),
        'description' => esc_html__( 'Drag and drop elements to re-order.', 'janelas' ),
        'section'   => 'section_content_blog_archive',
        'priority'  => 8,
        'choices' => array(
            'author'    => esc_html__( 'Author', 'janelas' ),
            'date'      => esc_html__( 'Date', 'janelas' ),
            'category'  => esc_html__( 'Category', 'janelas' ),
            'comment'   => esc_html__( 'Comment', 'janelas' ),
        ),        
    ))
); 

// Pagination
$wp_customize->add_setting(
    'blog_archive_pagination_style',
    array(
        'default'           => themesflat_customize_default('blog_archive_pagination_style'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'blog_archive_pagination_style',
    array(
        'type'      => 'select',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 9,
        'label'         => esc_html__('Pagination Style', 'janelas'),
        'choices'   => array(
            'pager'     => esc_html__('Pager','janelas'),
            'numeric'         =>  esc_html__('Numeric','janelas'),
            'pager-numeric'         =>  esc_html__('Pager & Numeric','janelas'),
            'loadmore' =>  esc_html__( 'Load More', 'janelas' )
        ),
    )
);