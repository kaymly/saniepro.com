<?php
add_action('init', 'themesflat_register_project_post_type');
/**
  * Register project post type
*/
function themesflat_register_project_post_type() {
    /*project*/
    $project_slug = 'project';
    $labels = array(
        'name'                  => esc_html__( 'Project', 'themesflat' ),
        'singular_name'         => esc_html__( 'Project', 'themesflat' ),
        'menu_name'             => esc_html__( 'Project', 'themesflat' ),
        'add_new'               => esc_html__( 'New Project', 'themesflat' ),
        'add_new_item'          => esc_html__( 'Add New Project', 'themesflat' ),
        'new_item'              => esc_html__( 'New Project Item', 'themesflat' ),
        'edit_item'             => esc_html__( 'Edit Project Item', 'themesflat' ),
        'view_item'             => esc_html__( 'View Project', 'themesflat' ),
        'all_items'             => esc_html__( 'All Project', 'themesflat' ),
        'search_items'          => esc_html__( 'Search Project', 'themesflat' ),
        'not_found'             => esc_html__( 'No Project Items Found', 'themesflat' ),
        'not_found_in_trash'    => esc_html__( 'No Project Items Found In Trash', 'themesflat' ),
        'parent_item_colon'     => esc_html__( 'Parent Project:', 'themesflat' )

    );
    $args = array(
        'labels'        => $labels,
        'rewrite'       => array( 'slug' => $project_slug ),        
        'supports'    => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'elementor' ),
        'public'        => true,
        'show_in_rest' => true,
        'has_archive' => true
    );
    register_post_type( 'project', $args );
    flush_rewrite_rules();
}

add_filter( 'post_updated_messages', 'themesflat_project_updated_messages' );
/**
  * project update messages.
*/
function themesflat_project_updated_messages ( $messages ) {
    Global $post, $post_ID;
    $messages[esc_html__( 'project' )] = array(
        0  => '',
        1  => sprintf( esc_html__( 'Project Updated. <a href="%s">View Project</a>', 'themesflat' ), esc_url( get_permalink( $post_ID ) ) ),
        2  => esc_html__( 'Custom Field Updated.', 'themesflat' ),
        3  => esc_html__( 'Custom Field Deleted.', 'themesflat' ),
        4  => esc_html__( 'Project Updated.', 'themesflat' ),
        5  => isset( $_GET['revision']) ? sprintf( esc_html__( 'Project Restored To Revision From %s', 'themesflat' ), wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6  => sprintf( esc_html__( 'Project Published. <a href="%s">View Project</a>', 'themesflat' ), esc_url( get_permalink( $post_ID ) ) ),
        7  => esc_html__( 'Project Saved.', 'themesflat' ),
        8  => sprintf( esc_html__('Project Submitted. <a target="_blank" href="%s">Preview Project</a>', 'themesflat' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
        9  => sprintf( esc_html__( 'Project Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Project</a>', 'themesflat' ),date_i18n( esc_html__( 'M j, Y @ G:i', 'themesflat' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
        10 => sprintf( esc_html__( 'Project Draft Updated. <a target="_blank" href="%s">Preview Project</a>', 'themesflat' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
    );
    return $messages;
}

add_action( 'init', 'themesflat_register_project_taxonomy' );
/**
  * Register project taxonomy
*/
function themesflat_register_project_taxonomy() {
    /*project Categories*/
    $project_cat_slug = 'project_category';    
    $labels = array(
        'name'                       => esc_html__( 'Project Categories', 'themesflat' ),
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
        'rewrite'       => array('slug'=>$project_cat_slug),
        'hierarchical'  => true,
        'show_in_rest'  => true,
    );
    register_taxonomy( 'project_category', 'project', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'themesflat_register_project_tag' );
/**
 * Register tag taxonomy
 */
function themesflat_register_project_tag() {
    $project_tag_slug = 'project_tag';

    $labels = array(
        'name'                       => esc_html__( 'Project Tags', 'themesflat' ),
        'singular_name'              => esc_html__( 'Project Tags', 'themesflat' ),
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
        'rewrite'       => array('slug'=>$project_tag_slug),
        'hierarchical' => true,
        'show_in_rest'  => true,
    );
    register_taxonomy( 'project_tag', 'project', $args );
    flush_rewrite_rules();
}