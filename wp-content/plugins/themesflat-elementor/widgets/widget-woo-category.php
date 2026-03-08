<?php
class TFWooCategory_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-product-categories';
    }
    
    public function get_title() {
        return esc_html__( 'TF Product Categories', 'themesflat-elementor' );
    }

    public function get_icon() {
        return 'eicon-product-categories';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-product-categories'];
	}

	protected function register_controls() {
		// Start Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Setting', 'themesflat-elementor'),
	            ]
	        );	

			$this->add_control(
                'columns',
                [
                    'label' => esc_html__( 'Columns', 'themesflat-elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '5',
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
				'number',
				[
					'label' => esc_html__( 'Categories Count', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => '5',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_filter',
				[
					'label' => esc_html__( 'Query', 'themesflat-elementor' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'source',
				[
					'label' => esc_html__( 'Source', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'' => esc_html__( 'Show All', 'themesflat-elementor' ),
						'by_id' => esc_html__( 'Manual Selection', 'themesflat-elementor' ),
						'by_parent' => esc_html__( 'By Parent', 'themesflat-elementor' ),
						'current_subcategories' => esc_html__( 'Current Subcategories', 'themesflat-elementor' ),
					],
					'label_block' => true,
				]
			);

			$categories = get_terms( 'product_cat' );

			$options = [];
			foreach ( $categories as $category ) {
				$options[ $category->term_id ] = $category->name;
			}

			$this->add_control(
				'categories',
				[
					'label' => esc_html__( 'Categories', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'options' => $options,
					'default' => [],
					'label_block' => true,
					'multiple' => true,
					'condition' => [
						'source' => 'by_id',
					],
				]
			);

			$parent_options = [ '0' => esc_html__( 'Only Top Level', 'themesflat-elementor' ) ] + $options;
			$this->add_control(
				'parent',
				[
					'label' => esc_html__( 'Parent', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '0',
					'options' => $parent_options,
					'condition' => [
						'source' => 'by_parent',
					],
				]
			);

			$this->add_control(
				'hide_empty',
				[
					'label' => esc_html__( 'Hide Empty', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'default' => '',
					'label_on' => 'Hide',
					'label_off' => 'Show',
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' => esc_html__( 'Order By', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'name',
					'options' => [
						'name' => esc_html__( 'Name', 'themesflat-elementor' ),
						'slug' => esc_html__( 'Slug', 'themesflat-elementor' ),
						'description' => esc_html__( 'Description', 'themesflat-elementor' ),
						'count' => esc_html__( 'Count', 'themesflat-elementor' ),
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
						'asc' => esc_html__( 'ASC', 'themesflat-elementor' ),
						'desc' => esc_html__( 'DESC', 'themesflat-elementor' ),
					],
				]
			);

			$this->end_controls_section();			
        // /.End Setting  

		// Start Style Setting
			$this->start_controls_section(
				'section_products_style',
				[
					'label' => esc_html__( 'Products', 'themesflat-elementor' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'column_gap',
				[
					'label'     => esc_html__( 'Columns Gap', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::SLIDER,
					'default'   => [
						'size' => 30,
					],
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tf-product-category ul.products' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'row_gap',
				[
					'label'     => esc_html__( 'Rows Gap', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::SLIDER,
					'default'   => [
						'size' => 30,
					],
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tf-product-category ul.products' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label'     => esc_html__( 'Alignment', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::CHOOSE,
					'options'   => [
						'left'   => [
							'title' => esc_html__( 'Left', 'themesflat-elementor' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'themesflat-elementor' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right'  => [
							'title' => esc_html__( 'Right', 'themesflat-elementor' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}} .tf-product-category .products li .inner' => 'text-align: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'default'	=> '#f0f4f9',
					'selectors' => [
						'{{WRAPPER}} .tf-product-category .products li .inner' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-product-category .products li .inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'padding',
				[
					'label'      => esc_html__( 'Padding', 'themesflat-elementor' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'top' => '23',
						'right' => '0',
						'bottom' => '21',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-product-category .products li .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'heading_image_style',
				[
					'label'     => esc_html__( 'Image', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name'     => 'image_border',
					'selector' => '{{WRAPPER}} .tf-product-category .category-thumbnail img',
				]
			);

			$this->add_responsive_control(
				'image_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'themesflat-elementor' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .tf-product-category .category-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'image_width',
				[
					'label'      => esc_html__( 'Max Width', 'themesflat-elementor' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 180,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-product-category .products li .category-thumbnail > a' => 'max-width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'image_spacing_top',
				[
					'label'      => esc_html__( 'Spacing Top', 'themesflat-elementor' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em' ],
					'default' => [
						'unit' => 'px',
						'size' => 8,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-product-category .category-thumbnail' => 'margin-top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'image_spacing_bottom',
				[
					'label'      => esc_html__( 'Spacing Bottom', 'themesflat-elementor' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em' ],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-product-category .category-thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'heading_overlay_image_style',
				[
					'label'     => esc_html__( 'Overlay Image', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'image_overlay_size',
				[
					'label'      => esc_html__( 'Size', 'themesflat-elementor' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 133,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-product-category .products li .category-thumbnail:before' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'image_overlay_color',
				[
					'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'default'	=> '#dce2ea',
					'selectors' => [
						'{{WRAPPER}} .tf-product-category .products li .category-thumbnail:before' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'heading_title_style',
				[
					'label'     => esc_html__( 'Title', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'default'	=> '#0d232e',
					'selectors' => [
						'{{WRAPPER}} .tf-product-category .woocommerce-loop-category__title a' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'title_color_hover',
				[
					'label'     => esc_html__( 'Color Hover', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'default'	=> '#E3CCA1',
					'selectors' => [
						'{{WRAPPER}} .tf-product-category .woocommerce-loop-category__title a:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'title_typography',
					'fields_options' => [
				        'typography' => ['default' => 'yes'],
				        'font_family' => [
				            'default' => 'Rubik',
				        ],
				        'font_size' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '17',
				            ],
				        ],
				        'font_weight' => [
				            'default' => '600',
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
				                'size' => '-0.7',
				            ],
				        ],
				    ],
					'selector' => '{{WRAPPER}} .tf-product-category .woocommerce-loop-category__title',
				]
			);

			$this->add_control(
				'heading_count_style',
				[
					'label'     => esc_html__( 'Count', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'count_color',
				[
					'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'default'	=> '#565872',
					'selectors' => [
						'{{WRAPPER}} .tf-product-category .category-total' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'count_typography',
					'fields_options' => [
				        'typography' => ['default' => 'yes'],
				        'font_family' => [
				            'default' => 'Rubik',
				        ],
				        'font_size' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '15',
				            ],
				        ],
				        'font_weight' => [
				            'default' => '400',
				        ],
				        'line_height' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '25',
				            ],
				        ],
				        'letter_spacing' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '0',
				            ],
				        ],
				    ],
					'selector' => '{{WRAPPER}} .tf-product-category .category-total',
				]
			);

			$this->add_control(
				'heading_cat_desc_style',
				[
					'label'     => esc_html__( 'Description', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'cat_desc_color',
				[
					'label'     => esc_html__( 'Color', 'themesflat-elementor' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-product-category .shop_cat_desc' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'cat_desc_typography',
					'selector' => '{{WRAPPER}} .tf-product-category .shop_cat_desc',
				]
			);
	        
			$this->end_controls_section();
		// /.End Setting 
	}

	private function get_shortcode() {
		$settings = $this->get_settings();

		$attributes = [
			'number' => $settings['number'],
			'columns' => $settings['columns'],
			'hide_empty' => ( 'yes' === $settings['hide_empty'] ) ? 1 : 0,
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
		];

		if ( 'by_id' === $settings['source'] ) {
			$attributes['ids'] = implode( ',', $settings['categories'] );
		} elseif ( 'by_parent' === $settings['source'] ) {
			$attributes['parent'] = $settings['parent'];
		} elseif ( 'current_subcategories' === $settings['source'] ) {
			$attributes['parent'] = get_queried_object_id();
		}

		$this->add_render_attribute( 'shortcode', $attributes );

		$shortcode = sprintf( '[themesflat_category_products %s]', $this->get_render_attribute_string( 'shortcode' ) );

		return $shortcode;
	}

	protected function render($instance = []) {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'tf_product_category', ['id' => "tf-product-category-{$this->get_id()}", 'class' => ['tf-product-category'], 'data-tabid' => $this->get_id() ] );

		$product_categories_html = do_shortcode( $this->get_shortcode() );
		if ( $product_categories_html ) {
			$product_categories_html = str_replace( '<ul class="products', '<ul class="products columns-'.$settings['columns'], $product_categories_html );

			echo sprintf ( 
				'<div %1$s> 
					%2$s                
	            </div>',
	            $this->get_render_attribute_string('tf_product_category'),
	            $product_categories_html
	        );
		}				
	}

}