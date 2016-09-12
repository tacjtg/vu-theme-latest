<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

if ( function_exists( 'vu_breadcrumbs' ) ) vu_breadcrumbs();

if ( have_posts() ) {
	$post = $posts[0]; // Hack. Set $post so that the_date() works.

	if ( is_category() ) { // Category Archive
		echo '<h2 class="pagetitle">' . single_cat_title() . '</h2>';
	} elseif ( is_tag() ) { // Tag Archive
		echo '<h2 class="pagetitle">' . single_tag_title() . '</h2>';
	} elseif ( is_day() ) { // Daily Archive
		echo '<h2 class="pagetitle">' . the_time('F jS, Y') . '</h2>';
	} elseif ( is_month() ) { // Monthly Archive
		echo '<h2 class="pagetitle">' . the_time('F, Y') . '</h2>';
	} elseif ( is_year() ) { // Yearly Archive
		echo '<h2 class="pagetitle">' . the_time('Y') . '</h2>';
	} elseif ( is_author() ) { // Author Archive
		echo '<h2 class="pagetitle">Author Archive</h2>';
	} elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) {
		echo'<h2 class="pagetitle">Archives</h2>';
	}

	echo '<div class="secmain">';

	while ( have_posts() ) {

		the_post();

		echo '<a href="' . the_permalink() . '">';

		if ( has_post_thumbnail() ) {
			the_post_thumbnail( array( 150,150 ), array( "class" => "blogthumb left" ) );
		} else {
			echo '<img src="' . esc_url( get_stylesheet_directory_uri() ) . '/theme-options/images/defaultpost.jpg" height="150" width="150" class="blogthumb left">';
		}

		echo '</a>'; ?>

		<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

		<p><?php echo get_the_excerpt(); ?>...
		<a href="<?php the_permalink(); ?>">KEEP READING</a></p>
		<p><small>Posted on <?php the_time('l, F jS, Y') ?> in <?php the_category(', ') ?> | <?php the_tags('Tags: ', ', ', ''); ?> <?php edit_post_link('Edit', '', ' | '); ?> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></small></p>

		<hr />
	<?php } ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

<?php else {

		if ( is_category() ) { // Category Archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // Date Archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // Author Archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();
	}
}

echo '</div><!-- /secmain -->';
echo '</div><!-- /seccontent-->';

get_sidebar();
get_footer();