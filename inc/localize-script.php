<?php

/**
 * Localize script to pass data
 *
 * @package AWS_WOO_WISHLIST
 */


// Ensure the file is being loaded by WordPress
if ( !defined( 'ABSPATH' ) ) {
  die( 'Hey, what are you doing here, you silly human!' );
}


function aws_localize_script() {
  $is_user_logged_in = is_user_logged_in() ? 1 : 0;
  $user_id = 0;
  $wishlist = [];
  
  if ( $is_user_logged_in ) {
    $user_id = get_current_user_id();
    $wishlist = get_user_meta( $user_id , '_aws_wishlist' , true );
    $wishlist = is_array( $wishlist ) ? $wishlist : [];
  }
  
  wp_localize_script( 'aws-wishlist-script' , 'aws_wishlist_data' , [
    'ajax_url' => admin_url( 'admin-ajax.php' ) ,
    'nonce' => wp_create_nonce( 'aws-wishlist-nonce' ) ,
    'is_user_logged_in' => $is_user_logged_in ,
    'wishlist' => array_values( $wishlist ) ,
  ] );
}

aws_localize_script();
