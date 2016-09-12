<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts' , 'myve_load_css_js' );

if( ! function_exists( 'myve_load_css_js' ) ) {
	function myve_load_css_js() {

		// Register Styles & Scripts
		wp_register_style( 'myve-print-style', 'https://www4.vanderbilt.edu/asset/css/print.css' , 'print' );
		wp_register_style( 'myve-screen-style', 'https://www4.vanderbilt.edu/asset/css/vustylemin.css', 'screen' );
		wp_register_style( 'myve-main-style', get_template_directory_uri() . '/style.css' );
		wp_register_style( 'myve-events-style', get_template_directory_uri() . '/css/events-style.css' ); // Used on page-events.php
		wp_register_script( 'myve-scripts', get_template_directory_uri() . '/js/scripts.js' );
		wp_register_script( 'myve-responsive-videos', get_template_directory_uri() . '/js/responsive-videos.js' );
		if (!is_page_template( 'page-plain.php' )) {
			//wp_enqueue_style( 'myve-print-style' );
			wp_enqueue_style( 'myve-screen-style' );
			wp_enqueue_style( 'myve-main-style' );
			wp_enqueue_script( 'myve-scripts' );
			wp_enqueue_script( 'myve-responsive-videos' );
		}
	}
}

// Remove Header Junk
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Displays the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'rsd_link' ); // Displays the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Displays the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Displays relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Displays the XHTML generator that is generated on the wp_head hook, WP version

// disable wordpress update notifications for users
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

// Disable XML-RPC PING
add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );

function remove_xmlrpc_pingback_ping( $methods ) {
   unset( $methods['pingback.ping'] );
   return $methods;
} ;

// Always show custom fields
add_action( 'admin_head', 'showhiddencustomfields' );

function showhiddencustomfields() {
	echo "<style type='text/css'>#postcustom .hidden { display: table-row; }</style>\n";
}

// Add Title Tag Support
add_theme_support( 'title-tag' );