<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="wrap-content-area">
			    <div id="primary" class="content-area">
			        <main id="main" class="post-wrap" role="main">
			        	<div class="content-woocommerce">
							<?php
								// woocommerce_before_single_product hook.
								do_action( 'woocommerce_before_single_product' );

								if ( post_password_required() ) {
								 	echo get_the_password_form();
								 	return;
								}

								$class_title_single_products = 'no-title-single-product';
								if (themesflat_get_opt('product_featured_title') != '') {
								 	$class_title_single_products = 'has-title-single-product';
								}
							?>

							<div id="product-<?php the_ID(); ?>" <?php post_class( 'woo-single-post-class '. $class_title_single_products ); ?>>
								<div class="product-wrap clearfix">
									<?php
										// woocommerce_before_single_product_summary hook.
										do_action( 'woocommerce_before_single_product_summary' );
									?>

									<div class="summary entry-summary">
										<?php
											// woocommerce_single_product_summary hook.
											do_action( 'woocommerce_single_product_summary' );
										?>
									</div><!-- .summary -->
								</div><!-- .product-wrap -->

								<?php
									// woocommerce_after_single_product_summary hook.
									do_action( 'woocommerce_after_single_product_summary' );
								?>
							</div><!-- /#product-<?php the_ID(); ?> -->

							<?php do_action( 'woocommerce_after_single_product' ); ?>
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