<?php
// Theme support options
require_once(get_template_directory().'/assets/functions/theme-support.php');

// WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/cleanup.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/assets/functions/menu.php');
require_once(get_template_directory().'/assets/functions/menu-walkers.php');

// Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/sidebar.php');

// Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/comments.php');

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/functions/page-navi.php');

// Adds support for multiple languages
require_once(get_template_directory().'/assets/translation/translation.php');

// Use this as a template for custom post types
//require_once(get_template_directory().'/assets/functions/custom-post-type.php');
require_once(get_template_directory().'/assets/functions/custom-post-movies.php');
require_once(get_template_directory().'/assets/functions/custom-post-packages.php');
require_once(get_template_directory().'/assets/functions/custom-post-help.php');
require_once(get_template_directory().'/assets/functions/custom-post-awards.php');
require_once(get_template_directory().'/assets/functions/custom-post-partner-vouchers.php');

require_once(get_template_directory().'/libs/bkdk_api.php');
require_once(get_template_directory().'/libs/bkdk_user.php');
require_once(get_template_directory().'/libs/bkdk_user_info.php');
require_once(get_template_directory().'/libs/bkdk_messages.php');
require_once(get_template_directory().'/libs/bkdk_password_reset.php');
require_once(get_template_directory().'/libs/bkdk_create_profile.php');
require_once(get_template_directory().'/libs/bkdk_user_favourite_cinema.php');
require_once(get_template_directory().'/libs/bkdk_url.php');
require_once(get_template_directory().'/libs/bkdk_basket.php');
require_once(get_template_directory().'/libs/bkdk_memberships.php');
require_once(get_template_directory().'/libs/bkdk_barcodes.php');
require_once(get_template_directory().'/libs/bkdk_register_kupon.php');
require_once(get_template_directory().'/libs/bkdk_register_membership.php');
require_once(get_template_directory().'/libs/bkdk_profile_settings.php');
require_once(get_template_directory().'/libs/bkdk_lottery.php');
require_once(get_template_directory().'/libs/bkdk_brochure.php');
require_once(get_template_directory().'/libs/bkdk_error.php');
require_once(get_template_directory().'/libs/bkdk_fblogin.php');
require_once(get_template_directory().'/libs/bkdp_fbshare.php');
require_once(get_template_directory().'/libs/bkdk_update_card.php');
require_once(get_template_directory().'/libs/bkdk_recommend_to_a_friend.php');
// Customize the WordPress login menu
// require_once(get_template_directory().'/assets/functions/login.php');

// Customize the WordPress admin
// require_once(get_template_directory().'/assets/functions/admin.php');