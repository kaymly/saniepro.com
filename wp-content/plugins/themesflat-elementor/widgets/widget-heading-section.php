<?php
class TFHeadingSection_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-heading-section';
    }
    
    public function get_title() {
        return esc_html__( 'TF Heading Section', 'themesflat-elementor' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-heading-section'];
	}

	protected function register_controls() {
		// Start Tab Heading Section        
			$this->start_controls_section( 'section_title_section',
	            [
	                'label' => esc_html__('Heading Section', 'themesflat-elementor'),
	            ]
	        );       

			$this->add_control( 
	        	'html_tag',
				[
					'label' => esc_html__( 'HTML Tag', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'h2',
					'options' => [
						'h1' => esc_html__( 'H1', 'themesflat-elementor' ),
						'h2' => esc_html__( 'H2', 'themesflat-elementor' ),
						'h3' => esc_html__( 'H3', 'themesflat-elementor' ),
						'h4' => esc_html__( 'H4', 'themesflat-elementor' ),
						'h5' => esc_html__( 'H5', 'themesflat-elementor' ),
						'h6' => esc_html__( 'H6', 'themesflat-elementor' ),
						'span' => esc_html__( 'span', 'themesflat-elementor' ),
						'p' => esc_html__( 'p', 'themesflat-elementor' ),
						'div' => esc_html__( 'div', 'themesflat-elementor' ),
					],
				]
			);	

			$this->add_control(
				'before_title',
				[
					'label' => esc_html__( 'Before Heading', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'About Us', 'themesflat-elementor' ),
					'label_block' => true,
				]
			);		

			$this->add_control(
				'heading',
				[
					'label' => esc_html__( 'Heading', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::TEXT,					
					'default' => esc_html__( 'A Trendy Doors for Trendy Home', 'themesflat-elementor' ),
					'label_block' => true,
				]
			);		

			$this->add_control(
				'sub_title',
				[
					'label' => esc_html__( 'Sub Title', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack. Quick wafting zephyrs vex bold Jim. Quick', 'themesflat-elementor' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'align',
				[
					'label' => esc_html__( 'Alignment', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'default' => 'left',
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
						'{{WRAPPER}} .tf-heading-section .heading-section' => 'text-align: {{VALUE}}',
					],
				]
			);
	        
			$this->end_controls_section();
        // /.End Tab Heading Section    

	    // Start Style
	        $this->start_controls_section( 'section_style',
	            [
	                'label' => esc_html__( 'Style', 'themesflat-elementor' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_control(
				'h_before_title',
				[
					'label' => esc_html__( 'Before Heading', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);
			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography_before_title',
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
				                'unit' => 'em',
				                'size' => '1',
				            ],
				        ],
						'letter_spacing' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '3.3',
				            ],
				        ],
				        'text_transform' => [
							'default' => 'uppercase',
						],
				    ],
					'selector' => '{{WRAPPER}} .tf-heading-section .before-title',
				]
			);
			$this->add_control( 
				'color_before_title',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#E3CCA1',
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .before-title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'margin_before_title',
				[
					'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .before-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);	

	        $this->add_control(
				'h_heading',
				[
					'label' => esc_html__( 'Heading', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography',
					'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
					'fields_options' => [
				        'typography' => ['default' => 'yes'],
				        'font_family' => [
				            'default' => 'Rajdhani',
				        ],
				        'font_size' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '47',
				            ],
				        ],
				        'font_weight' => [
				            'default' => '700',
				        ],
				        'line_height' => [
				            'default' => [
				                'unit' => 'em',
				                'size' => '1.277',
				            ],
				        ],
				        'text_transform' => [
							'default' => '',
						],
						'letter_spacing' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '-1',
				            ],
				        ],
				    ],
					'selector' => '{{WRAPPER}} .tf-heading-section .heading',
				]
			); 
			$this->add_control( 
				'heading_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#434E6E',
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .heading' => 'color: {{VALUE}}',					
					],
				]
			);
			$this->add_responsive_control(
				'heading_margin',
				[
					'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '7',
						'right' => '100',
						'bottom' => '28',
						'left' => '-1',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);		
			
			$this->add_control(
				'h_sub_title',
				[
					'label' => esc_html__( 'Sub Title', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography_sub_title',
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
				    ],
					'selector' => '{{WRAPPER}} .tf-heading-section .sub-title',
				]
			); 

			$this->add_control( 
				'color_sub_title',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#565872',
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .sub-title' => 'color: {{VALUE}}',					
					],
				]
			);

			$this->add_responsive_control(
				'margin_sub_title',
				[
					'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '0',
						'left' => '-2',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);			
			        
        	$this->end_controls_section();    
	    // /.End Style 
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'tf_heading_section', ['id' => "tf-heading-section-{$this->get_id()}", 'class' => ['tf-heading-section'], 'data-tabid' => $this->get_id()] );

		$animation = ! empty( $settings['hover_animation'] ) ? 'elementor-animation-' . esc_attr( $settings['hover_animation'] . ' inline-block' ) : '';

		$heading = $sub_title = $before_title = '';		

		if ($settings['heading'] != '') {
			$heading = sprintf( '<%1$s class="heading">%2$s</%1$s>',$settings['html_tag'], $settings['heading'] );
		}	

		if ($settings['before_title'] != '') {
			$before_title = sprintf( '<div class="before-title">%1$s</div>', $settings['before_title'] );
		}

		if ($settings['sub_title'] != '') {
			$sub_title = sprintf( '<div class="sub-title">%1$s</div>', $settings['sub_title'] );
		}

		if ($settings['sub_title'] != null ) {
			$content = sprintf( '
				<div class="heading-section">
					%2$s
					%1$s
					%3$s
				</div>' , $heading, $before_title, $sub_title);
		} else {
			$content = sprintf( '
			<div class="heading-section">
				%2$s
				%1$s
			</div>' , $heading, $before_title);
		}
		

		echo sprintf ( 
			'<div %1$s> 
				%2$s                
            </div>',
            $this->get_render_attribute_string('tf_heading_section'),
            $content
        );	
		
	}

}