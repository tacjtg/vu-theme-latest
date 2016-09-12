<?php
/* Template Name: Events Listing Page */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

get_header();

wp_enqueue_style( 'myve-events-style' );

if ( function_exists( 'vu_breadcrumbs' ) ) { vu_breadcrumbs(); }

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		echo '<h1 class="plain">' . the_title() . '</h1>';
		echo '<div class="secmain">';
		the_content('<p class="serif">Read the rest of this page &raquo;</p>');
		wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
	}
}

edit_post_link('Edit this entry.', '<p>', '</p>');

myve_page_calendar();

echo '</div><!-- /secmain -->';
echo '</div><!-- /seccontent-->';

get_sidebar();
get_footer();