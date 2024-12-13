<?php
/*
* Plugin Name:       Awesome Wishlist For WooCommerce
* Description:       Enable wishlist for your wooCommerce store.
* Plugin URI:        https://muhammadadeel.net/awesome-wishlist-plugin/
* Version:           1.0
* Requires at least: 6.0
* Requires PHP:      8.0
* Author:            Muhammad Adeel
* Author URI:        https://muhammadadeel.net/
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:       AWS_WOO_WISHLIST
* Domain Path:       /languages
* Requires Plugins:  woocommerce
*/

/**
 * GNU GENERAL PUBLIC LICENSE
 * Version 2, June 1991
 *
 * Copyright (C) 2024 Awesome Wishlist For WooCommerce
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * ---
 *
 * ## How to Apply These Terms to Your Program
 *
 * When you distribute your program, include a copyright notice stating
 * that it is released under this License. Add the full text of this
 * license to the program, or include a notice saying where to find the
 * full text. Also include information about where to obtain the source
 * code. If you are distributing your program in a way that does not
 * include a physical copy, you must make the source code available.
 *
 * For detailed instructions on how to apply the GPL to your program,
 * see the GNU website at <https://www.gnu.org/licenses/>.
 */

// Ensure the file is being loaded by WordPress
if ( !defined( 'ABSPATH' ) ) {
  die( 'Hey, what are you doing here, you silly human!' );
}


/**
 * Create reusable constants
 */

if ( !defined( 'AWS_PLUGIN_DIR' ) ) {
  define( 'AWS_PLUGIN_DIR' , plugin_dir_path( __FILE__ ) );
}

if ( !defined( 'AWS_PLUGIN_URL' ) ) {
  define( 'AWS_PLUGIN_URL' , plugin_dir_url( __FILE__ ) );
}

if ( !defined( 'AWS_VERSION' ) ) {
//  $version = rand(1111, 9999); // For development purpose
  $version = '1.0';
  define( 'AWS_VERSION' , $version );
}

if ( !defined( 'AWS_TEXT_DOMAIN' ) ) {
  define( 'AWS_TEXT_DOMAIN' , 'AWS_WOO_WISHLIST' );
}


/**
 * Enqueue files
 */
require_once AWS_PLUGIN_DIR . 'inc/enqueue-scripts.php';
require_once AWS_PLUGIN_DIR . 'inc/add-to-wishlist.php';
require_once AWS_PLUGIN_DIR . 'inc/display-wishlist-products.php';

/**
 * Shortcode files
 */
require_once AWS_PLUGIN_DIR . 'shortcodes/shortcode-add-to-wishlist.php';