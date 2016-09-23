<?php
/**
 * Tweaking the scripts output, remove them and enqueue, concatenated and minified
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'sq_et_enqueue_scripts_mod', 30 );

function sq_et_enqueue_scripts_mod() {

    wp_dequeue_script( 'avia-compat' );
    wp_dequeue_script( 'avia-default' );
    wp_dequeue_script( 'avia-shortcodes' );
    wp_dequeue_script( 'avia-popup' );
    wp_dequeue_script( 'wp-mediaelement' );

    wp_register_script( 'enfold-compat', SQ_ET_ASSETS_URL . '/js/avia-compat' . sqms_get_min_suffix() . '.js', array('jquery'));
    wp_register_script( 'enfold-scripts', SQ_ET_ASSETS_URL . '/js/enfold-scripts' . sqms_get_min_suffix() . '.js', array('jquery'), false, true );

    wp_enqueue_script( 'enfold-compat' );
    wp_enqueue_script( 'enfold-scripts' );
    wp_enqueue_script( 'wp-mediaelement' );

}
