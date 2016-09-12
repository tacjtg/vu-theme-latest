<?php
/*
Template Name: PLAIN Page
*/

get_header('plain');

if (have_posts()) :
    while (have_posts()) :
        the_post();

        edit_post_link('<img src=https://www4.vanderbilt.edu/asset/i/editthis.jpg>', '<p>', '</p>');
        the_content('<p class="serif">Read the rest of this page &raquo;</p>');
        wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));

    endwhile;
endif;

wp_footer();
// get theme options Google Analytics Code
$var = get_option('vubrand_ga_code');
echo stripslashes(get_option('vubrand_ga_code'));
?>
</body>
</html>