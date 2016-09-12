<?php
/* Template Name: Redirect Page */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

$redir_url = get_post_meta($post->ID, 'redirect', true);
wp_redirect($redir_url);
exit();