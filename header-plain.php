<?php
/**
* @package WordPress
* @subpackage vanderbilt brand
*/
// Non-VUNetID Sessions
$siteurl = home_url();
$sitetitle = get_bloginfo('name');
$_SESSION['myvuwebrequested'] = $siteurl;
$_SESSION['myvuwebsitename'] = $sitetitle;
// what pages should we hide?
$hidethese = get_option('vubrand_hidepages');
$whichbrand = get_option('vubrand_brandbar');
$googlesiteverify = get_option('vubrand_googlesiteverify');
$sitemetakeywords = get_option('vubrand_sitemetakeywords');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php wp_title('| ', true, 'right'); ?> <?php bloginfo('name'); ?> | Vanderbilt University</title>
        <?php
        if (is_single() || is_page() ) :
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post(); ?>
        <meta name="description" content="<?php single_post_title('', true); echo ". "; the_excerpt_rss(); ?>" />
        <?php myvuweb_csv_post_tags(); ?>
        <?php
                endwhile;
            endif;
        elseif(is_home()) : ?>
        <meta name="description" content="Vanderbilt University, located in Nashville, Tennessee, is a private research university and medical center offering a full-range of undergraduate, graduate and professional degrees." />
        <meta name="keywords" content="<?php echo $sitemetakeywords;?>, vanderbilt, vanderbilt university, commodores, nashville, tennessee" />
        <?php
        endif;
        if ($googlesiteverify!='') {
            echo "<meta name='google-site-verification' content='$googlesiteverify' />";
        }
        wp_head();
        ?>
    </head>
    <body>