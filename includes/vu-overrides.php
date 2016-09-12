<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
/*
 * Set up a custom login screen
 */
function vanderbilt_brand_login() {
  echo '<style type="text/css">body { background: #f9f9f9; } h1 a { background-image:url('. get_template_directory_uri() .'/images/vanderbilt-wp.jpg) !important; background-size: 253px !important; width: 253px !important; height: 69px !important; } .login .message { border-left: 4px solid #d8ab4c; } .wp-core-ui .button-primary { background: #d8ab4c; border-color: #FC6; } .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary.focus, .wp-core-ui .button-primary:hover, .wp-core-ui .button-primary:focus { background: #FC6; border-color: #d8ab4c; }';
  echo '</style>';
}
add_action('login_head', 'vanderbilt_brand_login');

/*
 * Add a custom admin logo
 */
function vanderbilt_brand_admin() {
  echo '<style type="text/css">
    #header-logo { background-image: url('. get_template_directory_uri() .'/images/vanderbilt-v.gif) !important; }
    </style>';
}
add_action('admin_head', 'vanderbilt_brand_admin');

/*
 * Link VU logo back to WebComm
 */
function vanderbilt_brand_login_link(){
  return "http://web.vanderbilt.edu";
}
add_filter('login_headerurl', 'vanderbilt_brand_login_link');

/*
 * Add the VU favicon
 */
function vanderbilt_brand_favicon() {
  echo '<link rel="shortcut icon" href="https://www4.vanderbilt.edu/favicon.ico" />';
}
add_action('wp_head', 'vanderbilt_brand_favicon');
?>