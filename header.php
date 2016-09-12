<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

do_action('myve_header_before_html'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?php wp_title('| ', true, 'right'); bloginfo('name'); ?> | Vanderbilt University</title>

	<?php wp_head(); ?>

	<!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href="https://www4.vanderbilt.edu/asset/css/ie6.css" media="screen" />
		<script src="https://www4.vanderbilt.edu/asset/scripts/pngie.js"></script>
	<![endif]-->
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="<?php  echo esc_url( get_stylesheet_directory_uri() ); ?>/css/style-ie.css" type="text/css" media="screen" />
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="https://ie7-js.googlecode.com/svn/version/2.1(beta3)/IE9.js"></script>
		<link rel="stylesheet" type="text/css" href="https://www4.vanderbilt.edu/asset/css/ie.css" media="screen" />
	<![endif]-->

</head>
<body <?php body_class( $class ); ?>>

<?php do_action('myve_header_after_body'); ?>

<div id="content">

<?php if ( get_option('vubrand_graphicheader') == 'true' ) { ?>

<div class="graphicheader clear" style="background: #<?php echo get_option('vubrand_headercolor'); ?>; ">
	<div class="container">
		<h1 class="noshow"><?php bloginfo('name'); ?></h1>
		<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo get_option('vubrand_headerimage'); ?>" width="950" border="0"/></a>
	</div>
</div>

<?php } else { ?>

<div class="header clear">
	<div class="container">
		<h1 class="plain"><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a></h1>
		<form method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>/" class="round">
			<input type="text" value="SEARCH" onfocus="clearDefault(this)" name="s" id="s" class="searchfield" />
			<button class="btn" title="Submit Search">GO</button>
		</form>
	</div>
</div>

<?php } ?>


<?php if ( ( get_option('vubrand_navstyle') == 'top' ) || ( get_option('vubrand_navstyle') == '' ) ) { ?>

<div id="sitenavigation" class="clearfix">
	<div class="container">
		<?php // Manually Built Menu or Auto Built?
			$menutype = get_option('vubrand_menusource');
			$whichmenu = get_option('vubrand_menuname');
			$hidethese = get_option('vubrand_hidepages');

			if($menutype=='Manual') {
				wp_nav_menu(array('container'=>'false', 'menu'=>$whichmenu, 'sort_column' => 'menu_order', 'menu_id' => 'sitenav' ) );
			} else {
				echo '<ul id="sitenav">';
				wp_list_pages('title_li=&exclude='.$hidethese.'&depth=2');
				echo "</ul>";
			} ?>
	</div>
</div>

<?php } ?>

<div class="container">
	<div id="seccontent">