<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Google Site Verification
add_action('wp_head', 'myve_googlesiteverify');

if( ! function_exists( 'myve_googlesiteverify' ) ) {
	function myve_googlesiteverify() {
		$googlesiteverify = get_option('vubrand_googlesiteverify');

		if( $googlesiteverify != '' ) {
			echo '<meta name="google-site-verification" content="' . $googlesiteverify . '" />';
		}
	}
}

// Custom CSS block
add_action('wp_head', 'myve_customcss', 999);

if( ! function_exists( 'myve_customcss' ) ) {
	function myve_customcss() {
		if ( get_option('vubrand_customcss') <> "" ) {
			$output = "<style type='text/css'><!-- \n";
			$output .= stripslashes(get_option('vubrand_customcss')) . "\n";
			$output .= "\n --></style>\n";
			echo $output;
		}
	}
}

// Custom meta tags
add_action('wp_head', 'myve_metatags', 1);

if( ! function_exists( 'myve_metatags' ) ) {
	function myve_metatags() {
		if ( is_single() || is_page() ) {
			echo '<meta name="description" content="' . get_the_title() . '. ' . get_the_excerpt() . '" />';
			myve_csv_post_tags();
		} elseif ( is_home() ) {
		echo '<meta name="description" content="Vanderbilt University, located in Nashville, Tennessee, is a private research university and medical center offering a full-range of undergraduate, graduate and professional degrees." />';
		echo '<meta name="keywords" content="vanderbilt, vanderbilt university, commodores, nashville, tennessee" />';
		}
	}
}

// Custom Header
add_action( 'myve_header_after_body', 'myve_header_style' );

if( ! function_exists( 'myve_header_style' ) ) {
	function myve_header_style() {

		$whichbrand = get_option('vubrand_brandbar');

		if($whichbrand=='Vanderbilt') { $brand='vu';}
		elseif($whichbrand=='Blair') { $brand='blair'; }
		elseif($whichbrand=='CAS') { $brand='cas'; }
		elseif($whichbrand=='Divinity') { $brand='div'; }
		elseif($whichbrand=='Engineering') { $brand='eng'; }
		elseif($whichbrand=='Graduate') { $brand='grad'; }
		elseif($whichbrand=='Law') { $brand='law'; }
		elseif($whichbrand=='Medicine') { $brand='som'; }
		elseif($whichbrand=='Nursing') { $brand='son'; }
		elseif($whichbrand=='Owen') { $brand='owen'; }
		elseif($whichbrand=='Peabody') { $brand='peabody'; }
		else { $brand='vu'; }

		echo '<script type="text/javascript" src="https://www4.vanderbilt.edu/asset/' . $brand . 'brandbar.js"></script>';
	}
}
