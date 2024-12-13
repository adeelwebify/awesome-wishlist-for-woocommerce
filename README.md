# Awesome Wishlist for WooCommerce

## Plugin Description
This WooCommerce Wishlist Plugin allows users to create and manage their wishlist. The plugin is designed with security, usability, and performance in mind, ensuring a smooth experience for both administrators and users.

## Features
- Display a wishlist for logged-in users.
- Render shared wishlists for public viewing.
- Secure and scalable implementation.
- Simple and clean design.

## Upcoming in Next Releases
- Shareable Wishlists
- Allow administrators to control the content and look from backend.

## How To Use Awesome Wishlist Plugin
1. You can use the shortcode `[aws_wishlist_button]` to display ADD TO WISHLIST button inside query loop or single product page.
2. Or alternatively you can create a custom tag i.e. `a`, `button`, with class `aws-wishlist--trigger` and an attribute `data-product-id` with the product id as a value. `i.e. <button class="aws-wishlist--trigger" data-product-id="2">add your desired html here</button>`
3. For a built-in CSS, add `archive` class on button if it's an archive page or a query loop. and `single` class if it's a single product page. 
4. To display the products added to the wishlist. Use the shortcode `[aws_wishlist_table]`.


## Known Limitations
- The plugin does not support guest users for wishlist creation or management.
- Only WooCommerce products are supported in the wishlist.

## Support
For support and feature requests, contact the plugin author via the WordPress plugin repository or email: [contact@muhammadAdeel.net](mailto:contact@muhammadadeel.net).

## For Developers/Contributors
The plugin is free use. You can modify the plugin for personal and commercial use. Contributors are always welcome.

