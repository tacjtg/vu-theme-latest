<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
do_action('myve_page');

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		if ( function_exists( 'vu_breadcrumbs' ) ) {
			vu_breadcrumbs();
		}
		if ( !is_front_page() ) {
			the_title('<h1 class="plain">', '</h1>');
		}
		echo '<div class="secmain">';
		edit_post_link('<img src=https://www4.vanderbilt.edu/asset/i/editthis.jpg>', '<p>', '</p>');
		the_content('<p class="serif">Read the rest of this page &raquo;</p>');
		wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
		echo '</div><!-- /secmain -->';
	}
}
echo '</div><!-- /seccontent-->';

get_sidebar();
get_footer();