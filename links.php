<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template Name: Links
 */

get_header();

get_sidebar(); ?>

<h2>Links:</h2>
<ul>
	<?php wp_list_bookmarks(); ?>
</ul>

<?php get_footer();