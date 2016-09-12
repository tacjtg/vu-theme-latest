<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Shortcode Parser  - Remove <br> & <p>
if( ! function_exists( 'myve_shortcode_parser' ) ) {
	function myve_shortcode_parser( $content ) {
	    // Parse nested shortcodes and add formatting.
	    $content = trim( wpautop( do_shortcode( $content ) ) );
	    // Remove '</p>' from the start of the string.
	    if ( substr( $content, 0, 4 ) == '</p>' )
	        $content = substr( $content, 4 );
	    // Remove '<p>' from the end of the string.
	    if ( substr( $content, -3, 3 ) == '<p>' )
	        $content = substr( $content, 0, -3 );
	    // Remove any instances of '<p></p>'.
	    $content = str_replace( array( '<p></p>' ), '', $content );
	    return $content;
	}
}

// Shortcode - Accordion
add_shortcode( 'accordions', 'myve_shortcode_accordion_open' );

if( ! function_exists( 'myve_shortcode_accordion_open' ) ) {
	function myve_shortcode_accordion_open(  $atts, $content = null ) {
		$content = myve_shortcode_parser( $content );
		return "<link rel='stylesheet' type='text/css' href='" . get_stylesheet_directory_uri() . "/css/accordion.css' media='screen' /><script type='text/javascript' src='" .get_stylesheet_directory_uri() . "/js/accordion.js'></script><ul class='accordion collapsible'>" . do_shortcode( $content ) . "</ul>";
	}
}

// Shortcode - Accordion Section
add_shortcode( 'accordion', 'myve_shortcode_accordion_section' );

if( ! function_exists( 'myve_shortcode_accordion_section' ) ) {
	function myve_shortcode_accordion_section(  $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => 'no title entered',
		), $atts) );
		$content = myve_shortcode_parser($content);

		return "<li><a href='#'>".$title."</a><div class='acitem'>".$content."</div></li>";
	}
}

// Shortcode - List Post within a Post or Page
add_shortcode( 'showposts', 'myve_shortcode_show_posts' );

if( ! function_exists( 'myve_shortcode_show_posts' ) ) {
	function myve_shortcode_show_posts( $atts ) {
		extract( shortcode_atts( array(
			'category' => '',
			'num' => '5',
			'order' => 'ASC',
			'orderby' => 'date',
			'tag' => '',
		), $atts) );

		$out = '';
		$query = array();

		if ( $category != '' )
			$query[] = 'category=' . $category;
		if ( $tag != '' )
			$query[] = 'tag=' . $tag;
		if ( $num )
			$query[] = 'numberposts=' . $num;
		if ( $order )
			$query[] = 'order=' . $order;
		if ( $orderby )
			$query[] = 'orderby=' . $orderby;

		$posts_to_show = get_posts( implode( '&', $query ) );
		$out = '<ul>';

		foreach ($posts_to_show as $post_to_show) {
			$permalink = get_permalink( $post_to_show->ID );
			$out .= <<<HTML
			<li>
				<a href ="{$permalink}" title="{$post_to_show->post_title}">{$post_to_show->post_title}</a>
			</li>
HTML;
		}
		$out .= '</ul>';

	    return $out;
	}
}

// Shortcode - Display streaming video
add_shortcode( 'vuvideo', 'myve_shortcode_display_VUvideo' );

if( ! function_exists( 'myve_shortcode_display_VUvideo' ) ) {
	function myve_shortcode_display_VUvideo( $atts ) {
		extract( shortcode_atts( array(
			'folder' => 'public_affairs',
			'file' => 'elvis_bowl.mp4',
			'image' => 'https://vu-www4.s3.amazonaws.com/i/video-vanderbilt.jpg',
			'unique' => '',
			 'width' => '650',
			 'height' => '405',
		), $atts) );
		$out = '';
		if(empty($image)) { $image='https://vu-www4.s3.amazonaws.com/i/video-vanderbilt.jpg'; }
		$out .= <<<HTML
			<hr class='space' />
			<script type="text/javascript" src="https://vu-www4.s3.amazonaws.com/video/swfobject.js"></script>
			<div id="vandyplayer$unique"></div>
			<script type="text/javascript">
		var so = new SWFObject('https://vu-www4.s3.amazonaws.com/video/flash/vuplayer.swf','mpl','$width','$height','9');
		so.addParam('allowscriptaccess','always');
		so.addParam('allowfullscreen','true');
		so.addParam('flashvars','&streamer=rmtpe://flash.its.vanderbilt.edu/$folder&file=$file&image=$image&skin=https://vu-www4.s3.amazonaws.com/video/flash/vandy/vandy.xml&autostart=false&stretching=uniform&dock=true');
		so.write('vandyplayer$unique');
			</script>
			<hr class='space' />
HTML;

	    return $out;
	}
}

//  Shortcode - Display iframe
add_shortcode( 'vuiframe', 'myve_shortcode_display_iframe' );

if( ! function_exists( 'myve_shortcode_display_iframe' ) ) {
	function myve_shortcode_display_iframe( $atts ) {
		extract( shortcode_atts( array(
			 'source' => '',
			 'width' => '650',
			 'height' => '405',
		), $atts) );
		$out = '';
		$out .= <<<HTML
			<hr class='space' />
			<iframe src="$source" width="$width" height="$height"></iframe>
			<hr class='space' />
HTML;

	    return $out;
	}
}

// Shortcode - List Child Pages
add_shortcode('showchildren', 'myve_shortcode_child_pages');

if( ! function_exists( 'myve_shortcode_child_pages' ) ) {
	function myve_shortcode_child_pages() {
	   global $post;
	   return '<ul class="childpages">'.wp_list_pages('echo=0&depth=0&title_li=&sort_column=menu_order&child_of='.$post->ID).'</ul>';
	}
}

// Shortcode - Add customfield info to post by using [field name=customfieldname] where you want unaltered code to appear
add_shortcode('field', 'myve_shortcode_custom_field');

if( ! function_exists( 'myve_shortcode_custom_field' ) ) {
	function myve_shortcode_custom_field($atts) {
	   global $post;
	   $name = $atts['name'];
	   if (empty($name)) return;

	   return get_post_meta($post->ID, $name, true);
	}
}