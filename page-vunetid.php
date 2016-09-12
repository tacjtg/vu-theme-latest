<?php
/* Template Name: VUnetID Protected */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

get_header('vunetid');

// if is home page and slider option is ON
if ( (get_option('vubrand_slideron') == 'true') && (is_front_page()) ) {
    include(TEMPLATEPATH . '/slider.php');
}
wp_reset_query();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        if (function_exists('vu_breadcrumbs'))
            vu_breadcrumbs();
        if (!is_front_page()) {
            // show page title
	       echo '<h1 class=plain>'; the_title(); echo '</h1>';
        }
        echo "<div class=\"secmain\">\n";
        edit_post_link('<img src=https://www4.vanderbilt.edu/asset/i/editthis.jpg>', '<p>', '</p>');
        the_content('<p class="serif">Read the rest of this page &raquo;</p>');
        wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
        if ( comments_open() ) {
            comments_template();
        }
        echo "</div><!-- /secmain -->\n";
    }
}
echo "</div><!-- /seccontent-->\n";

get_sidebar();
get_footer();