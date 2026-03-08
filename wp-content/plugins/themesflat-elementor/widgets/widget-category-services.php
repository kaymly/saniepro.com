<?php
class TFCategoryServices_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-category-services';
    }
    
    public function get_title() {
        return esc_html__( 'TF Category Services', 'themesflat-elementor' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

	public function get_style_depends(){
		return ['tf-category-service'];
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
		                'default' => '6',
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
					'spacing_content',
					[
						'label' => esc_html__( 'Spacing', 'themesflat-elementor' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 300,
								'step' => 1,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 15,
						],
						'selectors' => [
							'{{WRAPPER}} .wrap-services-post .item' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
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
				'condition' => [
					'style' => 'style1'
				],
			]
		);	 

		$this->add_responsive_control( 
			'padding',
			[
				'label' => esc_html__( 'Padding', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '37',
                        'right' => '20',
                        'bottom' => '37',
                        'left' => '20',
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .tf-services-wrap',
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'themesflat-elementor' ),
				'selector' => '{{WRAPPER}} .tf-services-wrap',
			]
		);    

		$this->add_responsive_control( 
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' , '%' ],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .tf-services-wrap' => 'background-color: {{VALUE}}',
				],
			]
		);  
		
		$this->end_controls_section();    
	// /.End General Style

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
					'{{WRAPPER}} .tf-services-wrap .category-services-post .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .category-services-post .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_content',
				'label' => esc_html__( 'Box Shadow', 'themesflat-elementor' ),
				'fields_options' => [
					'box_shadow_type' => [ 'default' =>'yes' ],
					'box_shadow' => [
						'default' => [
							'horizontal' => 0,
							'vertical' => 10,
							'blur' => 16,
							'spread' => 6,
							'color' => 'rgba(0, 0, 0, 0.07)'
						]
					]
				],
				'selector' => '{{WRAPPER}} .tf-services-wrap .category-services-post .content',
				'condition' => [
					'style' => 'style2'
				],
			]
		);

		$this->add_control( 
			'background_color_content',
			[
				'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .category-services-post .content' => 'background-color: {{VALUE}}',
				],
			]
		); 

		$this->end_controls_section();
	// /.End Content Style

		// Start Post Icon
		$this->start_controls_section( 
			'section_style_post_icon',
			[
				'label' => esc_html__( 'Icon', 'themesflat-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
							'{{WRAPPER}} .tf-services-wrap .category-services-post .content .post-icon i' => 'color: {{VALUE}}',
							'{{WRAPPER}} .tf-services-wrap .category-services-post .content .post-icon svg' => 'fill: {{VALUE}}',
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
						'selectors' => [
							'{{WRAPPER}} .tf-services-wrap .category-services-post .content:hover .post-icon i' => 'color: {{VALUE}}',
							'{{WRAPPER}} .tf-services-wrap .category-services-post .content:hover .post-icon svg' => 'fill: {{VALUE}}',
						],
					]
				);
				
			$this->end_controls_tab();
	
		$this->end_controls_tabs();
	
		$this->end_controls_section();    
			// /.End post icon

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
							'size' => '20',
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
				'selector' => '{{WRAPPER}} .tf-services-wrap .category-services-post .content .category',
			]
		);

		$this->add_control( 
			'title_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#434E6E',
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .category-services-post .content .category a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control( 
			'title_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .category-services-post .content .category a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control( 
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'themesflat-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
                'default' => [
                    'top' => '',
                    'right' => '',	
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                ],
				'selectors' => [
					'{{WRAPPER}} .tf-services-wrap .category-services-post .content .category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	// /.End Title Style

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

		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) : ?>
		<div <?php echo $this->get_render_attribute_string('tf_services_wrap'); ?>>
			<div class="wrap-services-post category row <?php echo esc_attr($settings['layout']); ?>">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="item">
						<?php if ($settings['style'] == 'style1') : ?>
	                        <div class="category-services-post category-services-post-<?php the_ID(); ?>">
	                            <div class="content"> 
	                                <?php 
	                                $services_post_icon  = \Elementor\Addon_Elementor_Icon_manager_janelas::render_icon( themesflat_get_opt_elementor('services_post_icon'), [ 'aria-hidden' => 'true' ] );
	                                if ($services_post_icon) {
	                                    echo '<div class="post-icon">'.$services_post_icon.'</div>';
	                                }
	                                ?>
                                    <div class="category">
									    <?php echo the_terms( get_the_ID(), 'services_category', '', ' , ', '' ); ?>
                                </div>                                
	                            </div>
	                        </div>
                    	<?php elseif ($settings['style'] == 'style2') : ?>
							<div class="category-services-post category-services-post-<?php the_ID(); ?>">
	                            <div class="content"> 
	                                <?php 
	                                $services_post_icon  = \Elementor\Addon_Elementor_Icon_manager_janelas::render_icon( themesflat_get_opt_elementor('services_post_icon'), [ 'aria-hidden' => 'true' ] );
	                                if ($services_post_icon) {
	                                    echo '<div class="post-icon">'.$services_post_icon.'</div>';
	                                }
	                                ?>
                                    <div class="category">
									    <?php echo the_terms( get_the_ID(), 'services_category', '', ' , ', '' ); ?>
                                </div>                                
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