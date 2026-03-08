<?php
get_header();
$term_slug = $wp_query->tax_query->queries[0]['terms'][0];
$services_number_post = themesflat_get_opt( 'services_number_post' ) ? themesflat_get_opt( 'services_number_post' ) : 6;
$columns = themesflat_get_opt('services_grid_columns');
$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
$themesflat_paging_style = themesflat_get_opt('services_archive_pagination_style');
    
$args = array(
    'post_type' => 'services',
    'paged'     => $paged,
    'posts_per_page' => $services_number_post,
);
$args['tax_query'] = array(
    array(
        'taxonomy' => 'services_category',
        'field'    => 'slug',
        'terms'    => $term_slug
    ),
); 
$query = new WP_Query($args);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="wrap-content-area">
                <div id="primary" class="content-area"> 
                    <main id="main" class="main-content" role="main">                            
                        <div class="themesflat-services-taxonomy">                            
                            <div class="tf-services-wrap wrap-services-post row column-<?php echo esc_attr($columns); ?>">
                                <?php                                 
                                if( $query->have_posts() ) {
                                    while ( $query->have_posts() ) : $query->the_post(); ?>           
                                        <div class="item">
                                            <div class="services-post category-services-page services-post-<?php the_ID(); ?>">
                                                <div class="featured-post">
                                                    <a href="<?php echo get_the_permalink(); ?>">
                                                    <?php 
                                                        if ( has_post_thumbnail() ) { 
                                                            $themesflat_thumbnail = "themesflat-service-grid";                              
                                                            the_post_thumbnail( $themesflat_thumbnail );
                                                        }                                           
                                                    ?>
                                                    <span class="services-overlay"></span>
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
                                                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="tf-button bt_icon_after"><?php esc_html_e('Read More', 'themesflat') ?> <i class="janelas-icon-arrow-right"></i></a>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>                    
                                        <?php 
                                    endwhile; 
                                }
                                ?>            
                            </div>
                        </div><!-- /.themesflat-services-taxonomy -->
                        <?php 
                            themesflat_pagination_posttype($query);
                            wp_reset_postdata();
                        ?> 
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
<?php get_footer(); ?>