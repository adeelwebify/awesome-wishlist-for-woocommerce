<?php

/**
 * Enqueue Scripts & Styles
 *
 * @package AWS_WOO_WISHLIST
 */


// Ensure the file is being loaded by WordPress
if ( !defined( 'ABSPATH' ) ) {
  die( 'Hey, what are you doing here, you silly human!' );
}

function aws_enqueue_scripts() {
  
  // CSS
  wp_enqueue_style( 'aws-wishlist-style' , AWS_PLUGIN_URL . 'dist/style.css' , [] , AWS_VERSION );
  
  // JS
  wp_enqueue_script( 'aws-wishlist-script' , AWS_PLUGIN_URL . 'dist/main.js' , [ 'jquery' ] , AWS_VERSION , true );
  
  // Localize script
  require_once AWS_PLUGIN_DIR . 'inc/localize-script.php';
}


add_action( 'wp_enqueue_scripts' , 'aws_enqueue_scripts' );
