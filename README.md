# Awesome Wishlist Form WooCommerce

A lightweight and efficient wishlist plugin for WooCommerce. Allows logged-in users to add and manage their favorite products in a wishlist. The plugin is optimized for performance and works seamlessly with any WordPress theme or page builder.

## Features

- Add/Remove products from the wishlist with AJAX.
- Works with any WordPress stack.
- Uses event delegation for better compatibility with pagination and dynamic content.
- Wishlist is stored per user and requires login.
- Shortcodes for easy integration:
  - `[aws_wishlist_button]` – Displays the wishlist button on product pages.
  - `[aws_wishlist_table]` – Displays the user's wishlist table.
- Optimized and lightweight JavaScript implementation.

## Installation

1. Download or clone the repository.
2. Upload the plugin folder to `/wp-content/plugins/`.
3. Activate the plugin through the WordPress Admin Dashboard (`Plugins > Installed Plugins`).
4. Use the shortcodes where needed.

## Shortcodes

### Wishlist Button
```php
[aws_wishlist_button]
```
Displays a wishlist button on the product page. Works on single products and archive pages.

### Wishlist Table
```php
[aws_wishlist_table]
```
Displays the logged-in user's wishlist in a tabular format.

## How It Works

1. Users can click the **wishlist button** to add or remove a product.
2. Wishlist data is stored in the user meta.
3. The wishlist table shortcode dynamically pulls all wishlist items for the logged-in user.
4. The plugin utilizes **AJAX** for seamless user experience.
5. **Event delegation** ensures the wishlist buttons work even after pagination or AJAX-based content updates.

## Compatibility

- WordPress 6.0+
- WooCommerce 6.0+
- Works with any theme and page builder (Elementor, WPBakery, Gutenberg, GridBuilder, Bricks Builder, etc.)

## Contributing

1. Fork the repository.
2. Create a new branch (`feature-xyz` or `fix-abc`).
3. Commit your changes with clear messages.
4. Submit a pull request.

## License

This plugin is open-source and distributed under the **MIT License**.

## Credits

Developed by [Muhammad Adeel](https://github.com/adeelwebify).

## Support

For issues or feature requests, open an issue in the GitHub repository. or contact via email [adeelwebify@gmail.com](mailto:adeelwebify@gmail.com)

