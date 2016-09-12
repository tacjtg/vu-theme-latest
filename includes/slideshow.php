<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Output Nivo Slideshow Settings to wp_head
add_action( 'wp_head', 'myve_slideshow_settings', 99 );

if( ! function_exists( 'myve_slideshow_settings' ) ) {
	function myve_slideshow_settings() {
		if ( ( get_option( 'vubrand_slideron' ) == 'true' ) && ( is_front_page() ) ) {
			echo '<script src="' . get_stylesheet_directory_uri() . '/nivo/jquery.nivo.slider.pack.js" type="text/javascript"></script>';
			echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/nivo/slideshow.css" type="text/css" media="screen" />';
			$jquery_settings = <<<HTML

<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('#myslideshow').nivoSlider( {
			effect:'random',
			slices:1,
			animSpeed:500,
			pauseTime:4500,
			directionNav:true,
			directionNavHide:true,
			controlNav:true
		} );
	});
</script>

HTML;
			echo $jquery_settings;
		}
	}
}

// Output Nivo Slideshow to page.php
add_action( 'myve_page', 'myve_slideshow_html' );

if( ! function_exists( 'myve_slideshow_html' ) ) {
	function myve_slideshow_html() {
		if ( ( get_option( 'vubrand_slideron' ) == 'true' ) && ( is_front_page() ) ) {
			echo '<!-- Begin Slideshow -->';
			echo '<div id="myslideshow" class="nivoSlider">	';

			$args = array(
				'tag' => 'featured',
				'post_type' => 'any',
			);
			$sliderstories = new WP_Query( $args );
			if ($sliderstories->have_posts()) :
				while ($sliderstories->have_posts()) :
					$sliderstories->the_post();
					$slidertext = get_post_meta(get_the_ID(), 'featuretext', $single = true);
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id,'feat-slider');
					$image_url = $image_url[0];

					if ( $slidertext != '' ) {
						$slide_title = addslashes($slidertext);
					} else {
						$slide_title = get_the_title();
					}

					echo '<a href="' . esc_url( get_permalink() ) . '"><img src="' . $image_url .'" title="' . $slide_title . '" width="650" height="300" /></a>';

				endwhile;
			endif;

			wp_reset_query();

			echo '</div><!-- /#myslideshow -->';
			echo '<hr class="space" />';
			echo '<!-- End Slideshow -->';
		}
	}
}