<?php
class TFproject_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tfproject';
    }
    
    public function get_title() {
        return esc_html__( 'TF Project', 'themesflat-elementor' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['owl-carousel', 'tf-project'];
	}

	public function get_script_depends() {
		return ['owl-carousel', 'tf-project'];
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
	                'default' => '5',
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
					'options' => ThemesFlat_Addon_For_Elementor_janelas::tf_get_taxonomies('project_category'),
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
				'border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tf-widget-project-wrap .project-post, {{WRAPPER}} .tf-widget-project-wrap .project-post:after' => 'border-radius: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-widget-project-wrap .project-post .featured-post' => 'border-radius: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-widget-project-wrap .project-post:hover .featured-post' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
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
					'default' => 5,
					'condition' => [
						'style' => 'style1',
					],
				]
			);

			$this->add_control( 
	        	'layout',
				[
					'label' => esc_html__( 'Columns', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '3',
					'options' => [
						'1' => esc_html__( '1', 'themesflat-elementor' ),
						'2' => esc_html__( '2', 'themesflat-elementor' ),
						'3' => esc_html__( '3', 'themesflat-elementor' ),
						'4' => esc_html__( '4', 'themesflat-elementor' ),
						'5' => esc_html__( '5', 'themesflat-elementor' ),
					],
				]
			);

			$this->add_control( 
	        	'style',
				[
					'label' => esc_html__( 'Style', 'themesflat-elementor' ),
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
				'spacing_item',
				[
					'label' => esc_html__( 'Spacing', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 50,
							'step' => 5,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 30,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-widget-project-wrap .wrap-project-post .item' => 'padding-left: calc( {{SIZE}}{{UNIT}} / 2 );padding-right: calc( {{SIZE}}{{UNIT}} / 2 );',
						'{{WRAPPER}} .tf-widget-project-wrap .wrap-project-post .item .project-post' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'carousel!' => 'yes',
					],
				]
			);					

			$this->add_control(
				'h_style_filter',
				[
					'label' => esc_html__( 'Filter', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'show_filter',
				[
					'label' => esc_html__( 'Filter', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'themesflat-elementor' ),
					'label_off' => esc_html__( 'Hide', 'themesflat-elementor' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control( 
				'filter_category_order',
				[
					'label' => esc_html__( 'Filter Order', 'themesflat-elementor' ),
					'type'	=> \Elementor\Controls_Manager::TEXT,	
					'description' => esc_html__( 'Filter Slug Categories Order Split By ","', 'themesflat-elementor' ),
					'default' => '',
					'label_block' => true,	
					'condition' => [
						'show_filter' => 'yes',
					],			
				]
			);

			$this->add_control( 
				'filter_category_all',
				[
					'label' => esc_html__( 'Filter All Test', 'themesflat-elementor' ),
					'type'	=> \Elementor\Controls_Manager::TEXT,	
					'default' => 'All',
					'label_block' => true,		
					'condition' => [
						'show_filter' => 'yes',
					],		
				]
			);

			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'filter_typography',
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
				                'size' => '26',
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
					'selector' => '{{WRAPPER}} .tf-project-wrap .project-filter li a',
					'condition' => [
						'show_filter' => 'yes',
					],
				]
			); 

			$this->add_responsive_control( 
				'margin_filter',
				[
					'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '52',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .project-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			); 

			$this->add_responsive_control( 
				'padding_filter',
				[
					'label' => esc_html__( 'padding', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .project-filter li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			); 

			$this->add_control( 
				'filter_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .tf-widget-project-wrap .project-filter li a' => 'color: {{VALUE}}',				
					],
					'condition' => [
						'show_filter' => 'yes',
					],
				]
			);

			$this->add_control( 
				'filter_color_hover',
				[
					'label' => esc_html__( 'Color Hover & Active', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .tf-widget-project-wrap .project-filter li a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-widget-project-wrap .project-filter li.active a' => 'color: {{VALUE}}',				
					],
					'condition' => [
						'show_filter' => 'yes',
					],
				]
			);

			$this->add_control( 
				'filter_background',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-widget-project-wrap .project-filter li a' => 'background-color: {{VALUE}}',				
					],
					'condition' => [
						'show_filter' => 'yes',
					],
				]
			);

			$this->add_control( 
				'filter_background_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-widget-project-wrap .project-filter li a:hover' => 'background-color: {{VALUE}}',				
						'{{WRAPPER}} .tf-widget-project-wrap .project-filter li.active a' => 'background-color: {{VALUE}}',				
					],
					'condition' => [
						'show_filter' => 'yes',
					],
				]
			);

			$this->end_controls_section();
        // /.End Posts Query

	// Start Carousel        
		$this->start_controls_section( 
			'section_posts_carousel',
			[
				'label' => esc_html__('Carousel', 'themesflat-elementor'),
				'condition' => [
					'show_filter!' => 'yes'
				]	
			]
		);	

		$this->add_control( 
			'carousel',
			[
				'label' => esc_html__( 'Carousel', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off' => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',	
				'separator' => 'before',		
			]
		);

		$this->add_control(
			'spacing_item_carousel',
			[
				'label' => esc_html__( 'Spacing', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'default' => 30,
			]
		);

		$this->add_control( 
			'carousel_loop',
			[
				'label' => esc_html__( 'Loop', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off' => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control( 
			'carousel_auto',
			[
				'label' => esc_html__( 'Auto Play', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'themesflat-elementor' ),
				'label_off' => esc_html__( 'Off', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'carousel' => 'yes',
				],
			]
		);	

		$this->add_control( 
			'carousel_arrow',
			[
				'label' => esc_html__( 'Arrow', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off' => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'carousel' => 'yes',
				],
				'description'	=> 'Just show when you have two slide',
				'separator' => 'before',
			]
		);

		$this->add_control( 
			'carousel_prev_icon', [
				'label' => esc_html__( 'Prev Icon', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'default' => 'fas fa-arrow-left',
				'include' => [
					'fas fa-angle-double-left',
					'fas fa-angle-left',
					'fas fa-chevron-left',
					'fas fa-arrow-left',
				],  
				'condition' => [
					'carousel' => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_control( 
			'carousel_next_icon', [
				'label' => esc_html__( 'Next Icon', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'default' => 'fas fa-arrow-right',
				'include' => [
					'fas fa-angle-double-right',
					'fas fa-angle-right',
					'fas fa-chevron-right',
					'fas fa-arrow-right',
				], 
				'condition' => [
					'carousel' => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control( 
			'carousel_arrow_fontsize',
			[
				'label' => esc_html__( 'Font Size', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'carousel' => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control( 
			'w_size_carousel_arrow',
			[
				'label' => esc_html__( 'Width', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 72,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'carousel' => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control( 
			'h_size_carousel_arrow',
			[
				'label' => esc_html__( 'Height', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 72,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'carousel' => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);	

		$this->add_responsive_control( 
			'carousel_arrow_width',
			[
				'label' => esc_html__( 'Width Wrap Nav', 'themesflat-elementor' ),
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
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 176,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'carousel' => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control( 
			'carousel_arrow_horizontal_position',
			[
				'label' => esc_html__( 'Horizontal Position', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -2000,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav' => 'right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav' => 'left: {{SIZE}}{{UNIT}};right: unset;',
				],
				'condition' => [
					'carousel' => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->add_responsive_control( 
			'carousel_arrow_vertical_position',
			[
				'label' => esc_html__( 'Vertical Position', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -50,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'carousel' => 'yes',
					'carousel_arrow' => 'yes',
				]
			]
		);

		$this->start_controls_tabs( 
			'carousel_arrow_tabs',
			[
				'condition' => [
					'carousel_arrow' => 'yes',
					'carousel' => 'yes',
				]
			] );
			$this->start_controls_tab( 
				'carousel_arrow_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'themesflat-elementor' ),						
				]
			);
			$this->add_control( 
				'carousel_arrow_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next' => 'color: {{VALUE}}',
					],
					'condition' => [
						'carousel_arrow' => 'yes',
					]
				]
			);
			$this->add_control( 
				'carousel_arrow_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'carousel_arrow' => 'yes',
					]
				]
			);	
			$this->add_control( 
				'carousel_arrow_left_bg_color',
				[
					'label' => esc_html__( 'Background Color Prev', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'carousel_arrow' => 'yes',
					]
				]
			);		        
			$this->add_group_control( 
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'carousel_arrow_border',
					'label' => esc_html__( 'Border', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next',
					'condition' => [
						'carousel_arrow' => 'yes',
					]
				]
			);
			$this->add_responsive_control( 
				'carousel_arrow_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => true,
					],
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'carousel_arrow' => 'yes',
					]
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab( 
				'carousel_arrow_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
				]
			);
			$this->add_control( 
				'carousel_arrow_color_hover',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#E3CCA1',
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev:hover, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next:hover' => 'color: {{VALUE}}',
					],
					'condition' => [
						'carousel_arrow' => 'yes',
					]
				]
			);
			$this->add_control( 
				'carousel_arrow_hover_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev:hover, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'carousel_arrow' => 'yes',
					]
				]
			);
			$this->add_group_control( 
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'carousel_arrow_border_hover',
					'label' => esc_html__( 'Border', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev:hover, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next:hover',
					'condition' => [
						'carousel_arrow' => 'yes',
					]
				]
			);
			$this->add_responsive_control( 
				'carousel_arrow_border_radius_hover',
				[
					'label' => esc_html__( 'Border Radius Previous', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-prev:hover, {{WRAPPER}} .wrap-project-post.owl-carousel .owl-nav .owl-next:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'carousel_arrow' => 'yes',
					]
				]
			);
		   $this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control( 
			'carousel_bullets',
			[
				'label'         => esc_html__( 'Bullets', 'themesflat-elementor' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'label_on'      => esc_html__( 'Show', 'themesflat-elementor' ),
				'label_off'     => esc_html__( 'Hide', 'themesflat-elementor' ),
				'return_value'  => 'yes',
				'default'       => 'no',
				'condition' => [
					'carousel' => 'yes',
				],
				'separator' => 'before',
			]
		);	

		$this->add_responsive_control( 
			'w_size_carousel_bullets',
				[
					'label' => esc_html__( 'Width', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 15,
					],
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post .owl-dots .owl-dot' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'carousel' => 'yes',
						'carousel_bullets' => 'yes',
					]
				]
		);

		$this->add_responsive_control( 
			'h_size_carousel_bullets',
			[
				'label' => esc_html__( 'Height', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap-project-post .owl-dots .owl-dot' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'carousel' => 'yes',
					'carousel_bullets' => 'yes',
				]
			]
		);

		$this->add_responsive_control( 
			'carousel_bullets_horizontal_position',
			[
				'label' => esc_html__( 'Horizonta Offset', 'themesflat-elementor' ),
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
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap-project-post .owl-dots' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'carousel' => 'yes',
					'carousel_bullets' => 'yes',
				]
			]
		);

		$this->add_responsive_control( 
			'carousel_bullets_vertical_position',
			[
				'label' => esc_html__( 'Vertical Offset', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap-project-post .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'carousel' => 'yes',
					'carousel_bullets' => 'yes',
				]
			]
		);

		$this->start_controls_tabs( 
			'carousel_bullets_tabs',
				[
					'condition' => [
						'carousel' => 'yes',
						'carousel_bullets' => 'yes',
					]
				] );
			$this->start_controls_tab( 
				'carousel_bullets_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'themesflat-elementor' ),						
				]
			);
			$this->add_control( 
				'carousel_bullets_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#e8e8e9',
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'carousel_bullets' => 'yes',
					]
				]
			);			         
			$this->add_group_control( 
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'carousel_bullets_border',
					'label' => esc_html__( 'Border', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .wrap-project-post .owl-dots .owl-dot',
					'condition' => [
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->add_responsive_control( 
				'carousel_bullets_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => true,
					],
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post .owl-dots .owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab( 
				'carousel_bullets_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
			]
			); 
			$this->add_control( 
				'carousel_bullets_hover_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post .owl-dots .owl-dot:hover, {{WRAPPER}} .wrap-project-post .owl-dots .owl-dot.active' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'carousel_bullets' => 'yes',
					]
				]
			); 
			$this->add_group_control( 
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'carousel_bullets_border_hover',
					'label' => esc_html__( 'Border', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .wrap-project-post .owl-dots .owl-dot:hover, {{WRAPPER}} .wrap-project-post .owl-dots .owl-dot.active',
					'condition' => [
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->add_responsive_control( 
				'carousel_bullets_border_radius_hover',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post .owl-dots .owl-dot:hover, {{WRAPPER}} .wrap-project-post .owl-dots .owl-dot.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	// /.End Carousel	

		// Start Style
	        $this->start_controls_section( 'section_post_excerpt',
	            [
	                'label' => esc_html__( 'Style', 'themesflat-elementor' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

			$this->add_control(
				'h_style_general',
				[
					'label' => esc_html__( 'Gereral', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control( 
	        	'padding',
				[
					'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post .item .project-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],					
				]
			);	

			$this->add_responsive_control( 
				'margin',
				[
					'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'allowed_dimensions' => [ 'right', 'left' ],
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post .item .project-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);  

			$this->add_group_control( 
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .wrap-project-post .item .project-post',
				]
			);

			$this->add_group_control( 
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'border',
					'label' => esc_html__( 'Border', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .wrap-project-post .item .project-post',
				]
			);    

			$this->add_responsive_control( 
				'border_radius_gerenal',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => true,
					],
					'selectors' => [
						'{{WRAPPER}} .wrap-project-post .item .project-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			); 

			$this->add_control(
				'h_style_image',
				[
					'label' => esc_html__( 'Image', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control( 
				'image_height',
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
						'{{WRAPPER}} .tf-project-wrap .project-post .featured-post img' => 'height: {{SIZE}}{{UNIT}};object-fit: cover;',
					],
				]
			); 

			$this->add_control(
				'h_style_content',
				[
					'label' => esc_html__( 'Content', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control( 
				'background_color_content',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .project-post .content' => 'background-color: {{VALUE}}',
					],
				]
			);  

			$this->add_responsive_control(
				'padding_content',
				[
					'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .project-post .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);	

			$this->add_control(
				'border_radius_content',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .project-post .content' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
				]
			);	

	        $this->add_control(
				'h_style_title',
				[
					'label' => esc_html__( 'Title', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
					'fields_options' => [
				        'typography' => ['default' => 'yes'],
				        'font_family' => [
				            'default' => 'Rajdhani',
				        ],
				        'font_size' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '20',
				            ],
				        ],
				        'font_weight' => [
				            'default' => '700',
				        ],
				        'line_height' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '30',
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
					'selector' => '{{WRAPPER}} .tf-project-wrap .tf-project .project-post .title',
				]
			); 

			$this->add_control( 
				'title_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .title a' => 'color: {{VALUE}}',				
					],
				]
			);

			$this->add_control( 
				'title_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#E3CCA1',
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .title a:hover' => 'color: {{VALUE}}',				
					],
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '5',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'h_style_desc',
				[
					'label' => esc_html__( 'Description', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
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
					'selector' => '{{WRAPPER}} .tf-project-wrap .tf-project .project-post .desc',
				]
			); 

			$this->add_control( 
				'desc_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#565872',
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .desc' => 'color: {{VALUE}}',				
					],
				]
			);

			$this->add_control(
				'h_style_category',
				[
					'label' => esc_html__( 'Category', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'style' => 'style2',
					],
				]
			);

			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'category_typography',
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
				            'default' => '500',
				        ],
				        'line_height' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '20',
				            ],
				        ],
				        'text_transform' => [
							'default' => 'uppercase',
						],
						'letter_spacing' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '3.3',
				            ],
				        ],
				    ],
					'selector' => '{{WRAPPER}} .tf-project-wrap .tf-project .project-post .post-meta',
				]
			);

			$this->add_control( 
				'category_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#E3CCA1',
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .post-meta a' => 'color: {{VALUE}}',				
					],
				]
			);

			$this->add_control( 
				'category_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .post-meta a:hover' => 'color: {{VALUE}}',				
					],
				]
			);

			$this->add_responsive_control(
				'margin_category',
				[
					'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '',
						'right' => '',
						'bottom' => '',
						'left' => '',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_category',
				[
					'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '',
						'right' => '',
						'bottom' => '',
						'left' => '',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .post-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'h_style_btn',
				[
					'label' => esc_html__( 'Button', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control( 
				'btn_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .content .tf-button' => 'color: {{VALUE}}',				
					],
				]
			);

			$this->add_control( 
				'btn_bgcolor',
				[
					'label' => esc_html__( ' Background', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#E3CCA1',
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .content .tf-button' => 'background-color: {{VALUE}}',				
					],
				]
			);

			$this->add_control( 
				'btn_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#E3CCA1',
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .content .tf-button:hover' => 'color: {{VALUE}}',				
					],
				]
			);			

			$this->add_control( 
				'btn_bgcolor_hover',
				[
					'label' => esc_html__( ' Background Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .tf-project-wrap .tf-project .project-post .content .tf-button:hover' => 'background-color: {{VALUE}}',				
					],
				]
			);
			        
        	$this->end_controls_section();    
	    // /.End Style 
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();		

		$this->add_render_attribute( 'tf_project_wrap', ['id' => "tf-project-{$this->get_id()}", 'class' => ['tf-project-wrap', 'tf-widget-project-wrap', $settings['style'] ], 'data-tabid' => $this->get_id()] );

		$show_filter_class = '';

		if ( get_query_var('paged') ) {
           $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
           $paged = get_query_var('page');
        } else {
           $paged = 1;
        }
		$query_args = array(
            'post_type' => 'project',
            'posts_per_page' => $settings['posts_per_page'],
            'paged'     => $paged
        );

        if (! empty( $settings['posts_categories'] )) {        	
        	$query_args['tax_query'] = array(
							        array(
							            'taxonomy' => 'project_category',
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

		$class_carousel = $data_carousel = $row = '';
		if ($settings['carousel'] == 'yes') {
			$class_carousel = 'owl-carousel owl-theme';
		}else {
			$row = 'row';
		}		
		
		$count = 1;
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) : ?>
		<div <?php echo $this->get_render_attribute_string('tf_project_wrap'); ?>>
			<div class="tf-project">
				<?php
				if ($settings['show_filter'] == 'yes'):
					$show_filter_class = 'show-filter'; 
					$filter_category_order = $settings['filter_category_order'];
					$filters = wp_list_pluck( get_terms( 'project_category','hide_empty=1'), 'name','slug' );
					echo '<ul class="project-filter posttype-filter">';
						echo '<li class="active"><a data-filter="*" href="#">' . $settings['filter_category_all'] . '</a></li>'; 
						if ($filter_category_order == '') { 

							foreach ($filters as $key => $value) {
								echo '<li><a data-filter=".' . esc_attr( strtolower($key)) . '" href="#" title="' . esc_attr( $value ) . '">' . esc_html( $value ) . '</a></li>'; 
							}
						
						}
						else {
							$filter_category_order = explode(",", $filter_category_order);
							foreach ($filter_category_order as $key) {
								$key = trim($key);
								echo '<li><a data-filter=".' . esc_attr( strtolower($key)) . '" href="#" title="' . esc_attr( $filters[$key] ) . '">' . esc_html( $filters[$key] ) . '</a></li>'; 
							}
						}
	                echo '</ul>';
	            endif;            
				?>
				<div class="container-filter wrap-project-post <?php echo esc_attr($row); ?> <?php echo 'column-'.esc_attr($settings['layout']); ?> <?php echo esc_attr($show_filter_class); ?> <?php echo esc_attr($class_carousel); ?>" data-items="<?php echo esc_attr($settings['layout']); ?>" data-space="<?php echo esc_attr($settings['spacing_item_carousel']); ?>" data-loop="<?php echo esc_attr($settings['carousel_loop']); ?>" data-auto="<?php echo esc_attr($settings['carousel_auto']); ?>" data-prev_icon="<?php echo esc_attr($settings['carousel_prev_icon']) ?>" data-next_icon="<?php echo esc_attr($settings['carousel_next_icon']) ?>" data-arrow="<?php echo esc_attr($settings['carousel_arrow']) ?>" data-bullets="<?php echo esc_attr($settings['carousel_bullets']) ?>" >
					<?php while ( $query->have_posts() ) : $query->the_post();
						$get_id_post_thumbnail = get_post_thumbnail_id();
						$featured_image = '';
						$featured_image = sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));					
						$featured_image_gallery = sprintf(\Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));
						?>
						<?php 
						global $post;
				        $id = $post->ID;
				        $termsArray = get_the_terms( $id, 'project_category' );
				        $termsString = "";

				        if ( $termsArray ) {
				        	foreach ( $termsArray as $term ) {
				        		$itemname = strtolower( $term->slug ); 
				        		$itemname = str_replace( ' ', '-', $itemname );
				        		$termsString .= $itemname.' ';
				        	}
				        }
						?>
						<?php if ($settings['style'] == 'style1'): ?>
							<div class="item <?php echo esc_attr( $termsString ); ?>">
		                        <div class="project-post project-post-<?php the_ID(); ?>">
		                            <div class="featured-post">
		                                <a href="<?php echo get_the_permalink(); ?>">
		                                <?php echo sprintf('%s',$featured_image); ?>
		                                </a>
		                            </div>
		                            <div class="content">
		                                <div class="inner-content">                                
		                                    <h2 class="title">
		                                         <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
		                                    </h2>           
											<div class="desc"><?php echo wp_trim_words( get_the_content(), $settings['excerpt_lenght'], '' ); ?></div>                                    
		                                    <div class="tf-button-container">
		                                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="tf-button bt_icon_after"><i class="fas fa-arrow-right"></i></a>
		                                    </div>
		                                </div>                                              
		                            </div>
		                        </div>
		                    </div> 
	                    <?php elseif ($settings['style'] == 'style2'): ?>
	                    	<div class="item <?php echo esc_attr( $termsString ); ?>">
		                        <div class="project-post project-post-<?php the_ID(); ?>">
		                            <div class="featured-post">
		                                <a href="<?php echo get_the_permalink(); ?>">
		                                <?php echo sprintf('%s',$featured_image); ?>
		                                </a>
		                            </div>
		                            <div class="content">
		                                <div class="inner-content">
											<div class="post-meta">
		                                        <?php echo the_terms( get_the_ID(), 'project_category', '', ' , ', '' ); ?>
		                                    </div>	                                
		                                    <h2 class="title">
		                                         <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
		                                    </h2>           
		                                    <div class="tf-button-container">
		                                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="tf-button bt_icon_after"><i class="fas fa-arrow-right"></i></a>
		                                    </div>
		                                </div>                                              
		                            </div>
		                        </div>
		                    </div>  
							<?php elseif ($settings['style'] == 'style3'): ?>
								<div class="item <?php echo esc_attr( $termsString ); ?>">
									<div class="project-post project-post-<?php the_ID(); ?>">
										<div class="featured-post">
											<a href="<?php echo $featured_image_gallery; ?>">
												<?php echo sprintf('%s',$featured_image); ?>
												<i aria-hidden="true" class="icon-gallery janelas-icon-search"></i>
											</a>
										</div>
									</div>
								</div>  
                    	<?php endif; ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
		<?php
		else:
			esc_html_e('No posts found', 'themesflat-elementor');
		endif;		
		
	}

	

}