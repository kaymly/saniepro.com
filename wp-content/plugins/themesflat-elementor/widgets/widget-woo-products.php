<?php
class TFWooProducts_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-woo-products';
    }
    
    public function get_title() {
        return esc_html__( 'TF Products', 'themesflat-elementor' );
    }

    public function get_icon() {
        return 'eicon-products';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-font-awesome','owl-carousel','tf-product'];
	}

	public function get_script_depends() {
		return ['owl-carousel','tf-product'];
	}

	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Setting', 'themesflat-elementor'),
	            ]
	        );	

	        $this->add_control( 
				'product_categories',
				[
					'label' => esc_html__( 'Categories', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'options' => ThemesFlat_Addon_For_Elementor_janelas::tf_get_taxonomies_product(),
					'label_block' => true,
	                'multiple' => true
				]
			);

	        $this->add_control( 
				'product_per_page',
	            [
	                'label' => esc_html__( 'Number Show Products', 'themesflat-elementor' ),
	                'type' => \Elementor\Controls_Manager::NUMBER,
	                'default' => '8',
	            ]
	        );	

	        $this->add_control(
                'filter_by',
                [
                    'label' => esc_html__( 'Filter By', 'themesflat-elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'recent',
                    'options' => [
                        'recent' => esc_html__( 'Recent Products', 'themesflat-elementor' ),
                        'featured' => esc_html__( 'Featured Products', 'themesflat-elementor' ),
                        'best_selling' => esc_html__( 'Best Selling Products', 'themesflat-elementor' ),
                        'sale' => esc_html__( 'Sale Products', 'themesflat-elementor' ),
                        'top_rated' => esc_html__( 'Top Rated Products', 'themesflat-elementor' ),
                        'mixed_order' => esc_html__( 'Mixed order Products', 'themesflat-elementor' ),
                    ],
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label' => esc_html__( 'Orderby', 'themesflat-elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'date',
                    'options' => [
                        'ID'            => esc_html__('ID','themesflat-elementor'),
                        'date'          => esc_html__('Date','themesflat-elementor'),
                        'name'          => esc_html__('Name','themesflat-elementor'),
                        'title'         => esc_html__('Title','themesflat-elementor'),
                        'comment_count' => esc_html__('Comment count','themesflat-elementor'),
                        'rand'          => esc_html__('Random','themesflat-elementor'),
                    ]
                ]
            );

            $this->add_control(
                'order',
                [
                    'label' => esc_html__( 'Order', 'themesflat-elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC'  => esc_html__('Descending','themesflat-elementor'),
                        'ASC'   => esc_html__('Ascending','themesflat-elementor'),
                    ]
                ]
            );

			$this->add_control(
                'product_columns',
                [
                    'label' => esc_html__( 'Columns', 'themesflat-elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'columns-4',
                    'options' => [
                    	'columns-1' => esc_html__( '1', 'themesflat-elementor' ),
                        'columns-2' => esc_html__( '2', 'themesflat-elementor' ),
                        'columns-3' => esc_html__( '3', 'themesflat-elementor' ),
                        'columns-4' => esc_html__( '4', 'themesflat-elementor' ),
                        'columns-5' => esc_html__( '5', 'themesflat-elementor' ),
                    ]
                ]
            );  

            $this->add_control( 
	        	'product_style',
				[
					'label' => esc_html__( 'Style', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'product-style1',
					'options' => [
						'product-style1' => esc_html__( 'Style 1', 'themesflat-elementor' ),
						'product-style2' => esc_html__( 'Style 2', 'themesflat-elementor' ),
					]
				]
			);
	        
			$this->end_controls_section();
        // /.End List Setting 

        // Start Carousel        
			$this->start_controls_section( 
				'section_carousel',
	            [
	                'label' => esc_html__('Carousel', 'themesflat-elementor'),
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
					'default' => 'no',				
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
					'default' => 'no',
					'condition' => [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control(
				'carousel_spacer',
				[
					'label' => esc_html__( 'Spacer', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 0,
					'max' => 100,
					'step' => 1,
					'default' => 30,	
					'condition' => [
						'product_style' => 'product-style1',
					],			
				]
			);

			$this->add_control( 
	        	'carousel_row',
				[
					'label' => esc_html__( 'Row', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '1',
					'options' => [
						'1' => esc_html__( '1', 'themesflat-elementor' ),
						'2' => esc_html__( '2', 'themesflat-elementor' ),
					],
					'condition' => [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control( 
	        	'carousel_column_desk',
				[
					'label' => esc_html__( 'Columns Desktop', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '4',
					'options' => [						
						'2' => esc_html__( '2', 'themesflat-elementor' ),
						'3' => esc_html__( '3', 'themesflat-elementor' ),
						'4' => esc_html__( '4', 'themesflat-elementor' ),
						'5' => esc_html__( '5', 'themesflat-elementor' ),
					],
					'condition' => [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control( 
	        	'carousel_column_tablet',
				[
					'label' => esc_html__( 'Columns Tablet', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '2',
					'options' => [
						'1' => esc_html__( '1', 'themesflat-elementor' ),
						'2' => esc_html__( '2', 'themesflat-elementor' ),
						'3' => esc_html__( '3', 'themesflat-elementor' ),
					],
					'condition' => [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control( 
	        	'carousel_column_mobile',
				[
					'label' => esc_html__( 'Columns Mobile', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '1',
					'options' => [
						'1' => esc_html__( '1', 'themesflat-elementor' ),
						'2' => esc_html__( '2', 'themesflat-elementor' ),
					],
					'condition' => [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control(
				'h_arrows_carousel',
				[
					'label' => esc_html__( 'Arrows Carousel', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_responsive_control( 
				'carousel_arrow_border_radius',
	            [
	                'label' => esc_html__( 'Border Radius', 'themesflat-elementor' ),
	                'type' => \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', '%', 'em' ],
		            'default' => [
						'top' => "5",
						'right' => "5",
						'bottom' => "5",
						'left' => "5",
						'unit' => 'px',
						'isLinked' => true,
					],
	                'selectors' => [
	                    '{{WRAPPER}} .tf-products .owl-nav .owl-prev, {{WRAPPER}} .tf-products .owl-nav .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                    'carousel' => 'yes',
	                ]
	            ]
	        );

	        $this->start_controls_tabs( 
				'carousel_arrow_tabs',
				[
					'condition' => [
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
		                'default' => '#60627b',
		                'selectors' => [
							'{{WRAPPER}} .tf-products .owl-nav .owl-prev, {{WRAPPER}} .tf-products .owl-nav .owl-next' => 'color: {{VALUE}}',
						],
						'condition' => [
		                    'carousel' => 'yes',
		                ]
		            ]
		        );

		        $this->add_control( 
		        	'carousel_arrow_bg_color',
		            [
		                'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
		                'type' => \Elementor\Controls_Manager::COLOR,
		                'default' => '#f0f4f9',
		                'selectors' => [
							'{{WRAPPER}} .tf-products .owl-nav .owl-prev, {{WRAPPER}} .tf-products .owl-nav .owl-next' => 'background-color: {{VALUE}};',
						],
						'condition' => [
		                    'carousel' => 'yes',
		                ]
		            ]
		        );	

		        $this->add_group_control( 
		        	\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'carousel_arrow_border',
						'label' => esc_html__( 'Border', 'themesflat-elementor' ),
						'selector' => '{{WRAPPER}} .tf-products .owl-nav .owl-prev, {{WRAPPER}} .tf-products .owl-nav .owl-next',
						'condition' => [
		                    'carousel' => 'yes',
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
		                'default' => '#ffffff',
		                'selectors' => [
							'{{WRAPPER}} .tf-products .owl-nav .owl-prev:hover, {{WRAPPER}} .tf-products .owl-nav .owl-next:hover' => 'color: {{VALUE}}',
							'{{WRAPPER}} .tf-products .owl-nav .owl-prev.disabled, {{WRAPPER}} .tf-products .owl-nav .owl-next.disabled' => 'color: {{VALUE}}',
						],
						'condition' => [
		                    'carousel' => 'yes',
		                ]
		            ]
		        );

		        $this->add_control( 
		        	'carousel_arrow_hover_bg_color',
		            [
		                'label' => esc_html__( 'Background Color', 'themesflat-elementor' ),
		                'type' => \Elementor\Controls_Manager::COLOR,
		                'default' => '#E3CCA1',
		                'selectors' => [
							'{{WRAPPER}} .tf-products .owl-nav .owl-prev:hover, {{WRAPPER}} .tf-products .owl-nav .owl-next:hover' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} .tf-products .owl-nav .owl-prev.disabled, {{WRAPPER}} .tf-products .owl-nav .owl-next.disabled' => 'background-color: {{VALUE}};',
						],
						'condition' => [
		                    'carousel' => 'yes',
		                ]
		            ]
		        );

		        $this->add_group_control( 
		        	\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'carousel_arrow_border_hover',
						'label' => esc_html__( 'Border', 'themesflat-elementor' ),
						'selector' => '{{WRAPPER}} .tf-products .owl-nav .owl-prev:hover, {{WRAPPER}} .tf-products .owl-nav .owl-next:hover, {{WRAPPER}} .tf-products .owl-nav .owl-prev.disabled, {{WRAPPER}} .tf-products .owl-nav .owl-next.disabled',
						'condition' => [
		                    'carousel' => 'yes',
		                ]
					]
				);

	       		$this->end_controls_tab();

	        $this->end_controls_tabs();

	    	$this->end_controls_section();
        // /.End Carousel  
	}

	public function themesflat_change_sale_text($text) {
		$settings = $this->get_settings_for_display();		
		global $product; 
		$stock = $product->get_stock_status();
		$product_type = $product->get_type();
		$sale_price  = 0;
		$regular_price = 0;
		if($product_type == 'variable'){
			$product_variations = $product->get_available_variations();
			foreach ($product_variations as $kay => $value){
				if($value['display_price'] < $value['display_regular_price']){
					$sale_price = $value['display_price'];
					$regular_price = $value['display_regular_price'];
				}
			}
			if($regular_price > $sale_price && $stock != 'outofstock') {
				$product_sale = intval(((floatval($regular_price) - floatval($sale_price)) / floatval($regular_price)) * 100);
				if ($settings['product_style'] == 'product-style2') {
					return '<span class="onsale">- ' . $product_sale . '%</span>';
				}
				if($settings['product_style'] == 'product-style1') {
				   return '<span class="onsale">'.esc_html__('Sale!', 'themesflat-elementor').'</span>';
				}
			}else{
				return  '';
			}
		}else{		
			$regular_price = get_post_meta( get_the_ID(), '_regular_price', true);
			$sale_price = get_post_meta( get_the_ID(), '_sale_price', true);
			$product_sale = intval(((floatval($regular_price) - floatval($sale_price)) / floatval($regular_price)) * 100);
			if($settings['product_style'] == 'product-style2') {			
				return '<span class="onsale">- ' . $product_sale . '%</span>';
			}
			if($settings['product_style'] == 'product-style1') {
				return '<span class="onsale">'.esc_html__('Sale!', 'themesflat-elementor').'</span>';
			}		
		}
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();
		add_filter( 'woocommerce_sale_flash', [$this, 'themesflat_change_sale_text'] );

		$has_carousel = 'no-carousel';
		$carousel = '';
		if ( $settings['carousel'] == 'yes' ) {
			$has_carousel = 'has-carousel '. 'carousel-row-'.$settings['carousel_row'] ;
			$carousel = 'owl-carousel';			
		}

		$carousel_spacer = $settings['carousel_spacer'];
		if ($settings['product_style'] == 'product-style2') {
			$carousel_spacer = 0;
		}

		$this->add_render_attribute( 'tf_products', ['id' => "tf-products-{$this->get_id()}", 'class' => ['tf-products', $has_carousel], 'data-tabid' => $this->get_id(), 'data-loop' => $settings['carousel_loop'], 'data-auto' => $settings['carousel_auto'], 'data-column' => $settings['carousel_column_desk'], 'data-column2' => $settings['carousel_column_tablet'], 'data-column3' => $settings['carousel_column_mobile'], 'data-spacer' => $carousel_spacer, 'data-arrow'=>"yes", 'data-prev_icon' => "janelas-icon-long-arrow-left1", 'data-next_icon'=> "janelas-icon-long-arrow-right", 'data-row'=> $settings['carousel_row'] ] );

		if ( get_query_var('paged') ) {
           $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
           $paged = get_query_var('page');
        } else {
           $paged = 1;
        }

		$args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'paged' => $paged,
            'posts_per_page'        => $settings['product_per_page']            
        );

		$product_categories = $settings['product_categories'];
        $product_cats = str_replace(' ', '', $product_categories);

        if ( "0" != $product_categories) {
            if( is_array($product_cats) && count($product_cats) > 0 ){
                $field_name = is_numeric($product_cats[0])?'term_id':'slug';
                $args['tax_query'][] = array(
                    array(
                        'taxonomy' => 'product_cat',
                        'terms' => $product_cats,
                        'field' => $field_name,
                        'include_children' => false
                    )
                );
            }
        }

		switch( $settings['filter_by'] ){
            case 'sale':
                $args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
            break;

            case 'featured':
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
            break;

            case 'best_selling':
                $args['meta_key']   = 'total_sales';
                $args['orderby']    = 'meta_value_num';
                $args['order']      = 'desc';
            break;

            case 'top_rated': 
                $args['meta_key']   = '_wc_average_rating';
                $args['orderby']    = 'meta_value_num';
                $args['order']      = 'desc';          
            break;

            case 'mixed_order':
                $args['orderby']    = 'rand';
            break;

            default: 
            	/* Recent */
                $args['orderby']    = 'date';
                $args['order']      = 'desc';
            break;
        }	

        $class = $settings['product_style'].' '.' ';

		$query_products = new WP_Query( $args );

		$count = 0;	
		$group_nr = 1;                  // first group number
		$last_row = $query_products->post_count -1;    // last row
		$wrapper  = 2;

		if( $query_products->have_posts() ):
        ?>
        <div <?php echo $this->get_render_attribute_string('tf_products') ?>>
	        <ul class="products <?php echo esc_attr($settings['product_columns']); ?> <?php echo esc_attr($carousel); ?>">
	        	<?php while( $query_products->have_posts() ): $query_products->the_post(); ?>

	        	<?php if ($settings['carousel_row'] == '2') { if ($count % $wrapper == 0) {print '<div class="group group-'.$group_nr.'">'; $i = 0; $group_nr++; } } ?>

	        	<li <?php post_class($settings['product_style']); ?> data-slide-index="<?php echo esc_attr($count); ?>">
					<div class="inner">
						<?php
						/**
						 * woocommerce_before_shop_loop_item hook.
						 *
						 * @hooked woocommerce_template_loop_product_link_open - 10
						 */
						do_action( 'woocommerce_before_shop_loop_item' );

						/**
						 * woocommerce_before_shop_loop_item_title hook.
						 *
						 * @hooked woocommerce_show_product_loop_sale_flash - 10
						 * @hooked woocommerce_template_loop_product_thumbnail - 10
						 */

						do_action( 'woocommerce_before_shop_loop_item_title' );

						/**
						 * woocommerce_shop_loop_item_title hook.
						 *
						 * @hooked woocommerce_template_loop_product_title - 10
						 */
						
						do_action( 'woocommerce_shop_loop_item_title' );


						/**
						 * woocommerce_after_shop_loop_item_title hook.
						 *
						 * @hooked woocommerce_template_loop_rating - 5
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );

						/**
						 * woocommerce_after_shop_loop_item hook.
						 *
						 * @hooked woocommerce_template_loop_product_link_close - 5
						 * @hooked woocommerce_template_loop_add_to_cart - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item' );
						?>
					</div>
				</li>
				
				<?php 
				if ($settings['carousel_row'] == '2') { $i++; if ($i == $wrapper || $count == $last_row) print '</div>'; } ?>

				<?php $count ++; endwhile; wp_reset_postdata(); ?>
	        </ul>
	    </div>
        <?php 
        else:
			echo '<div class="no-found">';
	        	esc_html_e('No product found', 'themesflat-elementor');
	        echo '</div>';
		endif;
		
	}

}