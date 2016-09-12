<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '1');

/**
 * Load the included PHP files.
 *
 * @package MyVanderbilt
 * @author 	Vanderbilt Web Communications Team
 */

// Load Admin Panel
require_once( get_stylesheet_directory() . '/includes/admin-panel.php' );

// Load WP Cleanup
require_once( get_stylesheet_directory() . '/includes/cleanup.php' );

// Load Content Support
require_once( get_stylesheet_directory() . '/includes/content.php' );

// Load Dashboard Customizations
require_once( get_stylesheet_directory() . '/includes/dashboard.php' );

// Load VUnetID Support
require_once( get_stylesheet_directory() . '/includes/session.php' );

// Load Shortcode Support
require_once( get_stylesheet_directory() . '/includes/shortcodes.php' );

// Load Slideshow
require_once( get_stylesheet_directory() . '/includes/slideshow.php' );

// Load Theme Options
require_once( get_stylesheet_directory() . '/includes/theme-options.php' );

// Load Sidebars & Widgets
require_once( get_stylesheet_directory() . '/includes/widgets.php' );

// Load VU Overrides
require_once( get_stylesheet_directory() . '/includes/vu-overrides.php' );