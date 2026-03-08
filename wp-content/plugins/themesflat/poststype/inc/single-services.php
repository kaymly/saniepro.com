<?php
get_header(); 
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="wrap-content-area">
				<div id="primary" class="content-area">	
					<main id="main" class="main-content" role="main">
						<div class="entry-content">	
							<?php while ( have_posts() ) : the_post(); ?>	
								<div class="featured-post"><?php the_post_thumbnail('themesflat-service-single'); ?></div>

								<?php if ( themesflat_get_opt('services_featured_title') != '' ): ?>
								<h1 class="post-title"><?php the_title(); ?></h1>
								<?php endif; ?>
								
								<?php the_content(); ?>
							<?php endwhile; // end of the loop. ?>
						</div><!-- ./entry-content -->
					</main><!-- #main -->
				</div><!-- #primary -->
				<?php 
				if ( themesflat_get_opt( 'services_layout' ) == 'sidebar-left' || themesflat_get_opt( 'services_layout' ) == 'sidebar-right' ) :
					get_sidebar();
				endif;
				?>
			</div>
		</div>
	</div>
</div>

<?php if ( themesflat_get_opt( 'services_show_post_navigator' ) == 1 ): ?>
<!-- Navigation  -->
<div class="container">
	<div class="row">
		<div class="col-lg-12"><?php themesflat_post_navigation(); ?></div>
	</div>			
</div>	
<?php endif; ?>

<!-- Related -->
<?php if ( themesflat_get_opt( 'services_show_related' ) == 1 ) { ?>
	<div class="container">
	<?php		
		$grid_columns = themesflat_get_opt( 'services_related_grid_columns' );
		$layout =  'services-grid';

		if ( get_query_var('paged') ) {
		    $paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
		    $paged = get_query_var('page');
		} else {
		    $paged = 1;
		}

		$terms = get_the_terms( $post->ID, 'services_category' );
		if ( $terms != '' ) :
			$term_ids = wp_list_pluck( $terms, 'term_id' );
			$args = array(
				'post_type' => 'services',
				'posts_per_page'      => -1,
				'tax_query' => array(
					array(
					'taxonomy' => 'services_category',
					'field' => 'term_id',
					'terms' => $term_ids,
					'operator'=> 'IN'
					)),
				'posts_per_page'      => themesflat_get_opt( 'number_related_post_services' ),
				'ignore_sticky_posts' => 1,
				'post__not_in'=> array( $post->ID )
			);

			if ( $layout != '' ) {
			    $class[] = $layout;
			}
			if ( $grid_columns != '' ) {
			    $class[] = 'column-' . $grid_columns ;
			}
			
			$query = new WP_Query($args);
            if( $query->have_posts() ) :
			?>
			<div class="related-post related-posts-box">
			    <div class="box-wrapper">
			        <h3 class="box-title"><?php esc_html_e( 'Related Services', 'themesflat' ) ?></h3>
			        <div class="themesflat-services-taxonomy">			            
		            	<div class="<?php echo esc_attr( implode( ' ', $class ) ) ?> wrap-services-post row">
				            <?php
			                while ( $query->have_posts() ) : $query->the_post(); ?>           
			                    <div class="item">
			                        <div class="services-post services-post-<?php the_ID(); ?>">
                                        <div class="featured-post">
                                            <a href="<?php echo get_the_permalink(); ?>">
                                            <?php 
                                                if ( has_post_thumbnail() ) { 
                                                    $themesflat_thumbnail = "themesflat-service-grid";                              
                                                    the_post_thumbnail( $themesflat_thumbnail );
                                                }                                           
                                            ?>
                                            </a>
                                        </div>
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
                                            <div class="desc"><?php echo wp_trim_words( get_the_content(), 10, '' ); ?></div>                                                
                                            <div class="tf-button-container">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" class="tf-button bt_icon_after"><?php esc_html_e('Read More', 'themesflat') ?> <i class="fas fa-arrow-right"></i></a>
                                            </div>
                                           
                                        </div>
                                    </div>
			                    </div>                    
			                    <?php 
			                endwhile; 
				            ?>            
				        </div>			            
			        </div>
			    </div>
			</div>
			<?php 
			endif; 
			wp_reset_postdata(); 
		endif; ?>
	</div>	
<?php } ?>

<?php get_footer(); ?>