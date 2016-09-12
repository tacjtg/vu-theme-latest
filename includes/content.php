<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_image_size( 'feat-slider', 650, 300, true );
add_editor_style('css/editor-style.css');

// Add secure YouTube oEmbed
wp_oembed_add_provider( '#https://(www\.)?youtube\.com/watch.*#i', 'https://www.youtube.com/oembed', true );

// Add Tags to Pages
add_action( 'init', 'myve_tags_to_pages' );

if( ! function_exists( 'myve_tags_to_pages' ) ) {
	function myve_tags_to_pages() {
		register_taxonomy_for_object_type( 'post_tag', 'page' );
	}
}

// Add thumbnails to RSS feed as enclosures
add_action( 'rss2_item', 'myve_feed_thumbnails' );

if( ! function_exists( 'myve_feed_thumbnails' ) ) {
	function myve_feed_thumbnails() {

		if ( function_exists( 'get_the_image' ) and ( $thumb = get_the_image('format=array&echo=0') ) ) {
			$thumb[0] = $thumb['url'];
		} else if ( function_exists( 'has_post_thumbnail' ) and has_post_thumbnail() ) {
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
		} else if ( function_exists( 'get_post_thumbnail_src' ) ) {
			$thumb = get_post_thumbnail_src();

		if ( preg_match( '|^<img src="([^"]+)"|', $thumb[0], $m ) )
			$thumb[0] = $m[1];
		} else {
			$thumb = false;
		}

		if ( !empty( $thumb ) ) {
			echo "\t" . '<enclosure url="' . $thumb[0] . '" />' . "\n";
		}
	}
}

// Make sure tagged pages show up on those tag archive pages
add_filter( 'request', 'myve_tag_request' );

if( ! function_exists( 'myve_tag_request' ) ) {
	function myve_tag_request($q) {
		if (isset($q['tag']) || isset($q['category_name']))
	                $q['post_type'] = array('post', 'page');
		return $q;
	}
}

// Custom excerpt ellipses for WP2.9+
add_filter( 'excerpt_more', 'myve_excerpt_more_ellipses' );

if( ! function_exists( 'myve_excerpt_more_ellipses' ) ) {
	function myve_excerpt_more_ellipses($more) {
		return '...';
	}
}

// Embed Video Fix
add_filter('the_content', 'myve_add_secure_video', 10);

if( ! function_exists( 'myve_add_secure_video' ) ) {
	function myve_add_secure_video($html) {
		if (strpos($html, "<iframe" ) !== false) {
	    	$search = array('src="http://www.youtu','src="http://youtu');
			$replace = array('src="https://www.youtu','src="https://youtu');
			$html = str_replace($search, $replace, $html);
			return $html;
		} else {
			return $html;
		}
	}
}

// Create Tag Cloud
if( ! function_exists( 'myve_tag_cloud' ) ) {
	function myve_tag_cloud() {
		$smallest = 14;
		$largest = 26;
		$tags = get_tags();
		$counts = array();
		foreach($tags as $key => $tag) {
			if($tag->count < 2) {
				unset($tags[$key]);
			}
		}
		foreach ( (array) $tags as $key => $tag ) {
			$counts[ $key ] = $tag->count;
		}
		$min_count = min($counts);
		$spread = max($counts) - $min_count;
		if ( $spread <= 0 ) {
			$spread = 1;
		}
		$font_spread = $largest - $smallest;
		if ( $font_spread < 0 ) {
			$font_spread = 1;
		}
		$font_step = $font_spread / $spread;
		$html = '<p>';
		foreach($tags as $tag) {
			$html .= '<a href="'. home_url() .'/tag/' . $tag->slug . '/" style="font-size:' . round($smallest + ($tag->count - $min_count) * $font_step) . 'px">' . $tag->name . '</a> ';
		}
		$html .= '</p>';
		return $html;
	}
}

// Create a comma delimited list of post tags for meta
if( ! function_exists( 'myve_csv_post_tags' ) ) {
	function myve_csv_post_tags() {
		$posttags = get_the_tags();
		$csv_tags = '';
		foreach( (array)$posttags as $tag ) {
			$csv_tags .= $tag->name . ',';
		}
		echo '<meta name="keywords" content="'.$csv_tags.', vanderbilt, vanderbilt university, nashville, research, university, news" />';
	}
}

// Breadcrumbs
if( ! function_exists( 'myve_breadcrumbs' ) ) {
	function myve_breadcrumbs() {
	$delimiter = '&raquo;';
	$name = 'Home'; //text for the 'Home' link
	$currentBefore = '<span class="current">';
	$currentAfter = '</span>';

	if ( !is_home() && !is_front_page() || is_paged() ) {
    echo '<p class="crumbs"><small>';
    global $post;
    $home = home_url();
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . 'Archive by category &#39;';
      single_cat_title();
      echo '&#39;' . $currentAfter;
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</small></p>';
  }
}
}

// Right Navigation
if( ! function_exists( 'myve_right_navigation' ) ) {
	function myve_right_navigation() {
		if ( is_front_page() ) {
			echo '<h4>Explore</h4>';
		    $menutype = get_option( 'vubrand_menusource' );
			$whichmenu = get_option( 'vubrand_menuname' );
				if( $menutype=='Manual' ) {
					wp_nav_menu( array( 'container'=>'false', 'menu'=>$whichmenu, 'sort_column' => 'menu_order' ) );
				} else {
					echo '<ul>' . wp_list_pages( 'title_li=&exclude='.$hidethese.'&depth=1' ) . '</ul>';
				}
		} elseif ( is_page() ) {
			myve_right_navigation_child_pages();
		}
	}
}

// Right Navigation Child Pages
if( ! function_exists( 'myve_right_navigation_child_pages' ) ) {
	function myve_right_navigation_child_pages() {
        global $post;
		$hidethese = get_option( 'vubrand_hidepages' );
		if ( $post->post_parent ) {
			$children = wp_list_pages( "title_li=&depth=1&sort_column=menu_order&child_of=" . $post->post_parent . "&echo=0&exclude=" . $hidethese );
			$titlenamer = get_the_title( $post->post_parent );
		} else {
			$children = wp_list_pages( "title_li=&depth=1&sort_column=menu_order&child_of=" . $post->ID . "&echo=0&exclude=" . $hidethese );
			$titlenamer = get_the_title( $post->ID );
		}
		if ( $children ) {
			echo '<h4>' . $titlenamer . '</h4>';
			echo '<ul>' . $children . '</ul>';
		}
	}
}

// News Feed - Newer
if( ! function_exists( 'myve_news_feed' ) ) {
	function myve_news_feed() {
		echo '<div class="rssnews">';
		echo '<h3>' . get_option( 'vubrand_newstitle' ) . '</h3>';

		if ( get_option( 'vubrand_othernewsfeed' ) != "" ) {
			$externalfeed = get_option('vubrand_othernewsfeed');
			// Get RSS Feed(s)
			include_once( ABSPATH . WPINC . '/feed.php' );
			$rss = fetch_feed( $externalfeed );

			if ( !is_wp_error( $rss ) ) {
				$maxitems = $rss->get_item_quantity(6);
				$rss_items = $rss->get_items(0, $maxitems);
			}

			echo '<ul>';

				if ($maxitems == 0) {
					echo '<li>No items to display.</li>';
				} else foreach ( $rss_items as $item ) {
					echo '<li><a href="' . esc_url( $item->get_permalink() ) . '">' . esc_html( $item->get_title() ) . '</a></li>';
				}

			echo '</ul>';

		} else {
			$args = array( 'post_type' => 'post', 'posts_per_page' => '7', );
			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) {

				echo '<ul>';

					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						echo '<li><a class="clearfix" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '&nbsp;<small> &raquo;&nbsp;' . get_the_time('n.j.y') . '</small></a></li>';
					}

				echo '</ul>';
				wp_reset_postdata();

			} else {
				echo '<li>No items to display.</li>';
			}
		}
		echo '</div><!-- /.rssnews -->';
	}
}

// Sidebar Calendar
if( ! function_exists( 'myve_sidebar_calendar' ) ) {
	function myve_sidebar_calendar() {
		echo '<h4>Upcoming Events</h4>';
		echo '<ul>';
		$xslpath = get_stylesheet_directory_uri()."/parse-vu-calendar.xsl";
		$caltag = get_option('vubrand_calendartag');
		$xp = new XSLTProcessor();
		$xsl = new DomDocument;
		// XSL displays date, time and event title
		$xsl->load($xslpath);
		$xp->importStylesheet($xsl);
		$xml_doc = new DomDocument;
		// XML for group of events you want to display -
		$xml_doc->load('https://events.vanderbilt.edu/calendar/rss/3?xtags='.$caltag);
		if ( $html = $xp->transformToXML( $xml_doc ) ) {
			echo $html;
		}
		echo '<li class="more"><a href="http://events.vanderbilt.edu/calendar/list?xtags=' . $caltag . '&tagname=' . bloginfo('name') . 'Events">More events &raquo;</a></li>';
		echo '</ul>';
	}
}

// Page Calendar
if( ! function_exists( 'myve_page_calendar' ) ) {
	function myve_page_calendar() {
		$xslpath = get_stylesheet_directory_uri()."/parse-vu-calendar.xsl";
		$caltag = get_option('vubrand_calendartag');
		$xp = new XsltProcessor();
		$xsl = new DomDocument;
		// XSL displays date, time and event title
		$xsl->load($xslpath);
		$xp->importStylesheet($xsl);
		$xml_doc = new DomDocument;
		// XML for group of events you want to display -
		$xml_doc->load('http://events.vanderbilt.edu/calendar/rss/set/25?xtags='.$caltag);
		if ($html = $xp->transformToXML($xml_doc)) {
			if($html!='') {
				echo "<div class='eventslisting'><ul>";
				echo $html;
				echo "<li class='more'><a href='http://events.vanderbilt.edu/calendar/list?xtags=".$caltag."'>MORE &raquo;</a></li>";
				echo "</ul></div>";
			}
		}
	}
}