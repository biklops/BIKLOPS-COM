<?php
/**
 * Tweaking the styles output as this theme dumps way too many into the head
 * we will remove them all, and enqueue our own, concatenated and minified
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Allow classes on all elements
add_theme_support( 'avia_template_builder_custom_css' );

add_action( 'wp_enqueue_scripts', 'sq_et_enqueue_styles_mod', 20 );

function sq_et_enqueue_styles_mod() {

    wp_dequeue_style( 'avia-style' );
    wp_dequeue_style( 'avia-custom' );
    wp_dequeue_style( 'avia-dynamic' );

    wp_dequeue_style( 'avia-base' );
    wp_dequeue_style( 'avia-grid' );
    wp_dequeue_style( 'avia-layout' );
    wp_dequeue_style( 'avia-print' );
    wp_dequeue_style( 'avia-scs' );
    wp_dequeue_style( 'avia-popup-css' );
    wp_dequeue_style( 'avia-media' );
    wp_dequeue_style( 'avia-gravity' );

    wp_register_style( 'enfold-styles', SQ_ET_ASSETS_URL . '/css/enfold-styles' . sqms_get_min_suffix() . '.css' );
    wp_register_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' );
    wp_register_style( 'print-tweaks' ,  SQ_ET_ASSETS_URL . '/css/print' . sqms_get_min_suffix() . '.css', array(), false, 'print' );

    wp_enqueue_style( 'enfold-styles' );
    wp_enqueue_style( 'avia-dynamic' );
    wp_enqueue_style( 'child-style' );
    wp_enqueue_style( 'print-tweaks' );

}
