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
								<div class="featured-post"><?php the_post_thumbnail('themesflat-project-single'); ?>
									<div class="meta-post">
										<div class="inner-meta-post">
											<div class="meta-post-item meta-post-infor">
												<h4 class="meta-post-title"><?php esc_html_e('Project Infor','themesflat') ?></h4>
												<div class="meta-post-content"><?php the_field('project_infor', get_the_ID()); ?></div>
											</div>

											<div class="meta-post-item meta-post-category">
												<h4 class="meta-post-title"><?php esc_html_e('Category','themesflat') ?></h4>
												<div class="meta-post-content"><?php echo esc_attr ( the_terms( get_the_ID(), 'project_category', '', ', ', '' ) ); ?></div>
											</div>

											<div class="meta-post-item meta-post-date">
												<h4 class="meta-post-title"><?php esc_html_e('Date','themesflat') ?></h4>
												<div class="meta-post-content"><?php echo esc_attr( the_date() ); ?></div>
											</div>
										</div>
									</div>
								</div> 
								
								<?php if ( themesflat_get_opt('project_featured_title') != '' ): ?>
								<h1 class="post-title"><?php the_title(); ?></h1>
								<?php endif; ?>

								<?php the_content();?>
							<?php endwhile; // end of the loop. ?>
						</div><!-- ./entry-content -->
						<div class="entry-footer">
							<?php 
							if( themesflat_get_opt('show_entry_footer_content') == 1 ) :
								$terms = wp_get_post_terms( get_the_ID(), 'project_tag' );
								foreach ( $terms as $term ) {
									$term_name = $term->name;
									$term_url = get_term_link( $term );
									$terms_list[] = '<a href="' . esc_attr( $term_url ) . '" rel="tag">' . esc_html( $term_name ) . '</a>';									
								}
								$terms_list = implode( '', $terms_list );
								echo sprintf('<div class="tags-links">%1$s</div>', $terms_list);
								themesflat_social_single();
							endif;
							?>
						</div>
					</main><!-- #main -->
				</div><!-- #primary -->
				<?php 
				if ( themesflat_get_opt( 'project_layout' ) == 'sidebar-left' || themesflat_get_opt( 'project_layout' ) == 'sidebar-right' ) :
					get_sidebar();
				endif;
				?>
			</div>
		</div>
	</div>
</div>

<?php if ( themesflat_get_opt( 'project_show_post_navigator' ) == 1 ): ?>
<!-- Navigation  -->
<div class="container">
	<div class="row">
		<div class="col-lg-12"><?php themesflat_post_navigation(); ?></div>
	</div>			
</div>	
<?php endif; ?>

<!-- Related -->
<?php if ( themesflat_get_opt( 'project_show_related' ) == 1 ) { ?>
	<div class="container">
	<?php		
		$grid_columns = themesflat_get_opt( 'project_related_grid_columns' );
		$carousel_desktop = themesflat_get_opt( 'project_related_carousel_columns' );
		$carousel_tablet = themesflat_get_opt( 'project_related_carousel_columns_tablet' );
		$carousel_mobile = themesflat_get_opt( 'project_related_carousel_columns_mobile' );
		$layout =  'project-grid';

		if ( get_query_var('paged') ) {
		    $paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
		    $paged = get_query_var('page');
		} else {
		    $paged = 1;
		}

		$terms = get_the_terms( $post->ID, 'project_category' );
		if ( $terms != '' ){
			$term_ids = wp_list_pluck( $terms, 'term_id' );
			$args = array(
				'post_type' => 'project',
				'posts_per_page'      => -1,
				'tax_query' => array(
					array(
					'taxonomy' => 'project_category',
					'field' => 'term_id',
					'terms' => $term_ids,
					'operator'=> 'IN'
					)),
				'posts_per_page'      => themesflat_get_opt( 'number_related_post_project' ),
				'ignore_sticky_posts' => 1,
				'post__not_in'=> array( $post->ID )
			);

			if ( $layout != '') {
			    $class[] = $layout;
			}
			if ( $grid_columns != '' && themesflat_get_opt( 'project_related_carousel' ) == 0 ) {
			    $class[] = 'column-' . $grid_columns ;
			}
			
			?>
			<div class="related-post related-posts-box">
			    <div class="box-wrapper">
			        <h3 class="box-title"><?php esc_html_e( 'Related Projects', 'themesflat' ) ?></h3>
			        <div class="themesflat-project-taxonomy">			            
		            	<div class="<?php echo esc_attr( implode( ' ', $class ) ) ?> wrap-project-post row">
				            
				            <?php $query = new WP_Query($args); ?>
							<?php if ( themesflat_get_opt( 'project_related_carousel' ) == 1 ): ?>
								<div class="related-post has-carousel" data-column="<?php echo esc_attr($carousel_desktop); ?>" data-column2="<?php echo esc_attr($carousel_tablet); ?>" data-column3="<?php echo esc_attr($carousel_mobile); ?>">
								<div class="owl-carousel">
							<?php endif; ?>
							<?php
				            if( $query->have_posts() ) {
				                while ( $query->have_posts() ) : $query->the_post(); ?>           
				                    <div class="item">
				                        <div class="project-post project-post-<?php the_ID(); ?>">
				                            <div class="featured-post">
				                            	<a href="<?php echo get_the_permalink(); ?>">
				                                <?php 
				                                    if ( has_post_thumbnail() ) { 
				                                        $themesflat_thumbnail = "themesflat-project-grid";                              
				                                        the_post_thumbnail( $themesflat_thumbnail );
				                                    }                                           
				                                ?>
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
				                    <?php 
				                endwhile; 
								
				            }
							?>
							<?php if ( themesflat_get_opt( 'project_related_carousel' ) == 1 ): ?>
								</div>
								</div>
							<?php endif; ?>
							<?php
				            wp_reset_postdata();
				            ?>
				        </div>			            
			        </div>
			    </div>
			</div>
		<?php } ?>
	</div>	
<?php } ?>

<?php get_footer(); ?>