<?php
add_action( 'init', 'create_custom_movie_post_type' );
/**
 * Register a movie post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function create_custom_movie_post_type() {

/* Register our stylesheet. */
 $labels = array(
  'name'               => _x( 'Movies', 'post type general name', 'your-plugin-textdomain' ),
  'singular_name'      => _x( 'movie', 'post type singular name', 'your-plugin-textdomain' ),
  'menu_name'          => _x( 'Movies', 'admin menu', 'your-plugin-textdomain' ),
  'name_admin_bar'     => _x( 'movie', 'add new on admin bar', 'your-plugin-textdomain' ),
  'add_new'            => _x( 'Add New', 'movie', 'your-plugin-textdomain' ),
  'add_new_item'       => __( 'Add New movie', 'your-plugin-textdomain' ),
  'new_item'           => __( 'New movie', 'your-plugin-textdomain' ),
  'edit_item'          => __( 'Edit movie', 'your-plugin-textdomain' ),
  'view_item'          => __( 'View movie', 'your-plugin-textdomain' ),
  'all_items'          => __( 'All movies', 'your-plugin-textdomain' ),
  'search_items'       => __( 'Search movies', 'your-plugin-textdomain' ),
  'parent_item_colon'  => __( 'Parent movies:', 'your-plugin-textdomain' ),
  'not_found'          => __( 'No movies found.', 'your-plugin-textdomain' ),
  'not_found_in_trash' => __( 'No movies found in Trash.', 'your-plugin-textdomain' )
 );

 $args = array(
  'labels'             => $labels,
  'public'             => true,
  'publicly_queryable' => true,
  'show_ui'            => true,
  'show_in_menu'       => true,
  'query_var'          => true,
  'rewrite'            => array( 'slug' => 'movie' ),
  'capability_type'    => 'post',
  'has_archive'        => true,
  'hierarchical'       => false,
  'menu_icon'          => 'dashicons-book',
  'taxonomies'         => array('category', 'post_tag'),
  'show_in_rest'       => true,
  'menu_position'      => null,
  'rest_base'          => 'movies-api',
  'rest_controller_class' => 'WP_REST_Posts_Controller',
  'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'post-formats' )
 );

 register_post_type( 'movie', $args );
}