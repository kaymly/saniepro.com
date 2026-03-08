<?php
class TFServices_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-services';
    }
    
    public function get_title() {
        return esc_html__( 'TF Services', 'themesflat-elementor' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

	public function get_style_depends(){
		return ['tf-style'];
	}

	protected function register_controls() {
        // Start Posts Query        
			$this->start_controls_section( 
				'section_posts_query',
	            [
	                'label' => esc_html__('Query', 'themesflat-elementor'),
	            ]
	        );

	        $this->add_control( 
					'posts_per_page',
		            [
		                'label' => esc_html__( 'Posts Per Page', 'themesflat-elementor' ),
		                'type' => \Elementor\Controls_Manager::NUMBER,
		                'default' => '3',
		            ]
		        );

		        $this->add_control( 
		        	'order_by',
					[
						'label' => esc_html__( 'Order By', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'date',
						'options' => [						
				            'date' => 'Date',
				            'ID' => 'Post ID',			            
				            'title' => 'Title',
						],
					]
				);

				$this->add_control( 
					'order',
					[
						'label' => esc_html__( 'Order', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'desc',
						'options' => [						
				            'desc' => 'Descending',
				            'asc' => 'Ascending',	
						],
					]
				);

				$this->add_control( 
					'posts_categories',
					[
						'label' => esc_html__( 'Categories', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'options' => ThemesFlat_Addon_For_Elementor_janelas::tf_get_taxonomies('services_category'),
						'label_block' => true,
		                'multiple' => true,
					]
				);

				$this->add_control( 
					'exclude',
					[
						'label' => esc_html__( 'Exclude', 'themesflat-elementor' ),
						'type'	=> \Elementor\Controls_Manager::TEXT,	
						'description' => esc_html__( 'Post Ids Will Be Inorged. Ex: 1,2,3', 'themesflat-elementor' ),
						'default' => '',
						'label_block' => true,				
					]
				);

				$this->add_control( 
					'sort_by_id',
					[
						'label' => esc_html__( 'Sort By ID', 'themesflat-elementor' ),
						'type'	=> \Elementor\Controls_Manager::TEXT,	
						'description' => esc_html__( 'Post Ids Will Be Sort. Ex: 1,2,3', 'themesflat-elementor' ),
						'default' => '',
						'label_block' => true,				
					]
				);

				$this->add_group_control( 
					\Elementor\Group_Control_Image_Size::get_type(),
					[
						'name' => 'thumbnail',
						'default' => 'full',
					]
				);

				$this->add_control( 
					'excerpt_lenght',
					[
						'label' => esc_html__( 'Excerpt Length', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'min' => 0,
						'max' => 500,
						'step' => 1,
						'default' => 13,
					]
				);

				$this->add_control( 
		        	'layout',
					[
						'label' => esc_html__( 'Columns', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'column-3',
						'options' => [
							'column-1' => esc_html__( '1', 'themesflat-elementor' ),
							'column-2' => esc_html__( '2', 'themesflat-elementor' ),
							'column-3' => esc_html__( '3', 'themesflat-elementor' ),
							'column-4' => esc_html__( '4', 'themesflat-elementor' ),
						],
					]
				);	

				$this->add_control( 
		        	'style',
					[
						'label' => esc_html__( 'Styles', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'style1',
						'options' => [
							'style1' => esc_html__( 'Style 1', 'themesflat-elementor' ),
							'style2' => esc_html__( 'Style 2', 'themesflat-elementor' ),
							'style3' => esc_html__( 'Style 3', 'themesflat-elementor' ),
						],
					]
				);		

				$this->add_control( 
					'show_post_count',
					[
						'label' => esc_html__( 'Show Ordinal Number', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Show', 'themesflat-elementor' ),
						'label_off' => esc_html__( 'Hide', 'themesflat-elementor' ),
						'return_value' => 'yes',
						'default' => 'yes',
						'condition' => [
							'style' => 'style2',
						]
					]
				);
				$this->add_control( 
					'show_btn',
					[
						'label' => esc_html__( 'Show Button', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Show', 'themesflat-elementor' ),
						'label_off' => esc_html__( 'Hide', 'themesflat-elementor' ),
						'return_value' => 'yes',
						'default' => 'yes',
					]
				);

				$this->add_control( 
					'icon_button',
					[
						'label' => esc_html__( 'Icon Button', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'fa4compatibility' => 'icon_bt',
						'default' => [
							'value' => 'janelas-icon-arrow-right',
							'library' => 'janelas_icon',
						],
						'condition' => [
							'show_btn' => 'yes',
						]				
					]
				);

				$this->add_control( 
					'button_text',
					[
						'label' => esc_html__( 'Button Text', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Read More', 'themesflat-elementor' ),
						'condition' => [
							'show_btn'	=> 'yes',
							'style!'	=> 'style1',
						],
					]
				);
			
			$this->end_controls_section();
        // /.End Posts Query

		 // Start General Style 
		 $this->start_controls_section( 
			'section_style_general',
			[
				'label' => esc_html__( 'General', 'themesflat-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);	

		$this->add_responsive_control( 
			'margin',
			[
				'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'default' => [
					'right' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 
			'padding',
			[
				'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'default' => [
					'right' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'layout_align',
			[
				'label' => esc_html__( 'Alignment', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'themesflat-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themesflat-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themesflat-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'themesflat-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'fields_options' => [
					'box_shadow_type' => [ 'default' =>'yes' ],
					'box_shadow' => [
						'default' => [
							'horizontal' => 0,
							'vertical' => 20,
							'blur' => 40,
							'spread' => 0,
							'color' => 'rgba(0, 0, 0, 0.07)'
						]
					]
				],
				'selector' => '{{WRAPPER}} .tf-services-wrap .services-post',
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-services-wrap .services-post',
			]
		);    

		$this->add_responsive_control( 
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' , '%' ],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 

		$this->add_control( 
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post' => 'background-color: {{VALUE}}',
				],
			]
		);  
		
		$this->end_controls_section();    
	// /.End General Style


	// Start Post Count
	$this->start_controls_section( 
		'section_style_post_count',
		[
			'label' => esc_html__( 'Post Count', 'themesflat-elementor' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			'condition' => [
				'style' => 'style2',
			],
		]
	);

	$this->add_group_control( 
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'post_count_typo',
			'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
			'fields_options' => [
				'typography' => ['default' => 'yes'],
				'font_family' => [
					'default' => 'Rubik',
				],
				'font_size' => [
					'default' => [
						'unit' => 'px',
						'size' => '40',
					],
				],
				'font_weight' => [
					'default' => '700',
				],
				'line_height' => [
					'default' => [
						'unit' => 'px',
						'size' => '',
					],
				],
				'text_transform' => [
					'default' => '',
				],
				'letter_spacing' => [
					'default' => [
						'unit' => 'px',
						'size' => '0',
					],
				],
			],
			'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .post-count',
		]
	);

	$this->add_control( 
		'count_color',
		[
			'label' => esc_html__( 'Color', 'themesflat-elementor' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '#ECEDF0',
			'selectors' => [
				'{{WRAPPER}} .tf-services-wrap .services-post .post-count' => 'color: {{VALUE}}',
			],
		]
	);

	$this->end_controls_section();    
	    // /.End Post Count

		// Start Post Icon
	$this->start_controls_section( 
		'section_style_post_icon',
		[
			'label' => esc_html__( 'Post Icon', 'themesflat-elementor' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			'condition' => [
				'style' => 'style2',
			],
		]
	);

	$this->start_controls_tabs( 
		'icon_style_tabs' 
		);

		$this->start_controls_tab( 
			'icon_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			] );

			$this->add_control( 
				'color_icon_content',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .post-icon i' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control( 
				'background_color_icon_content',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#E3CCA1',
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .post-icon' => 'background-color: {{VALUE}}',
					],
				]
			); 			
			
		$this->end_controls_tab();

		$this->start_controls_tab( 
			'icon_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			] );

			$this->add_control( 
				'color_icon_content_hover',
				[
					'label' => esc_html__( 'Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#E3CCA1',
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post:hover .post-icon i' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control( 
				'background_color_icon_content_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post:hover .post-icon' => 'background-color: {{VALUE}}',
					],
				]
			); 
			
		$this->end_controls_tab();

	$this->end_controls_tabs();

	$this->end_controls_section();    
	    // /.End post icon

		// Start Image Style 
		$this->start_controls_section( 
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'themesflat-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);	        

		$this->add_responsive_control( 
			'padding_image',
			[
				'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post .featured-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);	

		$this->add_responsive_control( 
			'margin_image',
			[
				'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],				
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post .featured-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);  

		$this->add_responsive_control( 
			'image_heightt',
			[
				'label' => esc_html__( 'Image Height', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post .featured-post img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_group_control( 
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_image',
				'label' => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .featured-post',
			]
		); 

		$this->add_group_control( 
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border_image',
				'label' => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .featured-post',
			]
		); 

		$this->add_responsive_control( 
			'border_radius_image',
			[
				'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' , '%' ],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post .featured-post, {{WRAPPER}} .tf-services-wrap .services-post .featured-post img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 
		$this->end_controls_section();    
	    // /.End Image Style

		// Start Content Style 
		$this->start_controls_section( 
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'themesflat-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);	

		$this->add_responsive_control( 
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	// /.End Content Style

	// Start Title Style 
		$this->start_controls_section( 
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'themesflat-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);	

		$this->add_group_control( 
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_s1_typography',
				'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_family' => [
						'default' => 'Rubik',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '18',
						],
					],
					'font_weight' => [
						'default' => '500',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '30',
						],
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
					'letter_spacing' => [
						'default' => [
							'unit' => 'px',
							'size' => '0',
						],
					],
				],
				'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .title',
			]
		);

		$this->add_control( 
			'title_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#434E6E',
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_title',
				'label' => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .title',
			]
		);

		$this->add_responsive_control( 
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .services-post .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	// /.End Title Style

	// Start Excerpt Style 
	$this->start_controls_section( 
		'section_style_text',
		[
			'label' => esc_html__( 'Excerpt', 'themesflat-elementor' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

	$this->add_group_control( 
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'desc_typography',
			'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
			'fields_options' => [
				'typography' => ['default' => 'yes'],
				'font_family' => [
					'default' => 'Rubik',
				],
				'font_size' => [
					'default' => [
						'unit' => 'px',
						'size' => '16',
					],
				],
				'font_weight' => [
					'default' => '400',
				],
				'line_height' => [
					'default' => [
						'unit' => 'px',
						'size' => '30',
					],
				],
				'letter_spacing' => [
					'default' => [
						'unit' => 'px',
						'size' => '0',
					],
				],
			],
			'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .desc',
		]
	);

	$this->add_control( 
		'desc_color',
		[
			'label' => esc_html__( 'Color', 'themesflat-elementor' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '#565872',
			'selectors' => [
				'{{WRAPPER}} .tf-services-wrap .services-post .desc' => 'color: {{VALUE}}',
			],
		]
	);

	$this->add_responsive_control( 
		'text_margin',
		[
			'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .tf-services-wrap .services-post .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->end_controls_section();
// /.End Excerpt Style

// Start Button Style 
	$this->start_controls_section( 
		'section_style_button',
		[
			'label' => esc_html__( 'Button', 'themesflat-elementor' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

	$this->add_group_control( 
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'button_s1_typography',
			'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
			'fields_options' => [
				'typography' => ['default' => 'yes'],
				'font_family' => [
					'default' => 'Rubik',
				],
				'font_size' => [
					'default' => [
						'unit' => 'px',
						'size' => '16',
					],
				],
				'font_weight' => [
					'default' => '700',
				],
				'line_height' => [
					'default' => [
						'unit' => 'px',
						'size' => '',
					],
				],
				'text_transform' => [
					'default' => 'uppercase',
				],
				'letter_spacing' => [
					'default' => [
						'unit' => 'px',
						'size' => '0',
					],
				],
			],
			'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .tf-button',
		]
	);

	$this->start_controls_tabs( 
		'button_style_tabs' 
		);

		$this->start_controls_tab( 'button_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
			] );	
			$this->add_control( 
				'button_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button svg' => 'fill: {{VALUE}}',
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button.has-line:after' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'style' => 'style1'
					]
				]
			);

			$this->add_control( 
				'button_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#E3CCA1',
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button i' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'style' => 'style1'
					]
				]
			);

			$this->add_group_control( 
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => esc_html__( 'Border', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .tf-button i',
					'condition' => [
						'style' => 'style1'
					]
				]
			);

			$this->add_control( 
				'button_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'style' => 'style1'
					]
				]
			);

			$this->add_control( 
				'button_color2',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button svg' => 'fill: {{VALUE}}',
					],
					'condition' => [
						'style!' => 'style1'
					]
				]
			);

			$this->add_control( 
				'button_bg_color2',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'style!' => 'style1'
					]
				]
			);

			$this->add_group_control( 
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'button_border2',
					'label' => esc_html__( 'Border', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .tf-button',
					'condition' => [
						'style!' => 'style1'
					]
				]
			);

			$this->add_control( 
				'button_border_radius2',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'style!' => 'style1'
					]
				]
			);

			$this->add_control( 
				'button_icon_size',
				[
					'label' => esc_html__( 'Icon Size', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 50,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 24,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			); 
			$this->end_controls_tab();
			$this->start_controls_tab( 'button_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			] );

			$this->add_control( 
				'button_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button:hover i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button:hover svg' => 'fill: {{VALUE}}',
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button.has-line:hover:after' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'style' => 'style1'
					]
				]
			);

			$this->add_control( 
				'button_bg_color_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button:hover i, {{WRAPPER}} .tf-services-wrap .services-post .tf-button:after' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'style' => 'style1'
					]
				]
			);

			$this->add_group_control( 
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'button_border_hover',
					'label' => esc_html__( 'Border', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .tf-button:hover i',
					'condition' => [
						'style' => 'style1'
					]
				]
			);

			$this->add_control( 
				'button_border_radius_hover',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button:hover i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'style' => 'style1'
					]
				]
			);
			$this->add_control( 
				'button_color_hover2',
				[
					'label' => esc_html__( 'Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button:hover' => 'color: {{VALUE}}',
					],
					'condition' => [
						'style!' => 'style1'
					]
				]
			);

			$this->add_control( 
				'button_bg_color_hover2',
				[
					'label' => esc_html__( 'Background Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button:hover' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'style!' => 'style1'
					]
				]
			);

			$this->add_group_control( 
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'button_border_hover2',
					'label' => esc_html__( 'Border', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-services-wrap .services-post .tf-button:hover',
					'condition' => [
						'style!' => 'style1'
					]
				]
			);

			$this->add_control( 
				'button_border_radius_hover2',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tf-services-wrap .services-post .tf-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'style!' => 'style1'
					]
				]
			);
			$this->end_controls_tab();


	$this->end_controls_section();
// /.End Button Style

	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'tf_services_wrap', ['id' => "tf-services-{$this->get_id()}", 'class' => ['tf-services-wrap', 'themesflat-services-taxonomy', $settings['style'] ], 'data-tabid' => $this->get_id()] );


		if ( get_query_var('paged') ) {
           $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
           $paged = get_query_var('page');
        } else {
           $paged = 1;
        }
		$query_args = array(
            'post_type' => 'services',
            'posts_per_page' => $settings['posts_per_page'],
            'paged'     => $paged
        );

        if (! empty( $settings['posts_categories'] )) {        	
        	$query_args['tax_query'] = array(
							        array(
							            'taxonomy' => 'services_category',
							            'field'    => 'slug',
							            'terms'    => $settings['posts_categories']
							        ),
							    );
        }        
        if ( ! empty( $settings['exclude'] ) ) {				
			if ( ! is_array( $settings['exclude'] ) )
				$exclude = explode( ',', $settings['exclude'] );

			$query_args['post__not_in'] = $exclude;
		}

		$query_args['orderby'] = $settings['order_by'];
		$query_args['order'] = $settings['order'];

		if ( $settings['sort_by_id'] != '' ) {	
			$sort_by_id = array_map( 'trim', explode( ',', $settings['sort_by_id'] ) );
			$query_args['post__in'] = $sort_by_id;
			$query_args['orderby'] = 'post__in';
		}

		$count = 1;
		$prefix = 0;

		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) : ?>
		<div <?php echo $this->get_render_attribute_string('tf_services_wrap'); ?>>
			<div class="wrap-services-post row <?php echo esc_attr($settings['layout']); ?>">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="item">
						<?php if ($settings['style'] == 'style1') : ?>
	                        <div class="services-post services-post-<?php the_ID(); ?>">
	                        	<?php if ( has_post_thumbnail() ): ?>
	                            <div class="featured-post">
	                                <a href="<?php echo get_the_permalink(); ?>">
	                                <?php 
	                                $get_id_post_thumbnail = get_post_thumbnail_id();
									echo sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));
	                                ?>
									<span class="services-overlay"></span>
	                                </a>
	                            </div>
	                        	<?php endif; ?>
	                            <div class="content"> 
	                                <h2 class="title">
	                                    <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
	                                </h2>
	                                <div class="desc"><?php echo wp_trim_words( get_the_content(), $settings['excerpt_lenght'], '' ); ?></div>                                                
	                                <div class="tf-button-container">
	                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="tf-button bt_icon_after">
										<?php
											echo '<i class="' . esc_attr($settings['icon_button']['value']) . '" aria-hidden="true"></i>';
										?>
									</a>
	                                </div>                               
	                            </div>
	                        </div>
                    	<?php elseif ($settings['style'] == 'style2') : ?>
	                    	<div class="services-post services-post-<?php the_ID(); ?>">
	                        	<?php if ( has_post_thumbnail() ): ?>
	                            <div class="featured-post">
	                                <a href="<?php echo get_the_permalink(); ?>">
	                                <?php 
	                                $get_id_post_thumbnail = get_post_thumbnail_id();
									echo sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));
	                                ?>
									<span class="services-overlay"></span>
	                                </a>
	                            </div>
	                        	<?php endif; ?>
	                            <div class="content"> 
	                                <?php 
	                                $services_post_icon  = \Elementor\Addon_Elementor_Icon_manager_janelas::render_icon( themesflat_get_opt_elementor('services_post_icon'), [ 'aria-hidden' => 'true' ] );
	                                if ($services_post_icon) {
	                                    echo '<div class="post-icon">'.$services_post_icon.'</div>';
	                                }
	                                ?>
	                            	<div class="inner-content">
										<?php if ( $settings['show_post_count'] == 'yes' ): ?>
											<?php $count_none_prefix = $count >= 10 ? $count++ : $prefix.$count++;
												$count_post = $settings['posts_per_page'] < 10 ? $prefix.$count++ / 2 : $count_none_prefix; ?>
											<div class="post-count"><?php echo $count_post; ?></div>
										<?php endif; ?>
		                                <h2 class="title">
		                                    <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
		                                </h2>
		                                <div class="desc"><?php echo wp_trim_words( get_the_content(), $settings['excerpt_lenght'], '' ); ?></div>                                                
		                                <?php if ( $settings['show_btn'] == 'yes' ): ?>
											<div class="tf-button-container">
		                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="tf-button bt_icon_after"><?php echo esc_attr( $settings['button_text'] ); ?> <?php
											echo '<i class="' . esc_attr($settings['icon_button']['value']) . '" aria-hidden="true"></i>';
										?></a>
		                                </div>
										<?php endif; ?>
	                            	</div>
	                            </div>
	                        </div>
	                    <?php elseif ($settings['style'] == 'style3') : ?>
	                    	<div class="services-post services-post-<?php the_ID(); ?>">
	                        	<?php if ( has_post_thumbnail() ): ?>
	                            <div class="featured-post">
	                                <a href="<?php echo get_the_permalink(); ?>">
	                                <?php 
	                                $get_id_post_thumbnail = get_post_thumbnail_id();
									echo sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));
	                                ?>
									<span class="services-overlay"></span>
	                                </a>
	                            </div>
	                        	<?php endif; ?>
	                            <div class="content">
	                                <?php 
	                                $services_post_icon  = \Elementor\Addon_Elementor_Icon_manager_janelas::render_icon( themesflat_get_opt_elementor('services_post_icon'), [ 'aria-hidden' => 'true' ] );
	                                if ($services_post_icon) {
	                                    echo '<div class="post-icon">'.$services_post_icon.'</div>';
	                                }
	                                ?>	                               	
	                                <h2 class="title">
	                                    <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
	                                </h2>
	                                <div class="desc"><?php echo wp_trim_words( get_the_content(), $settings['excerpt_lenght'], '' ); ?></div>                       
	                            </div>
	                            <div class="tf-button-container">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="tf-button bt_icon_after"><?php echo esc_attr( $settings['button_text'] ); ?> <?php echo '<i class="' . esc_attr($settings['icon_button']['value']) . '" aria-hidden="true"></i>'; ?></a>
                                </div> 
	                        </div>
                    	<?php endif; ?>
                    </div> 
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
		<?php
		else:
			esc_html_e('No posts found', 'themesflat-elementor');
		endif;
			
	}	

}