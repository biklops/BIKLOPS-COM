<?php
/**
 * Actions to edit the WordPress head
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Define actions to be added or removed

add_action( 'init','sq_et_remove_debug' );
add_action( 'wp_default_scripts', 'sq_et_dequeue_jquery_migrate' );
add_action( 'after_setup_theme', '_test_remove_link' );

remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Define filters

// add_filter( 'the_generator', 'sq_et_hide_wp_version' );
add_filter('show_recent_comments_widget_style', '__return_false');


// Define function for above actions and filters

function sq_et_remove_debug() {
	remove_action( 'wp_head','avia_debugging_info', 1000 );
	remove_action( 'admin_print_scripts','avia_debugging_info', 1000 );
}

function sq_et_hide_wp_version() {
	return '';
}

function _test_remove_link() {
    remove_action( 'wp_head', 'avia_set_pingback_tag', 10, 0 );
}

function sq_et_dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$jquery_dependencies = $scripts->registered['jquery']->deps;
		$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
	}
}
