<?php

function ava_image_sizes() { 
  remove_image_size('masonry');
}

add_action( 'after_setup_theme', 'ava_image_sizes', 1 );