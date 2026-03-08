<?php
class TFTabs_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tftabs';
    }
    
    public function get_title() {
        return esc_html__( 'TF Tabs', 'themesflat-elementor' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-tabs'];
	}

    public function get_script_depends() {
		return [ 'tf-tabs' ];
	}

	protected function register_controls() {
        // Start Tab Setting        
			$this->start_controls_section( 'section_tabs',
	            [
	                'label' => esc_html__('Tabs', 'themesflat-elementor'),
	            ]
	        );	 
	        $this->add_control( 'show_icon',
				[
					'label' => esc_html__( 'Show Icon', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'themesflat-elementor' ),
					'label_off' => esc_html__( 'Hide', 'themesflat-elementor' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);   
			$this->add_control( 'show_image',
				[
					'label' => esc_html__( 'Show Image', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'themesflat-elementor' ),
					'label_off' => esc_html__( 'Hide', 'themesflat-elementor' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);     
	        $repeater = new \Elementor\Repeater();
	        $repeater->add_control( 'set_active',
				[
					'label' => esc_html__( 'Set Active Tab', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'themesflat-elementor' ),
					'label_off' => esc_html__( 'No', 'themesflat-elementor' ),
					'return_value' => 'set-active-tab',
					'default' => 'inactive',
				]
			);
	        $repeater->add_control( 'heading_icon',
				[
					'label' => esc_html__( 'Icon', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);
			$repeater->add_control( 'icon_style',
				[
					'label' => esc_html__( 'Icon Style', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'icon' => [
							'title' => esc_html__( 'Icon', 'themesflat-elementor' ),
							'icon' => 'eicon-favorite',
						],
						'image' => [
							'title' => esc_html__( 'Image', 'themesflat-elementor' ),
							'icon' => 'eicon-image',
						],
					],
					'default' => 'icon',
				]
			);			
			$repeater->add_control( 'icon_tabs',
				[
					'label' => esc_html__( 'Icon', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'fa4compatibility' => 'icon_tab',
					'default' => [
						'value' => 'fas fa-user',
						'library' => 'fa-solid',
					],
					'condition' => [
                        'icon_style' => 'icon',
                    ],
				]
			);
			$repeater->add_control( 'image',
				[
					'label' => esc_html__( 'Choose Image', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
					'condition' => [
                        'icon_style' => 'image',
                    ],
				]
			);	
			$repeater->add_control( 'heading_title',
				[
					'label' => esc_html__( 'Nav', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
	        $repeater->add_control( 'list_title', [
					'label' => esc_html__( 'Nav text', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Tab' , 'themesflat-elementor' ),
					'label_block' => true,
				]
			);
			$repeater->add_control( 'heading_content',
				[
					'label' => esc_html__( 'Content', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$repeater->add_control( 'list_content_text_type',
				[
					'label' => esc_html__( 'Content type', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'editor',
					'options' => [
						'editor'  => esc_html__( 'Editor', 'themesflat-elementor' ),
						'template' => esc_html__( 'Template', 'themesflat-elementor' ),
					],
				]
			);	
			$repeater->add_control( 'list_content', [
					'label' => esc_html__( 'Content text', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'Aliquam faucibus, odio nec commodo aliquam, neque felis placerat dui, a porta ante lectus dapibus est. Aliquam a bibendum mi, sed condimentum' , 'themesflat-elementor' ),
					'label_block' => true,
					'condition' => [
                        'list_content_text_type' => 'editor',
                    ],
				]
			);
			$repeater->add_control( 'list_content_template',
				[
					'label' => esc_html__( 'Choose Template', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => ThemesFlat_Addon_For_Elementor_janelas::tf_get_template_elementor(),
					'condition' => [
                        'list_content_text_type' => 'template',
                    ],
				]
			);
			$repeater->add_control(
				'image_content',
				[
					'label' => esc_html__( 'Content Image', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
	        $this->add_control( 'tab_list',
				[					
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'list_title' => esc_html__( 'Vision', 'themesflat-elementor' ),
							'list_content' => esc_html__( 'Aliquam faucibus, odio nec commodo aliquam, neque felis placerat dui, a porta ante lectus dapibus est. Aliquam a bibendum mi, sed condimentum', 'themesflat-elementor' ),
						],
						[
							'list_title' => esc_html__( 'Mission', 'themesflat-elementor' ),
							'list_content' => esc_html__( 'Aliquam faucibus, odio nec commodo aliquam, neque felis placerat dui, a porta ante lectus dapibus est. Aliquam a bibendum mi, sed condimentum', 'themesflat-elementor' ),
						],
						[
							'list_title' => esc_html__( 'Strategy', 'themesflat-elementor' ),
							'list_content' => esc_html__( 'Aliquam faucibus, odio nec commodo aliquam, neque felis placerat dui, a porta ante lectus dapibus est. Aliquam a bibendum mi, sed condimentum', 'themesflat-elementor' ),
						],
					],
					'title_field' => '{{{ list_title }}}',
				]
			);
			$this->add_control( 'hr_tab_type',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);
			$this->add_control( 'tab_type',
				[
					'label' => esc_html__( 'Type', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => [
						'horizontal'  => esc_html__( 'Horizontal', 'themesflat-elementor' ),
						'vertical' => esc_html__( 'Vertical', 'themesflat-elementor' ),
					],
				]
			);	
			$this->end_controls_section();
        // /.End Tab Setting 

	    // Start Style Icon
	        $this->start_controls_section( 'section_style_icon',
	            [
	                'label' => esc_html__( 'Tab Icon', 'themesflat-elementor' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_control( 'icon_position',
				[
					'label' => esc_html__( 'Position', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'default' => 'icon-position-left',
					'options' => [
						'icon-position-left' => [
							'title' => esc_html__( 'Left', 'themesflat-elementor' ),
							'icon' => 'eicon-h-align-left',
						],
						'icon-position-top' => [
							'title' => esc_html__( 'Top', 'themesflat-elementor' ),
							'icon' => 'eicon-v-align-top',
						],
						'icon-position-right' => [
							'title' => esc_html__( 'Right', 'themesflat-elementor' ),
							'icon' => 'eicon-h-align-right',
						],
					],
					'toggle' => false,
				]
			);

	        $this->add_responsive_control( 'icon_size',
				[
					'label' => esc_html__( 'Size', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 0.5,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 15,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li img, {{WRAPPER}} .tf-tabs .tf-tabnav ul > li svg' => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control( 'icon_gap',
				[
					'label' => esc_html__( 'Gap', 'themesflat-elementor' ),
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
						'size' => 5,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-tabs.icon-position-left .tf-tabnav ul > li img, {{WRAPPER}} .tf-tabs.icon-position-left .tf-tabnav ul > li svg, {{WRAPPER}} .tf-tabs.icon-position-left .tf-tabnav ul > li i' => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-tabs.icon-position-top .tf-tabnav ul > li img, {{WRAPPER}} .tf-tabs.icon-position-top .tf-tabnav ul > li svg, {{WRAPPER}} .tf-tabs.icon-position-top .tf-tabnav ul > li i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-tabs.icon-position-right .tf-tabnav ul > li img, {{WRAPPER}} .tf-tabs.icon-position-right .tf-tabnav ul > li svg, {{WRAPPER}} .tf-tabs.icon-position-right .tf-tabnav ul > li i' => 'margin-left: {{SIZE}}{{UNIT}};',
					],
				]
			);			
	        
	        $this->end_controls_section();    
	    // /.End Style Icon 

	    // Start Style Tab Nav
	        $this->start_controls_section( 'section_style_title',
	            [
	                'label' => esc_html__( 'Tab Nav', 'themesflat-elementor' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_control( 'heading_wrap_nav',
				[
					'label' => esc_html__( 'Wrap Nav', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);

			$this->add_responsive_control( 'nav_align',
				[
					'label' => esc_html__( 'Alignment', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'default' => 'nav-justify',
					'toggle' => false,
					'options' => [
						'nav-left'    => [
							'title' => esc_html__( 'Left', 'themesflat-elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'nav-center' => [
							'title' => esc_html__( 'Center', 'themesflat-elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'nav-right' => [
							'title' => esc_html__( 'Right', 'themesflat-elementor' ),
							'icon' => 'eicon-text-align-right',
						],
						'nav-justify' => [
							'title' => esc_html__( 'Justified', 'themesflat-elementor' ),
							'icon' => 'eicon-text-align-justify',
						],
					],
					'condition' => [
                        'tab_type' => 'horizontal',
                    ],
				]
			);									

			$this->add_responsive_control( 'wrap_nav_padding',
	            [
	                'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', 'em', '%'],
	                'selectors' => [
	                    '{{WRAPPER}} .tf-tabs  .tf-tabnav ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );	

	        $this->add_responsive_control( 'wrap_nav_margin',
	            [
	                'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', 'em', '%'],
	                'default' => [
						'top' => '0',
						'right' => '-10',
						'bottom' => '0',
						'left' => '-10',
						'unit' => 'px',
						'isLinked' => false,
					],
	                'selectors' => [
	                    '{{WRAPPER}} .tf-tabs  .tf-tabnav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_control( 'wrap_nav_background',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .tf-tabs .tf-tabnav ul' => 'background-color: {{VALUE}}',
					],
				]
			);        

	        $this->add_control( 'heading_nav',
				[
					'label' => esc_html__( 'Item Nav', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);				

	        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li .tab-title-text',
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
				]
			);

			$this->add_responsive_control( 'title_padding',
	            [
	                'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', 'em', '%'],
	                'default' => [
						'top' => '9',
						'right' => '0',
						'bottom' => '9',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => false,
					],
	                'selectors' => [
	                    '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );			

	        $this->add_responsive_control( 'title_margin',
	            [
	                'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', 'em', '%'],
	                'default' => [
						'top' => '0',
						'right' => '10',
						'bottom' => '0',
						'left' => '10',
						'unit' => 'px',
						'isLinked' => false,
					],
	                'selectors' => [
	                    '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],	                
	            ]
	        );

	        $this->add_control( 'title_hover_animation',
				[
					'label' => esc_html__( 'Hover Animation', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,	
				]
			);

	        $this->start_controls_tabs( 'title_style_tabs' );
	        	$this->start_controls_tab( 'title_style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'themesflat-elementor' ),
					]
					);	        		
			        $this->add_control( 'title_color',
						[
							'label' => esc_html__( 'Color', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '#434E6E',
							'selectors' => [
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li .tab-title-text' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_control( 'title_background_color',
						[
							'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '#F8F8F8',
							'selectors' => [
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li' => 'background-color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control( \Elementor\Group_Control_Border::get_type(),
			            [
			                'name' => 'title_border',
			                'label' => esc_html__( 'Border', 'themesflat-elementor' ),
			                'selector' => '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li',
			            ]
			        );
			        $this->add_responsive_control( 'title_border_radius',
			            [
			                'label' => esc_html__('Border Radius', 'themesflat-elementor'),
			                'type' => \Elementor\Controls_Manager::DIMENSIONS,
			                'size_units' => ['px', 'em', '%'],
			                'default' => [
								'top' => '5',
								'right' => '5',
								'bottom' => '5',
								'left' => '5',
								'unit' => 'px',
								'isLinked' => false,
							],
			                'selectors' => [
			                    '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );
			        $this->add_group_control( \Elementor\Group_Control_Box_Shadow::get_type(),
			            [
			                'name' => 'title_shadow',	                
			                'label' => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
			                'selector' => '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li',
			            ]
			        );
			        $this->add_control( 'heading_icon_normal',
						[
							'label' => esc_html__( 'Icon', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::HEADING,
						]
					);
					$this->add_control( 'icon_color',
						[
							'label' => esc_html__( 'Color', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '#005963',
							'selectors' => [
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li svg' => 'fill: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
				$this->start_controls_tab( 'title_style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'themesflat-elementor' ),
					]
					);
					$this->add_control( 'title_color_hover',
						[
							'label' => esc_html__( 'Color', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '#434E6E',
							'selectors' => [
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li:hover .tab-title-text' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control( 'title_background_color_hover',
						[
							'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '#E3CCA1',
							'selectors' => [
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li:hover' => 'background-color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control( \Elementor\Group_Control_Border::get_type(),
			            [
			                'name' => 'title_border_hover',
			                'label' => esc_html__( 'Border', 'themesflat-elementor' ),
			                'selector' => '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li:hover',
			            ]
			        );
			        $this->add_responsive_control( 'title_border_radius_hover',
			            [
			                'label' => esc_html__('Border Radius', 'themesflat-elementor'),
			                'type' => \Elementor\Controls_Manager::DIMENSIONS,
			                'size_units' => ['px', 'em', '%'],
			                'selectors' => [
			                    '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );
			        $this->add_group_control( \Elementor\Group_Control_Box_Shadow::get_type(),
			            [
			                'name' => 'title_shadow_hover',	                
			                'label' => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
			                'selector' => '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li:hover',
			            ]
			        );
			        $this->add_control( 'heading_icon_hover',
						[
							'label' => esc_html__( 'Icon', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::HEADING,
						]
					);
					$this->add_control( 'icon_color_hover',
						[
							'label' => esc_html__( 'Color', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '#ffffff',
							'selectors' => [
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li:hover i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li:hover svg' => 'fill: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab( 'title_style_active_tab',
					[
						'label' => esc_html__( 'Active', 'themesflat-elementor' ),
					]
					);
					$this->add_control( 'title_color_active',
						[
							'label' => esc_html__( 'Color', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '#434E6E',
							'selectors' => [
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.active .tab-title-text' => 'color: {{VALUE}};',
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.set-active-tab .tab-title-text' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control( 'title_background_color_active',
						[
							'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '#E3CCA1',
							'selectors' => [
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.active, {{WRAPPER}} .tf-tabs .tf-tabnav ul > li.set-active-tab' => 'background-color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control( \Elementor\Group_Control_Border::get_type(),
			            [
			                'name' => 'title_border_active',
			                'label' => esc_html__( 'Border', 'themesflat-elementor' ),
			                'selector' => '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.active, {{WRAPPER}} .tf-tabs .tf-tabnav ul > li.set-active-tab',
			            ]
			        );
			        $this->add_responsive_control( 'title_border_radius_active',
			            [
			                'label' => esc_html__('Border Radius', 'themesflat-elementor'),
			                'type' => \Elementor\Controls_Manager::DIMENSIONS,
			                'size_units' => ['px', 'em', '%'],
			                'selectors' => [
			                    '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                    '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.set-active-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );
			        $this->add_group_control( \Elementor\Group_Control_Box_Shadow::get_type(),
			            [
			                'name' => 'title_shadow_active',	                
			                'label' => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
			                'selector' => '{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.active, {{WRAPPER}} .tf-tabs .tf-tabnav ul > li.set-active-tab',
			            ]
			        );
			        $this->add_control( 'heading_icon_active',
						[
							'label' => esc_html__( 'Icon', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::HEADING,
						]
					);
					$this->add_control( 'icon_color_active',
						[
							'label' => esc_html__( 'Color', 'themesflat-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '#ffffff',
							'selectors' => [
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.active i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.active svg' => 'fill: {{VALUE}};',
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.set-active-tab i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .tf-tabs .tf-tabnav ul > li.set-active-tab svg' => 'fill: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
	        
	        $this->end_controls_section();    
	    // /.End Style Tab Nav 

	    // Start Tab Style Tab Content 
	        $this->start_controls_section( 'section_style_content',
	            [
	                'label' => esc_html__( 'Tab Content', 'themesflat-elementor' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

			$this->add_control(
				'align_content',
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
						]
					],
					'selectors' => [
						'{{WRAPPER}} .tf-tabs .tf-tabcontent' => 'text-align: {{VALUE}}',
					],
				]
			);

	        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'content_typography',
					'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-tabs .tf-tabcontent',
				]
			);

			$this->add_control( 'content_color',
				[
					'label' => esc_html__( 'Color Text', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#000000',
					'selectors' => [
						'{{WRAPPER}} .tf-tabs .tf-tabcontent' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control( \Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'content_background_color',
					'label' => esc_html__( 'Background Type', 'themesflat-elementor' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .tf-tabs .tf-tabcontent',
				]
			);

			$this->add_responsive_control( 'content_padding',
	            [
	                'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', 'em', '%'],
	                'default' => [
						'top' => '28',
						'right' => '3',
						'bottom' => '21',
						'left' => '3',
						'unit' => 'px',
						'isLinked' => false,
					],
	                'selectors' => [
	                    '{{WRAPPER}} .tf-tabs .tf-tabcontent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control( 'content_margin',
	            [
	                'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', 'em', '%'],
	                'selectors' => [
	                    '{{WRAPPER}} .tf-tabs .tf-tabcontent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control( \Elementor\Group_Control_Border::get_type(),
	            [
	                'name' => 'content_border',
	                'label' => esc_html__( 'Border', 'themesflat-elementor' ),
	                'selector' => '{{WRAPPER}} .tf-tabs .tf-tabcontent',
	            ]
	        );
	        
	        $this->add_responsive_control( 'content_border_radius',
	            [
	                'label' => esc_html__('Border Radius', 'themesflat-elementor'),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', 'em', '%'],
	                'selectors' => [
	                    '{{WRAPPER}} .tf-tabs .tf-tabcontent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control( \Elementor\Group_Control_Box_Shadow::get_type(),
	            [
	                'name' => 'content_shadow',	                
	                'label' => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
	                'selector' => '{{WRAPPER}} .tf-tabs .tf-tabcontent',	                
	            ]
	        );

			$this->add_control( 'content_entrance_animation',
				[
					'label' => esc_html__( 'Entrance Animation', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'label_block' => true,
					'default' => 'fadeIn',
					'options' => [
						'none' => esc_html__( 'None', 'themesflat-elementor' ),
						'fadeIn'  => esc_html__( 'Fade In', 'themesflat-elementor' ),						
						'fadeInDown' => esc_html__( 'Fade In Down', 'themesflat-elementor' ),
						'fadeInLeft' => esc_html__( 'Fade In Left', 'themesflat-elementor' ),
						'fadeInRight' => esc_html__( 'Fade In Right', 'themesflat-elementor' ),
						'fadeInUp' => esc_html__( 'Fade In Up', 'themesflat-elementor' ),
						'zoomIn'  => esc_html__( 'Zoom In', 'themesflat-elementor' ),						
						'zoomInDown' => esc_html__( 'Zoom In Down', 'themesflat-elementor' ),
						'zoomInLeft' => esc_html__( 'Zoom In Left', 'themesflat-elementor' ),
						'zoomInRight' => esc_html__( 'Zoom In Right', 'themesflat-elementor' ),
						'zoomInUp' => esc_html__( 'Zoom In Up', 'themesflat-elementor' ),
						'bounceIn'  => esc_html__( 'Bounce In', 'themesflat-elementor' ),						
						'bounceInDown' => esc_html__( 'Bounce In Down', 'themesflat-elementor' ),
						'bounceInLeft' => esc_html__( 'Bounce In Left', 'themesflat-elementor' ),
						'bounceInRight' => esc_html__( 'Bounce In Right', 'themesflat-elementor' ),
						'bounceInUp' => esc_html__( 'Bounce In Up', 'themesflat-elementor' ),
						'slideInDown' => esc_html__( 'Slide In Down', 'themesflat-elementor' ),
						'slideInLeft' => esc_html__( 'Slide In Left', 'themesflat-elementor' ),
						'slideInRight' => esc_html__( 'Slide In Right', 'themesflat-elementor' ),
						'slideInUp' => esc_html__( 'Slide In Up', 'themesflat-elementor' ),
						'rotateIn'  		=> esc_html__( 'Rotate In', 'themesflat-elementor' ),						
						'rotateInDownLeft' 	=> esc_html__( 'Rotate In Down Left', 'themesflat-elementor' ),
						'rotateInDownRight' => esc_html__( 'Rotate In Down Right', 'themesflat-elementor' ),
						'rotateInUpLeft' 	=> esc_html__( 'Rotate In Up Left', 'themesflat-elementor' ),
						'rotateInUpRight' => esc_html__( 'Rotate In Up Right', 'themesflat-elementor' ),
						'bounce'  => esc_html__( 'Bounce', 'themesflat-elementor' ),						
						'flash' => esc_html__( 'Flash', 'themesflat-elementor' ),
						'pulse' => esc_html__( 'Pulse', 'themesflat-elementor' ),
						'rubberBand' => esc_html__( 'Rubber Band', 'themesflat-elementor' ),
						'shake' => esc_html__( 'Shake', 'themesflat-elementor' ),
						'headShake'  => esc_html__( 'Head Shake', 'themesflat-elementor' ),						
						'swing' => esc_html__( 'Swing', 'themesflat-elementor' ),
						'tada' => esc_html__( 'Tada', 'themesflat-elementor' ),
						'wobble' => esc_html__( 'Wobble', 'themesflat-elementor' ),
						'jello' => esc_html__( 'Jello', 'themesflat-elementor' ),
						'lightSpeedIn' => esc_html__( 'Light Speed In', 'themesflat-elementor' ),
						'rollIn' => esc_html__( 'Roll In', 'themesflat-elementor' ),
					],
				]
			);
	        
	        $this->end_controls_section();    
	    // /.End Tab Style Tab Content 

        // Start Tab Style Triger
	        $this->start_controls_section( 'section_style_triger',
	            [
	                'label' => esc_html__( 'Tab Active Triger', 'themesflat-elementor' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_control(
				'show_triger',
				[
					'label' => esc_html__( 'Show Triger', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'themesflat-elementor' ),
					'label_off' => esc_html__( 'Hide', 'themesflat-elementor' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

	        $this->add_control( 'triger_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#E3CCA1',					
					'selectors' => [
						'{{WRAPPER}} .tf-tabs.horizontal .tf-tabnav > ul > li.active:after' => 'border-top-color: {{VALUE}}',
						'{{WRAPPER}} .tf-tabs.vertical .tf-tabnav > ul > li.active:after' => 'border-left-color: {{VALUE}};',
						'{{WRAPPER}} .tf-tabs.horizontal .tf-tabnav > ul > li.set-active-tab:after' => 'border-top-color: {{VALUE}}',
						'{{WRAPPER}} .tf-tabs.vertical .tf-tabnav > ul > li.set-active-tab:after' => 'border-left-color: {{VALUE}};',
					],
					'condition' => [
                        'show_triger' => 'yes',
                    ],
				]
			);

			$this->add_responsive_control( 'triger_size',
				[
					'label' => esc_html__( 'Triger Size', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],						
					],
					'default' => [
							'unit' => 'px',
							'size' => 10,
						],
					'condition' => [
                        'show_triger' => 'yes',
                    ],
					'selectors' => [
						'{{WRAPPER}} .tf-tabs.horizontal .tf-tabnav > ul > li.active:after' => 'border-width: {{SIZE}}{{UNIT}}; bottom: -{{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-tabs.vertical .tf-tabnav > ul > li.active:after' => 'border-width: {{SIZE}}{{UNIT}}; right: -{{SIZE}}{{UNIT}}; top: calc(50% - {{SIZE}}{{UNIT}});',
						'{{WRAPPER}} .tf-tabs.horizontal .tf-tabnav > ul > li.set-active-tab:after' => 'border-width: {{SIZE}}{{UNIT}}; bottom: -{{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-tabs.vertical .tf-tabnav > ul > li.set-active-tab:after' => 'border-width: {{SIZE}}{{UNIT}}; right: -{{SIZE}}{{UNIT}}; top: calc(50% - {{SIZE}}{{UNIT}});',
					],
				]
			);

	        $this->end_controls_section();   
	    // /.End Tab Style Triger 
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'tf_tabs_wrapper', ['id' => "tf-tabs-{$this->get_id()}", 'class' => ['tf-tabs', $settings['tab_type'], 'tabs-'.$settings['tab_type'], $settings['icon_position'], 'show-triger-'.$settings['show_triger'], $settings['nav_align'] ], 'data-tabid' => $this->get_id()] );

		$migrated = isset( $settings['__fa4_migrated']['icon_tabs'] );	
		$is_new = empty( $settings['icon_tab'] );

		$count_li = 0;
		$count_content = 0;		
		?>
		<div <?php echo $this->get_render_attribute_string('tf_tabs_wrapper'); ?>>
			<div class="tf-tabnav">
				<ul>
					<?php foreach ($settings['tab_list'] as $tab): $count_li ++;?>
					<li class="tablinks <?php echo esc_attr($tab['set_active']); ?> elementor-animation-<?php echo esc_attr($settings['title_hover_animation']); ?>" data-tab="tab-<?php echo esc_attr($count_li); ?>">	
						<?php if ( $settings['show_icon'] == 'yes' ) {
							echo '<span class="wrap-icon">';
							if ( $tab['icon_style'] == 'image' ) {								
								echo '<img src="' . esc_url($tab['image']['url']) . '" alt="image"/>'; 
							} else {
								if ( $is_new || $migrated ) {
									if ( isset($tab['icon_tabs']['value']['url']) ) {
										\Elementor\Icons_Manager::render_icon( $tab['icon_tabs'], [ 'aria-hidden' => 'true' ] );
									}else {
										echo '<i class="' . esc_attr($tab['icon_tabs']['value']) . '" aria-hidden="true"></i>';
									}									
								} else {
									echo '<i class="' . esc_attr($tab['icon_tab']) . ' aria-hidden="true""></i>';
								}								
							}
							echo '</span>';
						} ?>						
						<?php if ( $tab['list_title'] != '' ) : ?>
							<span class="tab-title-text"><?php echo esc_attr($tab['list_title']); ?></span>
						<?php endif; ?>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
			<div class="tf-tabcontent">
				<?php foreach ($settings['tab_list'] as $tab): $count_content ++; ?>
				<div id="tab-<?php echo esc_attr($count_content); ?>" class="tf-tabcontent-inner <?php echo esc_attr($tab['set_active']); ?> animated <?php echo esc_attr($settings['content_entrance_animation']); ?>">
					<?php 
					if ( $tab['list_content_text_type'] == 'template' ) {
						if ( !empty($tab['list_content_template']) ) {
				            $post_id = flat_get_post_page_content($tab['list_content_template']);
				            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($post_id);
				        }
					}else {
						echo do_shortcode( $tab['list_content'] ); 
					}
					?>
					
					<?php if ( $settings['show_image'] == 'yes' ) : ?>
						<img src="<?php echo esc_attr($tab['image_content']['url']); ?>" alt="image">
					<?php endif; ?>

				</div>
				<?php endforeach;?>
			</div>
		</div>
		
		<?php
		
	}

}