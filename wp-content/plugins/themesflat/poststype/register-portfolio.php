<?php
add_action('init', 'themesflat_register_portfolio_post_type');
/**
  * Register project post type
*/
function themesflat_register_portfolio_post_type() {
    /*Portfolios*/
    $portfolio_slug = 'portfolios';
    $labels = array(
        'name'                  => esc_html__( 'Portfolios', 'themesflat' ),
        'singular_name'         => esc_html__( 'Portfolios', 'themesflat' ),
        'menu_name'             => esc_html__( 'Portfolios', 'themesflat' ),
        'add_new'               => esc_html__( 'New Portfolios', 'themesflat' ),
        'add_new_item'          => esc_html__( 'Add New Portfolios', 'themesflat' ),
        'new_item'              => esc_html__( 'New Portfolios Item', 'themesflat' ),
        'edit_item'             => esc_html__( 'Edit Portfolios Item', 'themesflat' ),
        'view_item'             => esc_html__( 'View Portfolios', 'themesflat' ),
        'all_items'             => esc_html__( 'All Portfolios', 'themesflat' ),
        'search_items'          => esc_html__( 'Search Portfolios', 'themesflat' ),
        'not_found'             => esc_html__( 'No Portfolios Items Found', 'themesflat' ),
        'not_found_in_trash'    => esc_html__( 'No Portfolios Items Found In Trash', 'themesflat' ),
        'parent_item_colon'     => esc_html__( 'Parent Portfolios:', 'themesflat' )

    );
    $args = array(
        'labels'        => $labels,
        'rewrite'       => array( 'slug' => $portfolio_slug ),        
        'supports'    => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'elementor' ),
        'public'        => true,
        'show_in_rest' => true,
        'has_archive' => true
    );
    register_post_type( 'portfolios', $args );
    flush_rewrite_rules();
}

add_filter( 'post_updated_messages', 'themesflat_portfolios_updated_messages' );
/**
  * Portfolios update messages.
*/
function themesflat_portfolios_updated_messages ( $messages ) {
    Global $post, $post_ID;
    $messages[esc_html__( 'portfolios' )] = array(
        0  => '',
        1  => sprintf( esc_html__( 'Portfolios Updated. <a href="%s">View portfolios</a>', 'themesflat' ), esc_url( get_permalink( $post_ID ) ) ),
        2  => esc_html__( 'Custom Field Updated.', 'themesflat' ),
        3  => esc_html__( 'Custom Field Deleted.', 'themesflat' ),
        4  => esc_html__( 'Portfolios Updated.', 'themesflat' ),
        5  => isset( $_GET['revision']) ? sprintf( esc_html__( 'Portfolios Restored To Revision From %s', 'themesflat' ), wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6  => sprintf( esc_html__( 'Portfolios Published. <a href="%s">View Portfolios</a>', 'themesflat' ), esc_url( get_permalink( $post_ID ) ) ),
        7  => esc_html__( 'Portfolios Saved.', 'themesflat' ),
        8  => sprintf( esc_html__('Portfolios Submitted. <a target="_blank" href="%s">Preview Portfolios</a>', 'themesflat' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
        9  => sprintf( esc_html__( 'Portfolios Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolios</a>', 'themesflat' ),date_i18n( esc_html__( 'M j, Y @ G:i', 'themesflat' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
        10 => sprintf( esc_html__( 'Portfolios Draft Updated. <a target="_blank" href="%s">Preview Portfolios</a>', 'themesflat' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
    );
    return $messages;
}

add_action( 'init', 'themesflat_register_portfolios_taxonomy' );
/**
  * Register portfolios taxonomy
*/
function themesflat_register_portfolios_taxonomy() {
    /*Portfolios Categories*/
    $portfolio_cat_slug = 'portfolios_category';    
    $labels = array(
        'name'                       => esc_html__( 'Portfolios Categories', 'themesflat' ),
        'singular_name'              => esc_html__( 'Categories', 'themesflat' ),
        'search_items'               => esc_html__( 'Search Categories', 'themesflat' ),
        'menu_name'                  => esc_html__( 'Categories', 'themesflat' ),
        'all_items'                  => esc_html__( 'All Categories', 'themesflat' ),
        'parent_item'                => esc_html__( 'Parent Categories', 'themesflat' ),
        'parent_item_colon'          => esc_html__( 'Parent Categories:', 'themesflat' ),
        'new_item_name'              => esc_html__( 'New Categories Name', 'themesflat' ),
        'add_new_item'               => esc_html__( 'Add New Categories', 'themesflat' ),
        'edit_item'                  => esc_html__( 'Edit Categories', 'themesflat' ),
        'update_item'                => esc_html__( 'Update Categories', 'themesflat' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove Categories', 'themesflat' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used Categories', 'themesflat' ),
        'not_found'                  => esc_html__( 'No Categories found.' ),
        'menu_name'                  => esc_html__( 'Categories' ),
    );
    $args = array(
        'labels'        => $labels,
        'rewrite'       => array('slug'=>$portfolio_cat_slug),
        'hierarchical'  => true,
        'show_in_rest'  => true,
    );
    register_taxonomy( 'portfolios_category', 'portfolios', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'themesflat_register_portfolios_tag' );
/**
 * Register tag taxonomy
 */
function themesflat_register_portfolios_tag() {
    $portfolio_tag_slug = 'portfolios_tag';

    $labels = array(
        'name'                       => esc_html__( 'Portfolio Tags', 'themesflat' ),
        'singular_name'              => esc_html__( 'Portfolio Tags', 'themesflat' ),
        'search_items'               => esc_html__( 'Search Tags', 'themesflat' ),        
        'all_items'                  => esc_html__( 'All Tags', 'themesflat' ),
        'new_item_name'              => esc_html__( 'Add New Tag', 'themesflat' ),
        'add_new_item'               => esc_html__( 'New Tag Name', 'themesflat' ),
        'edit_item'                  => esc_html__( 'Edit Tag', 'themesflat' ),
        'update_item'                => esc_html__( 'Update Tag', 'themesflat' ),
        'menu_name'                  => esc_html__( 'Tags' ),
    );
    $args = array(
        'labels'       => $labels,
        'rewrite'       => array('slug'=>$portfolio_tag_slug),
        'hierarchical' => true,
        'show_in_rest'  => true,
    );
    register_taxonomy( 'portfolios_tag', 'portfolios', $args );
    flush_rewrite_rules();
}