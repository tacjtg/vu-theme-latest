<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Declare theme variables
$themename = "Vanderbilt Brand";
$shortname = "vubrand";

// create theme options panel
$options = array (
array( "name" => $themename." Options",
	"type" => "title"),
array( "name" => "General Site Settings",
	"type" => "section"),
array( "type" => "open"),
array( "name" => "Brand Bar / School",
	"desc" => "Select the brand bar to use at the top of your website",
	"id" => $shortname."_brandbar",
	"type" => "select",
	"options" => array("Vanderbilt", "Blair","CAS","Divinity","Engineering","Graduate","Law","Medicine","Nursing","Owen","Peabody"),
	"std" => "Vanderbilt"),
array( "name" => "Password Protected",
	"desc" => "Put this ENTIRE SITE behind VUnetID.",
	"id" => $shortname."_vunetidprotect",
	"type" => "select",
	"options" => array("no", "yes"),
	"std" => "no"),
array( "name" => "Include slideshow on my homepage.",
	"desc" => "Display an image slideshow with captions based on page titles. Any post or page with a tag 'featured' will be put in the slider.",
	"id" => $shortname."_slideron",
	"type" => "checkbox",
	"std" => "true"),
array( "name" => "Navigation style",
	"desc" => "Select the type/location of your navigation",
	"id" => $shortname."_navstyle",
	"type" => "select",
	"options" => array("top", "right"),
	"std" => "top"),
array( "name" => "Navigation Built from",
	"desc" => "Use automatically built menus or manually build them using the Appearances->Menu screen",
	"id" => $shortname."_menusource",
	"type" => "select",
	"options" => array("Auto", "Manual"),
	"std" => "Auto"),
array( "name" => "Manual Menu Name",
	"desc" => "If using a manual menu, enter the menu name here",
	"id" => $shortname."_menuname",
	"type" => "text",
	"std" => ""),
array( "name" => "Pages to Hide in Navigation",
	"desc" => "Enter a comma-separated list of ID's that you'd like to exclude from the top navigation. (e.g. 12,23,27,44)",
	"id" => $shortname."_hidepages",
	"type" => "text",
	"std" => ""),
array( "name" => "Google Site Verification",
	"desc" => "Enter the VALUE ONLY of the meta content for Google Site Verification",
	"id" => $shortname."_googlesiteverify",
	"type" => "text",
	"std" => ""),
array( "type" => "close"),
array( "name" => "Design Options",
	"type" => "section"),
array( "type" => "open"),
array( "name" => "Use an image for your header instead of text.",
	"desc" => "",
	"id" => $shortname."_graphicheader",
	"type" => "checkbox",
	"std" => "false"),
array( "name" => "Header Image",
	"desc" => "Paste the URL of the image here. (maximum width: 950 pixels)",
	"id" => $shortname."_headerimage",
	"type" => "text",
	"std" => "https://www4.vanderbilt.edu/asset/i/Sample-header.jpg"),
array( "name" => "Header Background Color",
	"desc" => "What background color should be used behind the image? Use the full hex code (i.e. CCCCCC, FFCC66, 006699, etc.)",
	"id" => $shortname."_headercolor",
	"type" => "text",
	"std" => "CCCCCC"),
array( "name" => "Custom Styles",
	"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. Caution: This overrides other stylesheets. eg: a.button{color:green}",
	"id" => $shortname."_customcss",
	"type" => "textarea",
	"std" => ""),
array( "type" => "close"),
array( "name" => "Right column news and events",
	"type" => "section"),
array( "type" => "open"),
array( "name" => "Include news feed in right column?",
	"desc" => "",
	"id" => $shortname."_newsrightcol",
	"type" => "checkbox",
	"std" => "true"),
array( "name" => "News Feed Title",
	"desc" => "What will appear as the title of the news section (Recent News, by default)",
	"id" => $shortname."_newstitle",
	"type" => "text",
	"std" => "Recent News"),
array( "name" => "External news feed",
	"desc" => "Display another news feed INSTEAD of the POSTS from this website.",
	"id" => $shortname."_othernewsfeed",
	"type" => "text",
	"std" => ""),
array( "name" => "Include calendar events feed in right column?",
	"desc" => "",
	"id" => $shortname."_calendaron",
	"type" => "checkbox",
	"std" => "false"),
array( "name" => "Vanderbilt Calendar Tag to pull through",
	"desc" => "Contact www@vanderbilt.edu if you are not sure what to put here",
	"id" => $shortname."_calendartag",
	"type" => "text",
	"std" => "myvu"),
array( "type" => "close"),
array( "name" => "Social Media Links",
	"type" => "section"),
array( "type" => "open"),
array( "name" => "Show Social Media Share Links",
	"desc" => "Display sharing links in the right column",
	"id" => $shortname."_socialsharelinks",
	"type" => "select",
	"options" => array("yes", "no"),
	"std" => "yes"),
array( "name" => "Display Social Media Links in Footer?",
	"desc" => "Will hide or show the social media footer area.",
	"id" => $shortname."_footersocialshow",
	"type" => "select",
	"options" => array("no", "yes"),
	"std" => "yes"),
array( "name" => "Connect Section Title",
	"desc" => "what should we call the social media icon section",
	"id" => $shortname."_connectwith",
	"type" => "text",
	"std" => "Connect with Vanderbilt"),
array( "name" => "Facebook",
	"desc" => "Full URL to facebook page",
	"id" => $shortname."_facebookurl",
	"type" => "text",
	"std" => ""),
array( "name" => "Twitter",
	"desc" => "Full URL to twitter page",
	"id" => $shortname."_twitterurl",
	"type" => "text",
	"std" => ""),
array( "name" => "YouTube",
	"desc" => "Full URL to youtube page",
	"id" => $shortname."_youtubeurl",
	"type" => "text",
	"std" => ""),
array( "name" => "Google+",
	"desc" => "Full URL to google+ page",
	"id" => $shortname."_googleplus",
	"type" => "text",
	"std" => ""),
array( "name" => "Pinterest",
	"desc" => "Full URL to Pinterest page",
	"id" => $shortname."_pinterest",
	"type" => "text",
	"std" => ""),
array( "name" => "Instagram",
	"desc" => "Full URL to Instagram profile page or hashtag",
	"id" => $shortname."_instagram",
	"type" => "text",
	"std" => ""),
array( "name" => "LinkedIn",
	"desc" => "Full URL to LinkedIn page",
	"id" => $shortname."_linkedin",
	"type" => "text",
	"std" => ""),
array( "name" => "Flickr",
	"desc" => "Full URL to flickr page",
	"id" => $shortname."_flickrurl",
	"type" => "text",
	"std" => ""),
array( "name" => "Flickr User ID",
	"desc" => "Find your flickr user id at http://idgettr.com/",
	"id" => $shortname."_flickrid",
	"type" => "text",
	"std" => ""),
array( "type" => "close"),
array( "name" => "Footer",
	"type" => "section"),
array( "type" => "open"),
array( "name" => "Footer Link List Heading",
	"desc" => "What should the footer link list be titled?",
	"id" => $shortname."_footlinkheader",
	"type" => "text",
	"std" => ""),
array( "name" => "Footer copyright text",
	"desc" => "Enter text used in the right side of the footer. It can be HTML",
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"std" => ""),
array( "name" => "Google Analytics Code",
	"desc" => "Paste your Google Analytics or other tracking code in this box.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),
array( "type" => "close")
);

// Create Theme Options Page
function mytheme_add_admin() {
	global $themename, $shortname, $options;
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( $_REQUEST['action'] == 'save' ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			}
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
				} else {
					delete_option( $value['id'] );
				}
			}
			header("Location: admin.php?page=admin-panel.php&saved=true");
			die;
		} else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				delete_option( $value['id'] );
			}
			header("Location: admin.php?page=admin-panel.php&reset=true");
			die;
		}
	}
	add_theme_page($themename, $themename, 'edit_theme_options', basename(__FILE__), 'mytheme_admin');
}


function mytheme_add_init() {
	wp_enqueue_style( 'option-panel-style', get_stylesheet_directory_uri() . '/theme-options/option-panel.css' );
	wp_enqueue_script( 'option-panel-js' , get_stylesheet_directory_uri() . '/theme-options/option-panel.js' );
}

// admin theme
function mytheme_admin() {
global $themename, $shortname, $options;
$i=0;

if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
case "open":
?>
<?php break;
case "close":
?>
</div>
</div>
<br />
<?php break;
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>
<?php break;
case 'text':
?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php
break;
case 'textarea':
?>
<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php
break;
case 'select':
?>
<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
case "checkbox":
?>
<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break;
case "section":
$i++;
?>
<div class="rm_section">
<div class="rm_title"><h3><img src="<?php get_stylesheet_directory_uri() . '/theme-options/images/trans.gif' ?>" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">
<?php break;
}
}
?>
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
 </div>
<?php
}
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>