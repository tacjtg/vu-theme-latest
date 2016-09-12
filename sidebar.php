<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div id="secnav">';

// Not Homepage, display Home button.
if ( ! is_front_page() ) {
	echo '<p class="home"><a href="' . get_home_url() . '">Back Home&nbsp;&nbsp;&nbsp;</a></p>';
}

// Widgetized sidebar, if you have the plugin installed.
if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar() ) : endif;

// if graphic header chosen and Wordpress Search - show search in right nav
if ( get_option( 'vubrand_graphicheader' ) == 'true' ) {
	echo '<form method="get" id="searchform" action="' . get_home_url() . '/" class="round">';
	echo '<input type="text" value="SEARCH" onfocus="clearDefault(this)" name="s" id="s" class="searchfield" />';
	echo '<button class="btn" title="Submit Search">GO</button>';
	echo '</form>';
}

// Protected?
$vunetidprotect = get_option('vubrand_vunetidprotect');

if ($vunetidprotect == 'yes') {
	echo "<p>Welcome ".$_SESSION['myvuwebfirstname']." ".$_SESSION['myvuweblastname'].".<br />";
	echo "<a style='text-decoration: none; border: 0;' href='/login/logout.php'><img src='/login/logout.jpg' border='0' /></a></p>";
}

if ( get_option( 'vubrand_socialsharelinks' ) != 'no') { ?>

	<div class="sidebaraddthis addthis_toolbox addthis_32x32_style addthis_default_style">
	    <a class="addthis_button_facebook"></a>
	    <a class="addthis_button_twitter"></a>
	    <a class="addthis_button_email"></a>
	    <a class="addthis_button_print"></a>
	    <a class="addthis_button_google"></a>
	    <a class="addthis_button_compact"></a>
	</div>
	<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
	<script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js#username=vanderbilt"></script>

<?php }

// Show Homepage Widgets
if ( is_active_sidebar( 'home-sidebar-widgets' ) && is_front_page() ) {	dynamic_sidebar( 'home-sidebar-widgets' ); }

// Show Page Widgets
if ( is_active_sidebar( 'pages-sidebar-widgets' ) && ! is_front_page() ) { dynamic_sidebar( 'pages-sidebar-widgets' ); }

// Show 'All Pages' Widgets
if ( is_active_sidebar( 'all-sidebar-widgets') ) { dynamic_sidebar( 'all-sidebar-widgets' ); }

// Right Nav
if ( get_option( 'vubrand_navstyle' ) == 'right' ) { myve_right_navigation(); }

// Calendar
if ( get_option( 'vubrand_calendaron' ) == 'true' ) { myve_sidebar_calendar(); }

// Child Pages
if ( ( get_option( 'vubrand_navstyle' ) == 'top' ) && ( is_page() ) && ( ! is_front_page() ) ) { myve_right_navigation_child_pages(); }

// News Feed
if ( get_option( 'vubrand_newsrightcol' ) == 'true' ) { myve_news_feed(); }

echo '</div><!-- /secnav -->';