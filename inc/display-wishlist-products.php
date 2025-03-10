<?php

/**
 * Display wishlist products
 *
 * @package AWS_WOO_WISHLIST
 */

// Ensure the file is being loaded by WordPress
if ( !defined( 'ABSPATH' ) ) {
  die( 'Hey, what are you doing here, you silly human!' );
}

function aws_display_wishlist() {
  // Ensure the user is logged in
  if ( !is_user_logged_in() ) {
    return '<p class="aws-wishlist--not-login">' . esc_html__( 'You need to log in to view your wishlist.' , AWS_TEXT_DOMAIN ) . '</p>';
  }
  
  $user_id = get_current_user_id();
  $wishlist = get_user_meta( $user_id , '_aws_wishlist' , true );
  
  if ( empty( $wishlist ) ) {
    return '<p class="aws-wishlist--empty">' . esc_html__( 'Your wishlist is empty.' , AWS_TEXT_DOMAIN ) . '</p>';
  }
  
  // Start output buffering
  ob_start();
  
  // Begin the table
  echo '<table class="aws-wishlist--table" cellspacing="0" cellpadding="0">';
  echo '<thead>
            <tr>
                <th></th>
                <th>' . esc_html__( 'Product Title' , AWS_TEXT_DOMAIN ) . '</th>
                <th>' . esc_html__( 'Price' , AWS_TEXT_DOMAIN ) . '</th>
                <th>' . esc_html__( 'Stock Status' , AWS_TEXT_DOMAIN ) . '</th>
                <th>' . esc_html__( 'Action' , AWS_TEXT_DOMAIN ) . '</th>
            </tr>
        </thead>
        <tbody>';
  
  // Loop through each product in the wishlist
  foreach ( $wishlist as $product_id ) {
    $product = wc_get_product( $product_id );
    
    if ( $product ) {
      $product_url = esc_url( $product->get_permalink() );
      $product_image = $product->get_image();
      $product_title = esc_html( $product->get_name() );
      $product_price = wp_kses_post( $product->get_price_html() );
      $stock_status = $product->is_in_stock() ? esc_html__( 'In stock' , AWS_TEXT_DOMAIN ) : esc_html__( 'Out of stock' , AWS_TEXT_DOMAIN );
      
      // Display the product information
      echo '<tr>
                    <td class="aws-wishlist--img">
                        <span class="remove-product wishlist-page aws-wishlist--trigger" data-product-id="' . esc_attr( $product_id ) . '">
                            <svg width="22px" height="22px" class="cross-svg" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                              <g id="SVGRepo_iconCarrier"> <path d="M6.96967 16.4697C6.67678 16.7626 6.67678 17.2374 6.96967 17.5303C7.26256 17.8232 7.73744 17.8232 8.03033 17.5303L6.96967 16.4697ZM13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697L13.0303 12.5303ZM11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303L11.9697 11.4697ZM18.0303 7.53033C18.3232 7.23744 18.3232 6.76256 18.0303 6.46967C17.7374 6.17678 17.2626 6.17678 16.9697 6.46967L18.0303 7.53033ZM13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303L13.0303 11.4697ZM16.9697 17.5303C17.2626 17.8232 17.7374 17.8232 18.0303 17.5303C18.3232 17.2374 18.3232 16.7626 18.0303 16.4697L16.9697 17.5303ZM11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697L11.9697 12.5303ZM8.03033 6.46967C7.73744 6.17678 7.26256 6.17678 6.96967 6.46967C6.67678 6.76256 6.67678 7.23744 6.96967 7.53033L8.03033 6.46967ZM8.03033 17.5303L13.0303 12.5303L11.9697 11.4697L6.96967 16.4697L8.03033 17.5303ZM13.0303 12.5303L18.0303 7.53033L16.9697 6.46967L11.9697 11.4697L13.0303 12.5303ZM11.9697 12.5303L16.9697 17.5303L18.0303 16.4697L13.0303 11.4697L11.9697 12.5303ZM13.0303 11.4697L8.03033 6.46967L6.96967 7.53033L11.9697 12.5303L13.0303 11.4697Z" fill="#000000"/> </g>
                            </svg>
                        </span>
                        ' . $product_image . '
                    </td>
                    <td class="aws-wishlist--title">
                        <span class="aws-wishlist--label">' . esc_html__( 'Product:' , AWS_TEXT_DOMAIN ) . '</span>
                        <h3>
                            <a href="' . $product_url . '">' . $product_title . '</a>
                        </h3>
                    </td>
                    <td class="aws-wishlist--price">
                        <span class="aws-wishlist--label">' . esc_html__( 'Price:' , AWS_TEXT_DOMAIN ) . '</span>
                        <span>' . $product_price . '</span>
                    </td>
                    <td class="aws-wishlist--stock">
                        <span class="aws-wishlist--label">' . esc_html__( 'Stock:' , AWS_TEXT_DOMAIN ) . '</span>' . $stock_status . '
                    </td>
                    <td class="aws-wishlist--add-to-cart">
                        <a href="?add-to-cart=' . esc_attr( $product_id ) . '"
                           data-quantity="1"
                           class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                           data-product_id="' . esc_attr( $product_id ) . '"
                           aria-label="' . sprintf( esc_html__( 'Add %s to your cart' , AWS_TEXT_DOMAIN ) , $product_title ) . '"
                           rel="nofollow">
                            <span>' . esc_html__( 'Add To Cart' , AWS_TEXT_DOMAIN ) . '</span>
                        </a>
                    </td>
                </tr>';
    }
  }
  
  echo '</tbody></table>';
  
  // Return the output
  return ob_get_clean();
}

// Register the shortcode
add_shortcode( 'aws_wishlist_table' , 'aws_display_wishlist' );
