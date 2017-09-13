<?php
/**
   * Register a Award post type, with REST API support
   *
   * Based on example at: http://codex.wordpress.org/Function_Reference/register_post_type
   */
  add_action( 'init', 'award_cpt' );
  function award_cpt() {
    $labels = array(
        'name'               => _x( 'Awards', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'award', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Awards', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'award', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'Award', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Award', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Award', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Award', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Award', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Awards', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Awards', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Awards:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No Awards found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No Awards found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'award' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-book',
        'show_in_rest'       => true,
        'taxonomies'         => array('category'),
        'rest_base'          => 'awards-api',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'award', $args );
}