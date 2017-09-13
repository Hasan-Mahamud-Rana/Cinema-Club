<?php
add_action( 'init', 'create_custom_partner_voucher_post_type' );
/**
 * Register a partner voucher post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function create_custom_partner_voucher_post_type() {

/* Register our stylesheet. */
 $labels = array(
  'name'               => _x( 'Partner vouchers', 'post type general name', 'your-plugin-textdomain' ),
  'singular_name'      => _x( 'partner voucher', 'post type singular name', 'your-plugin-textdomain' ),
  'menu_name'          => _x( 'Partner vouchers', 'admin menu', 'your-plugin-textdomain' ),
  'name_admin_bar'     => _x( 'partner voucher', 'add new on admin bar', 'your-plugin-textdomain' ),
  'add_new'            => _x( 'Add New', 'partner voucher', 'your-plugin-textdomain' ),
  'add_new_item'       => __( 'Add New partner voucher', 'your-plugin-textdomain' ),
  'new_item'           => __( 'New partner voucher', 'your-plugin-textdomain' ),
  'edit_item'          => __( 'Edit partner voucher', 'your-plugin-textdomain' ),
  'view_item'          => __( 'View partner voucher', 'your-plugin-textdomain' ),
  'all_items'          => __( 'All partner vouchers', 'your-plugin-textdomain' ),
  'search_items'       => __( 'Search partner vouchers', 'your-plugin-textdomain' ),
  'parent_item_colon'  => __( 'Parent partner vouchers:', 'your-plugin-textdomain' ),
  'not_found'          => __( 'No partner vouchers found.', 'your-plugin-textdomain' ),
  'not_found_in_trash' => __( 'No partner vouchers found in Trash.', 'your-plugin-textdomain' )
 );

 $args = array(
  'labels'             => $labels,
  'public'             => true,
  'publicly_queryable' => true,
  'show_ui'            => true,
  'show_in_menu'       => true,
  'query_var'          => true,
  'rewrite'            => array( 'slug' => 'partner-voucher' ),
  'capability_type'    => 'post',
  'has_archive'        => true,
  'hierarchical'       => false,
  'menu_icon'          => 'dashicons-book',
  'taxonomies'         => array('category', 'post_tag'),
  'show_in_rest'       => true,
  'menu_position'      => null,
  'rest_base'          => 'partner-vouchers-api',
  'rest_controller_class' => 'WP_REST_Posts_Controller',
  'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'post-formats' )
 );

 register_post_type( 'partner voucher', $args );
}