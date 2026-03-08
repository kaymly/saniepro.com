<?php
/**
 * Woocommerce
 *
 * @package janelas
 * @version 5.6.0
 */

// Disable WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove breadcrumb (we're using the WooFramework default breadcrumb)
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Removes the "shop" title on the main shop page
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Remove Heading Text Tab
add_filter( 'woocommerce_product_description_heading', '__return_false' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

// Change gravatar size
add_filter( 'woocommerce_review_gravatar_size', 'themesflat_woocommerce_gravatar_size', 10 );
function themesflat_woocommerce_gravatar_size() { return 100; }

// Adjust markup on all WooCommerce pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Fix html on item product 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

add_action( 'woocommerce_before_shop_loop_item', 'themesflat_before_shop_loop_item' );
add_action( 'themesflat_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'themesflat_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
add_filter('yith_add_quick_view_button_html', '__return_false');

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', -5 );


/* Archive Product 
--------------------------------------------------------------------------*/
// Relayout shop item
function themesflat_before_shop_loop_item() {
	global $product;
	echo '<div class="product-thumbnail">';
	echo '<a class="woocommerce_loop_product_link" href="' . get_the_permalink($product->get_id()) . '">'; 
	do_action( 'themesflat_before_shop_loop_item' );
	echo '</a>';
	echo '</div><div class="product-info">';
	echo themesflat_product_action_btn();
	echo '<a class="woocommerce_loop_product_link" href="' . get_the_permalink($product->get_id()) . '">';
}
add_action( 'woocommerce_after_shop_loop_item', function() {
	echo '</a></div>';
}, 99 );

function themesflat_product_action_btn() {
    ob_start();
    global $product;
    ?>
    <div class="wrap-btn-action">
    	<?php if ( ! $product->managing_stock() && ! $product->is_in_stock() ) { ?>
					
		<?php } else { ?>
    	<div class="tf-btn-add-to-cart">
	        <span class="add_to_cart button" data-product_id="<?php the_ID(); ?>"><i class="fas fa-cart-plus"></i></span>
	    </div>
	    <?php } ?>

        <?php if (class_exists('YITH_WCWL')): ?>            
            <?php echo do_shortcode('[yith_wcwl_add_to_wishlist link_classes="add_to_wishlist" label="" product_added_text="" browse_wishlist_text="" already_in_wishslist_text="" icon="fa-heart"]'); ?>
        <?php endif; ?>


        <?php if (function_exists('yith_wcqv_init')): ?>
            <div class="tf-btn-quickview">
                <span class="tf-call-quickview button" data-product_id="<?php the_ID(); ?>"><i class="fas fa-eye"></i></span>
            </div>
        <?php endif; ?>

    </div>

    <?php
    $output = ob_get_clean();
    return $output;
}

// Product Custom Sale Flash
add_filter( 'woocommerce_sale_flash', 'themesflat_replace_sale_text' ); 
function themesflat_replace_sale_text($text) {
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
			if (themesflat_get_opt('product_style') == 'product-style2') {
				return '<span class="onsale">- ' . $product_sale . '%</span>';
			}
			if(themesflat_get_opt('product_style') == 'product-style1') {
			   return '<span class="onsale">'.esc_html__('Sale!', 'janelas').'</span>';
			}
		}else{
			return  '';
		}
	}
	// else{		
	// 	$regular_price = get_post_meta( get_the_ID(), '_regular_price', true);
	// 	$sale_price = get_post_meta( get_the_ID(), '_sale_price', true);
	// 	$product_sale = intval(((floatval($regular_price) - floatval($sale_price)) / floatval($regular_price)) * 100);
	// 	if(themesflat_get_opt('product_style') == 'product-style2') {			
	// 		return '<span class="onsale">- ' . $product_sale . '%</span>';
	// 	}
	// 	if(themesflat_get_opt('product_style') == 'product-style1') {
	// 		return '<span class="onsale">'.esc_html__('Sale!', 'janelas').'</span>';
	// 	}		
	// }
}

add_action( 'woocommerce_before_shop_loop_item_title', 'themesflat_product_categories', 5 );
function themesflat_product_categories() {
 	global $post;
	$terms = get_the_terms( $post->ID, 'product_cat' );
	foreach ( $terms as $term ) {
	    $product_cat_id = $term->term_id;
	    if( $term = get_term_by( 'id', $product_cat_id, 'product_cat' ) ){echo '<div class="product-cat">'.$term->name.'</div>';}
	    break;
	}
}

// Display products per page
add_filter( 'loop_shop_per_page', 'themesflat_products_per_page', 20 );
function themesflat_products_per_page() {
	if ( ! $items = themesflat_get_opt('shop_products_per_page') ) {
		return 9;
	} else {
		return $items;
	}
}

// Change columns in product loop
add_filter( 'loop_shop_columns', 'themesflat_shop_loop_columns', 20 );
function themesflat_shop_loop_columns() {
	if ( ! $cols = themesflat_get_opt('shop_columns') ) {
		return 3;
	} else {
		if ( $cols == '1' ) return 1;
		if ( $cols == '2' ) return 2;
		if ( $cols == '3' ) return 3;
		if ( $cols == '4' ) return 4;
		if ( $cols == '5' ) return 5;
	}
}
 
/* Single Product 
--------------------------------------------------------------------------*/
remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );
remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );
remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 50 );

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Change columns in related products output to 4
add_filter( 'woocommerce_output_related_products_args', 'themesflat_related_products' );
function themesflat_related_products() {
	$args = array(
		'posts_per_page' => themesflat_get_opt('related_products_columns'),
		'columns'        => themesflat_get_opt('related_products_columns'),
	);
	return $args;
}

// Custom product thumbnails columns
add_filter('woocommerce_product_thumbnails_columns','themesflat_custom_storefront_gallery' );
function themesflat_custom_storefront_gallery( $column ) {
	$column  = 4;
	return $column ;
}

/* Mini Cart
--------------------------------------------------------------------------*/
// Update the number on cart icon
add_filter( 'woocommerce_add_to_cart_fragments', 'themesflat_woocommerce_cart_link_fragment' );
if ( ! function_exists( 'themesflat_woocommerce_cart_link_fragment' ) ) {
	// Ensure cart contents update when products are added to the cart via AJAX
	function themesflat_woocommerce_cart_link_fragment( $fragments ) {
		global $woocommerce;
		ob_start(); ?>

		<a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'janelas' ); ?>">
			<?php
			echo themesflat_svg( 'cart' );
			$item_count = sprintf(
				_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'janelas' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="shopping-cart-items-count"><?php echo esc_html( $item_count ); ?></span>
		</a>		

		<?php $fragments['a.nav-cart-trigger'] = ob_get_clean();

		return $fragments;
	}
}

// Output the script placeholder for cart updater
add_action( 'wp_footer', 'themesflat_cart_fragments_placeholder', 100 );
function themesflat_cart_fragments_placeholder() {
	echo '<script id="shopping-cart-items-updater" type="text/javascript"></script>';
}

/* Wish List
--------------------------------------------------------------------------*/
if( class_exists( 'YITH_WCWL' ) && ! function_exists( 'themesflat_yith_wcwl_disable_title' ) ){
	function themesflat_yith_wcwl_disable_title( $params ) {
		$params['page_title'] = '';

		return $params;
	}
	add_filter( 'yith_wcwl_wishlist_params', 'themesflat_yith_wcwl_disable_title' );
}

if ( class_exists( 'YITH_WCWL' ) && ! function_exists( 'tf_yith_wcwl_ajax_update_count' ) ) {
  function tf_yith_wcwl_ajax_update_count() {
    wp_send_json( array(
      'count' => yith_wcwl_count_all_products()
    ) );
  }
  add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'tf_yith_wcwl_ajax_update_count' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'tf_yith_wcwl_ajax_update_count' );
}

if ( class_exists( 'YITH_WCWL' ) && ! function_exists( 'themesflat_yith_wcwl_enqueue_custom_script' ) ) {
    function themesflat_yith_wcwl_enqueue_custom_script() {
        wp_add_inline_script(
            'jquery-yith-wcwl',
            "jQuery( function( $ ) {
                    $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
                        $.get( yith_wcwl_l10n.ajax_url, {
                            action: 'yith_wcwl_update_wishlist_count'
                        }, function( data ) {
                            $('.wishlist-items-count').html( data.count );
                        } );
                    } );
            } );"
        );
    }
    add_action( 'wp_enqueue_scripts', 'themesflat_yith_wcwl_enqueue_custom_script', 20 );
}

/* Quick View
--------------------------------------------------------------------------*/
add_action( 'template_redirect', 'yith_wcqv_remove_from_wishlist' );
function yith_wcqv_remove_from_wishlist(){
	if( function_exists( 'YITH_WCQV_Frontend' ) && defined('YITH_WCQV_FREE_INIT') ) {
	remove_action( 'yith_wcwl_table_after_product_name', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
	}
}