<?php
class TFPortfolio_Widget_Free extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tfportfolio';
    }
    
    public function get_title() {
        return esc_html__( 'TF Portfolio', 'themesflat-elementor' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
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
	                'default' => '8',
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
					'options' => ThemesFlat_Addon_For_Elementor_janelas::tf_get_taxonomies('portfolios_category'),
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
	        	'layout',
				[
					'label' => esc_html__( 'Columns', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'column-5',
					'options' => [
						'column-1' => esc_html__( '1', 'themesflat-elementor' ),
						'column-2' => esc_html__( '2', 'themesflat-elementor' ),
						'column-3' => esc_html__( '3', 'themesflat-elementor' ),
						'column-4' => esc_html__( '4', 'themesflat-elementor' ),
						'column-5' => esc_html__( '5', 'themesflat-elementor' ),
					],
				]
			);

			$this->add_control( 
	        	'layout_tablet',
				[
					'label' => esc_html__( 'Columns Tablet', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'tablet-column-1',
					'options' => [
						'tablet-column-1' => esc_html__( '1', 'themesflat-elementor' ),
					],
				]
			);

			$this->add_control( 
	        	'layout_mobile',
				[
					'label' => esc_html__( 'Columns Mobile', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'mobile-column-1',
					'options' => [
						'mobile-column-1' => esc_html__( '1', 'themesflat-elementor' ),
					],
				]
			);

			$this->add_control( 
	        	'grid_styles',
				[
					'label' => esc_html__( 'Grid Styles', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'grid-styles-1',
					'options' => [
						'grid-styles-default' => esc_html__( 'Default', 'themesflat-elementor' ),
						'grid-styles-1' => esc_html__( 'Styles 1', 'themesflat-elementor' ),
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
					'condition' => [
						'grid_styles' => 'grid-styles-default',
					],
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
						'grid_styles' => 'grid-styles-default',
						'show_filter' => 'yes',
					],			
				]
			);

			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'filter_typography',
					'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li a',
					'condition' => [
						'grid_styles' => 'grid-styles-default',
						'show_filter' => 'yes',
					],
				]
			); 

			$this->add_control( 
				'filter_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li a' => 'color: {{VALUE}}',				
					],
					'condition' => [
						'grid_styles' => 'grid-styles-default',
						'show_filter' => 'yes',
					],
				]
			);

			$this->add_control( 
				'filter_color_hover',
				[
					'label' => esc_html__( 'Color Hover & Active', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-widget-portfolio-wrap .portfolio-filter li.active a' => 'color: {{VALUE}}',				
					],
					'condition' => [
						'grid_styles' => 'grid-styles-default',
						'show_filter' => 'yes',
					],
				]
			);

			$this->end_controls_section();
        // /.End Posts Query

		// Start Style
	        $this->start_controls_section( 'section_post_excerpt',
	            [
	                'label' => esc_html__( 'Style', 'themesflat-elementor' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
					'selector' => '{{WRAPPER}} .tf-portfolio-wrap .tf-portfolio .portfolios-post .title',
				]
			); 

			$this->add_control( 
				'title_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .tf-portfolio-wrap .tf-portfolio .portfolios-post .title a' => 'color: {{VALUE}}',				
					],
				]
			);

			$this->add_control( 
				'title_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .tf-portfolio-wrap .tf-portfolio .portfolios-post .title a:hover' => 'color: {{VALUE}}',				
					],
				]
			);

			$this->add_control(
				'h_style_category',
				[
					'label' => esc_html__( 'Category', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'category_typography',
					'label' => esc_html__( 'Typography', 'themesflat-elementor' ),
					'selector' => '{{WRAPPER}} .tf-portfolio-wrap .tf-portfolio .portfolios-post .post-meta',
				]
			); 

			$this->add_control( 
				'category_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .tf-portfolio-wrap .tf-portfolio .portfolios-post .post-meta a' => 'color: {{VALUE}}',				
					],
				]
			);

			$this->add_control( 
				'category_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'themesflat-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .tf-portfolio-wrap .tf-portfolio .portfolios-post .post-meta a:hover' => 'color: {{VALUE}}',				
					],
				]
			);
			        
        	$this->end_controls_section();    
	    // /.End Style 
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();		

		$this->add_render_attribute( 'tf_portfolio_wrap', ['id' => "tf-portfolio-{$this->get_id()}", 'class' => ['tf-portfolio-wrap', 'tf-widget-portfolio-wrap', $settings['grid_styles'], $settings['layout'], $settings['layout_tablet'], $settings['layout_mobile'] ], 'data-tabid' => $this->get_id()] );

		if ( get_query_var('paged') ) {
           $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
           $paged = get_query_var('page');
        } else {
           $paged = 1;
        }
		$query_args = array(
            'post_type' => 'portfolios',
            'posts_per_page' => $settings['posts_per_page'],
            'paged'     => $paged
        );

        if (! empty( $settings['posts_categories'] )) {        	
        	$query_args['tax_query'] = array(
							        array(
							            'taxonomy' => 'portfolios_category',
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
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) : ?>
		<div <?php echo $this->get_render_attribute_string('tf_portfolio_wrap'); ?>>

			<?php  
			if ($settings['grid_styles'] == 'grid-styles-default'):
				if ($settings['show_filter'] == 'yes'):
					$filter_category_order = $settings['filter_category_order'];
					$filters = wp_list_pluck( get_terms( 'portfolios_category','hide_empty=1'), 'name','slug' );
					echo '<ul class="portfolio-filter">'; 
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
	                echo '<li class="active"><a data-filter="*" href="#">' . esc_html__( 'All', 'zev' ) . '</a></li></ul>';
	            endif;
            endif;
			?>

			<div class="tf-portfolio">
				<?php while ( $query->have_posts() ) : $query->the_post();
					$get_id_post_thumbnail = get_post_thumbnail_id();
					$featured_image = '';
					switch ( get_post_format() ) {
						case 'gallery':
							$post_image_gallery_li = '';
							$post_images_gallery = TF_Post_Format::themesflat_decode(TF_Post_Format::themesflat_meta( 'gallery_images'));
							if ( !empty( $post_images_gallery ) && is_array( $post_images_gallery ) ) {
								foreach ( $post_images_gallery as $post_image_gallery_id ) {
									$post_image_gallery_li .= sprintf( '<li><img src="%s" alt="image"></li>', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $post_image_gallery_id, 'thumbnail', $settings ) );                           
								}
								$gallery_slide_auto = ($settings['gallery_slide_auto'] == 'yes') ? 'true' : 'false' ;
								$gallery_slide_arrow = ($settings['gallery_slide_arrow'] == 'yes') ? 'true' : 'false' ;
								$featured_image = sprintf('
									<div class="featured-image-gallery" data-autoplay="%2$s" data-animation_images="%3$s" data-controlnav="false" data-directionnav="%4$s" data-prevtext="%5$s" data-nexttext="%6$s">
										<ul class="slides">
											%1$s
										</ul>
									</div>', $post_image_gallery_li, $gallery_slide_auto, $settings['gallery_slide_animation'], $gallery_slide_arrow, $settings['gallery_slide_prev_icon'], $settings['gallery_slide_next_icon']);
							} else {
								$featured_image = sprintf('<img src="'.\Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ).'" alt="image">');
							}						
						break;

						case 'video':
							$post_video_url = TF_Post_Format::themesflat_meta('video_url');
							if ( $post_video_url != '' ) {
								$featured_image = sprintf('
									<div class="themesflat_video_embed">
										<img src="%1$s" alt="image">
										<div class="video-video-box-overlay">
											<div class="video-video-box-button-sm video-box-button-lg">					
												<button class="video-video-play-icon" data-izimodal-open="#format-video">
													<i class="%3$s"></i>
												</button>
											</div>					
										</div>
									</div>
									<div class="izimodal" id="format-video" data-izimodal-width="850px" data-iziModal-fullscreen="true">
									    <iframe height="430" src="%2$s" class="tf-video-full-width full-width shadow-primary"></iframe>
									</div>',
									\Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ), esc_url($post_video_url), $settings['btn_play_icon']);	
							}else {
								$featured_image = sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));
							}		
						break;
						
						default:
							$featured_image = sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));
						break;
					}					
					?>
					<?php switch ($settings['grid_styles']):
						case 'grid-styles-1':
						?>
							<?php if ($count == 1 || $count == 2 || $count == 4 || $count == 6 || $count == 8): ?>
							<div class="column">					
							<?php endif; ?>

								<div class="entry portfolios-post">													
									<div class="featured-post">
										<?php echo sprintf('%s',$featured_image); ?>									
										<a href="<?php echo esc_url( get_permalink() ) ?>" class="overlay"></a>
									</div>							
									<div class="content">
										<ul class="post-meta">									
											<li class="post-category">
											<?php echo the_terms( get_the_ID(), 'portfolios_category', '', ', ', '' ); ?>	
											</li>									
										</ul>								
										<h3 class="title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo get_the_title(); ?></a></h3>				
									</div>						
								</div>

							<?php if ($count == 1 || $count == 3 || $count == 5 || $count == 7 || $count == 8): ?>
							</div>
							<?php endif; ?>
							<?php $count++; ?>
						<?php break; ?>

						<?php default: ?>
							<?php 
							global $post;
					        $id = $post->ID;
					        $termsArray = get_the_terms( $id, 'portfolios_category' );
					        $termsString = "";

					        if ( $termsArray ) {
					        	foreach ( $termsArray as $term ) {
					        		$itemname = strtolower( $term->slug ); 
					        		$itemname = str_replace( ' ', '-', $itemname );
					        		$termsString .= $itemname.' ';
					        	}
					        }
							?>
							<div class="column <?php echo esc_attr( $termsString ); ?>">
								<div class="entry portfolios-post">													
									<div class="featured-post">
										<?php echo sprintf('%s',$featured_image); ?>									
										<a href="<?php echo esc_url( get_permalink() ) ?>" class="overlay"></a>
									</div>							
									<div class="content">
										<ul class="post-meta">									
											<li class="post-category">
											<?php echo the_terms( get_the_ID(), 'portfolios_category', '', ', ', '' ); ?>	
											</li>									
										</ul>								
										<h3 class="title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo get_the_title(); ?></a></h3>				
									</div>						
								</div>
							</div>
						<?php break; ?>
					<?php endswitch; ?>
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