<?php

/**
 * Add To Wishlist Functionality
 *
 * @package AWS_WOO_WISHLIST
 */


// Ensure the file is being loaded by WordPress
if ( !defined( 'ABSPATH' ) ) {
  die( 'Hey, what are you doing here, you silly human!' );
}

function aws_add_to_wishlist() {
  
  /**
   * Check the nonce for security
   */
  check_ajax_referer( 'aws-wishlist-nonce' , 'nonce' );
  
  
  /**
   * Return if the user is not logged in and data is not passed in request
   */
  if ( !is_user_logged_in() || !isset( $_POST[ 'product_id' ] ) || !isset( $_POST[ 'action_type' ] ) ) {
    wp_send_json_error( [ 'message' => 'Please Log in to personalize your wishlist!' ] );
    return;
  }
  
  
  /**
   * Get the product ID and action type from the AJAX request
   */
  $product_id = intval( $_POST[ 'product_id' ] );
  $action_type = sanitize_text_field( wp_unslash( $_POST['action_type'] ) ); // ADD or REMOVE
  
  
  /**
   * Get User ID & Wishlist products
   */
  $user_id = get_current_user_id();
  $wishlist = get_user_meta( $user_id , '_aws_wishlist' , true );
  if ( !$wishlist ) {
    $wishlist = [];
  }
  
  
  /**
   * Handle ADD action
   */
  if ( $action_type === 'ADD' ) {
    if ( !in_array( $product_id , $wishlist ) ) {
      $wishlist[] = $product_id;
      update_user_meta( $user_id , '_aws_wishlist' , $wishlist );
      wp_send_json_success( [ 'message' => 'Product added to your wishlist' ] );
    } else {
      wp_send_json_success( [ 'message' => 'Product is already in the wishlist' ] );
    }
    return;
  }
  
  
  /**
   * Handle REMOVE action
   */
  if ( $action_type === 'REMOVE' ) {
    if ( in_array( $product_id , $wishlist ) ) {
      // Remove the product from the wishlist
      $wishlist = array_diff( $wishlist , [ $product_id ] );
      update_user_meta( $user_id , '_aws_wishlist' , $wishlist );
      wp_send_json_success( [ 'message' => 'Product removed from wishlist' ] );
    } else {
      wp_send_json_error( [ 'message' => 'Product not found in the wishlist' ] );
    }
    return;
  }
}


add_action( 'wp_ajax_aws_add_to_wishlist' , 'aws_add_to_wishlist' );
add_action( 'wp_ajax_nopriv_aws_add_to_wishlist' , 'aws_add_to_wishlist' );
