<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Disable WP Update Notification
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

// Cleanup Dashboard
add_action('wp_dashboard_setup', 'myve_remove_dashboard_widgets' );

function myve_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

