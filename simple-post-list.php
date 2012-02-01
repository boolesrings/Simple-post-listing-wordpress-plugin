<?php
/*
 * Plugin Name: Simple post list
 * Description: List a subset of your posts using the shortcode [posts].
 * Version: 0.0
 * Author: Samuel Coskey
 * Author URI: http://boolesrings.org
*/

/*
 * The shortcode which shows a list of future events.
 * Usage example:
 * [posts category_name="talks" text="excerpt"]
*/
add_shortcode( 'posts', 'posts_loop' );

function posts_loop( $atts ) {
	global $more;
	global $post;

	// Arguments to the shortcode
	extract( shortcode_atts(  array(
        	'category_name' => '',
		'style' => 'list',
		'text' => 'none',
		'null_text' => '(none)',
		'class_name' => '',
	), $atts ) );

	if ( $style != "list" && $style != "post" ) {
		$style = "list";
	}
	if ( $text != "none" && $text != "excerpt" && $text != "normal" ) {
		$text = "none";
	}

	/*
	 * query the database for the posts with EventDate in the future
	 * query syntax: http://codex.wordpress.org/Class_Reference/WP_Query#Parameters
	*/
	$query = "";
	if ( $category_name ) {
		$query .= "category_name=" . $category_name . '&';
	}
	$query .= 'ignore_sticky_posts=1&nopaging=true';
	$query_results = new WP_Query($query);

	if ( $query_results->post_count ==0 ) {
		return "<p>" . wp_kses($null_text,array()) . "</p>\n";
	}
	
	// building the output
	$ret_val = "<ul class='post-list post-list-$style";
	if ( $class_name ) {
		$ret_val .= " " . $class_name;
	}
	$ret_val .= "'>\n";
	while ( $query_results->have_posts() ) {
		$query_results->the_post();
		$ret_val .= "<li class='";
		foreach((get_the_category()) as $category) {
			$ret_val .= "category-" . $category->slug . " ";
		}
		$ret_val .= "'>";
		if ( $style == "post" ) {
			$ret_val .= "<h2 class='post-list-entry-title'>";
		}
		$ret_val .= "<a href='" . get_permalink() . "'>";
		$ret_val .= the_title( '', '', false);
		$ret_val .= "</a>";
		if ( $style == "post" ) {
			$ret_val .= "</h2>";
		}
		$ret_val .= "\n";
		if ( $text == "excerpt" ) {
			$ret_val .= "<div>\n";
			$ret_val .= get_the_excerpt();
			$ret_val .= "</div>\n";			
		} elseif ( $text == "normal" ) {
			$ret_val .= "<div>\n";
			$more = 0; // Tell wordpress to respect the [more] tag for the next line:
			$ret_val .= apply_filters( 'the_content', get_the_content("") );
			$ret_val .= "</div>\n";
		}
		$ret_val .= "</li>";
	}
	wp_reset_postdata();
	$ret_val .= "</ul>";

	return $ret_val;
}

/*
 * Load our default style sheet
*/
add_action( 'wp_print_styles', 'enqueue_post_list_styles' );
function enqueue_post_list_styles() {
	wp_register_style( 'simple-post-list-styles',
			plugins_url('simple-post-list-styles.css', __FILE__) );
	wp_enqueue_style( 'simple-post-list-styles' );
}

?>