<?php

/**
 * Single Product Page Shortcode
 *
 * @package AWS_WOO_WISHLIST
 */


// Ensure the file is being loaded by WordPress
if (!defined('ABSPATH')) {
  die('Hey, what are you doing here, you silly human!');
}


/**
 * Shortcode to display a wishlist button on the single product page.
 */
function aws_single_product_wishlist_button(): string {
  global $post, $wp_query;

  // Ensure it's a product
  if (get_post_type($post) !== 'product') {
    return '';
  }

  $product_id = $post->ID;

  // Check if this product is the main queried product or a related product
  $is_main_product = is_singular('product') && isset($wp_query->post) && $wp_query->post->ID === $product_id;

  // Assign class based on whether it's the main product or a related product
  $class = $is_main_product ? 'single' : 'archive';

  return sprintf(
    '<a href="#" class="aws-wishlist--trigger %s" data-product-id="%d">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"></path>
          </svg>
          <span>Add to Wishlist</span>
      </a>',
    esc_attr($class),
    esc_attr($product_id)
  );
}

add_shortcode('aws_wishlist_button', 'aws_single_product_wishlist_button');
