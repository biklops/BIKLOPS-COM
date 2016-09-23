<?php
/**
 * Plugin Name: Enfold Tweaks
 * Plugin URL: https://github.com/thatryan/enfold-tweaks
 * Description: A plugin to tweak the Enfold theme a bit more to my liking. Current supported Enfold version 3.7.1
 * Version: 1.2.5
 * Author: Ryan Olson
 * Author URI: http://thatryan.com
 * Text Domain: enfold-tweaks
*/

define( 'SQ_ET_ASSETS_URL', plugin_dir_url( __FILE__ ) . 'assets' ) ;

require_once dirname( __FILE__ ) . '/includes/head.php';
require_once dirname( __FILE__ ) . '/includes/styles.php';
require_once dirname( __FILE__ ) . '/includes/scripts.php';

// Remove layer slider, we do not use
add_theme_support('deactivate_layerslider');

// Remove cookie session set by theme
add_theme_support('avia_no_session_support');

// Remove query string parameters
function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

// Alter the blog image sizings
add_filter( 'avf_modify_thumb_size', 'sqms_alter_blog_img_size' );

function sqms_alter_blog_img_size( $avia_config ) {

  $avia_config['imgSize']['entry_with_sidebar']   = array('width'=>845, 'height'=>321, 'crop' => false);
  $avia_config['imgSize']['entry_without_sidebar']= array('width'=>1210, 'height'=>423, 'crop' => false );

  return $avia_config['imgSize'];

}

function sqms_get_min_suffix() {
	return defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
}
