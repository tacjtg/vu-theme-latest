<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// remove RSS widget because it is causing major issues on the server and SEARCH widget because its built into the templates already
add_action('widgets_init', 'remove_default_widgets',0);

function remove_default_widgets() {
	if ( function_exists('unregister_widget' ) ) {
		unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Widget_RSS');
	}
}

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar(array(
		'name' => __( 'Right Sidebar - All Pages', 'vanderbilt brand' ),
		'id' => 'all-sidebar-widgets',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
		register_sidebar(array(
		'name' => __( 'Right Sidebar - Home', 'vanderbilt brand' ),
		'id' => 'home-sidebar-widgets',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => __( 'Right Sidebar - Pages', 'vanderbilt brand' ),
		'id' => 'pages-sidebar-widgets',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => __( 'Footer - Quicklinks 1', 'vanderbilt brand' ),
		'id' => 'footer-widget-one',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4 id="hidetitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => __( 'Footer - Quicklinks 2', 'vanderbilt brand' ),
		'id' => 'footer-widget-two',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4 id="hidetitle">',
		'after_title' => '</h4>',
	));
}