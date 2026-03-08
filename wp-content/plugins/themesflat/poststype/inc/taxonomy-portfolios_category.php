<?php
get_header();
$term_slug = $wp_query->tax_query->queries[0]['terms'][0];
$portfolios_number_post = themesflat_get_opt( 'portfolios_number_post' ) ? themesflat_get_opt( 'portfolios_number_post' ) : 9;
$columns = themesflat_get_opt('portfolio_grid_columns');
$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

$args = array(
    'post_type' => 'portfolios',
    'paged'     => $paged,
    'posts_per_page' => $portfolios_number_post,
);
$args['tax_query'] = array(
    array(
        'taxonomy' => 'portfolios_category',
        'field'    => 'slug',
        'terms'    => $term_slug
    ),
);
$query = new WP_Query($args);
?>
<div class="themesflat-portfolios-taxonomy">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrap-content-area">
                    <div id="primary" class="content-area"> 
                        <main id="main" class="main-content" role="main">
                            <div class="container-filter wrap-portfolios-post row column-<?php echo esc_attr($columns); ?>">
                                <?php 
                                if( $query->have_posts() ) {
                                    while ( $query->have_posts() ) : $query->the_post(); ?>           
                                        <div class="item <?php echo esc_attr( $termsString ); ?>">
                                            <div class="portfolios-post portfolios-post-<?php the_ID(); ?>">
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
                                                            <?php echo the_terms( get_the_ID(), 'portfolios_category', '', ' , ', '' ); ?>
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
                                } else {
                                    get_template_part( 'template-parts/content', 'none' );
                                }
                                ?>            
                            </div>
                            <?php 
                            themesflat_pagination_posttype($query, 'loadmore');
                            wp_reset_postdata();
                            ?> 
                        </main><!-- #main -->
                    </div><!-- #primary -->
                    <?php 
                    if ( themesflat_get_opt( 'portfolios_layout' ) == 'sidebar-left' || themesflat_get_opt( 'portfolios_layout' ) == 'sidebar-right' ) :
                        get_sidebar();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.themesflat-portfolios-taxonomy -->
<?php get_footer(); ?>