<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="wrap-content-area">
			    <div id="primary" class="content-area">
		            <main id="main" class="post-wrap" role="main">
		            	<div class="content-woocommerce">
							<?php if ( have_posts() ) : ?>
								<div class="meta-wrap clearfix">
								<?php
									// woocommerce_before_shop_loop hook.
									do_action( 'woocommerce_before_shop_loop' );
								?>
								</div>

								<?php woocommerce_product_loop_start(); ?>
									<?php woocommerce_product_subcategories(); ?>
									<?php while ( have_posts() ) : the_post(); ?>
										<?php wc_get_template_part( 'content', 'product' ); ?>
									<?php endwhile; // end of the loop. ?>
								<?php woocommerce_product_loop_end(); ?>

								<?php
									// woocommerce_after_main_content hook.
									do_action( 'woocommerce_after_shop_loop' );
								?>
							<?php else : ?>
								<p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'janelas' ); ?></p>
							<?php endif; ?>
						</div>
		            </main><!-- #main -->
				</div><!-- #primary -->
	        	
	        	<?php 
				if ( themesflat_get_opt( 'shop_layout' ) == 'sidebar-left' || themesflat_get_opt( 'shop_layout' ) == 'sidebar-right' ) :
					get_sidebar();
				endif;
				?>
			</div>
    	</div><!-- /.col-md-12 -->
	</div><!-- /.row -->
</div><!-- /.container -->
<?php get_footer(); ?>