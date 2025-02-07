import Toastify from 'toastify-js';

window.aws_wishlist_init = () => {

	// Select all buttons
	let buttons = document.querySelectorAll('.aws-wishlist--trigger');

	// Loop through each button and set 'data-is-initialized' and 'data-type' attributes
	buttons.forEach(button => {

		// Skip if already initialized
		if (button.getAttribute('data-is-initialized') === 'YES') return;

		let productId = button.getAttribute('data-product-id');

		// Check if the product is already in the wishlist
		if (aws_wishlist_data.wishlist.includes(+productId)) {
			button.setAttribute('data-type', 'REMOVE');
			button.classList.add('active');

			if (button.querySelector('span')) {
				button.querySelector('span').textContent = "Remove from wishlist";
			}
		} else {
			button.setAttribute('data-type', 'ADD');
		}

		// Mark as initialized to avoid duplicate event listeners
		button.setAttribute('data-is-initialized', 'YES');
	});
};


function AwsAddToWishlist(button, productId, actionType) {
	jQuery.ajax({
		url: aws_wishlist_data.ajax_url,
		type: 'POST',
		data: {
			action: 'aws_add_to_wishlist',
			product_id: productId,
			action_type: actionType,
			nonce: aws_wishlist_data.nonce
		},
		success: (response) => {
			if (response.success) {

				if (actionType === 'ADD') {
					button.setAttribute('data-type', 'REMOVE')
					// Add the productId in the wishlist array (the array provided by WordPress)
					window.aws_wishlist_data.wishlist.push(productId)
				} else {
					button.setAttribute('data-type', 'ADD')
					// Remove the productId from the wishlist array (the array provided by WordPress)
					window.aws_wishlist_data.wishlist = window.aws_wishlist_data.wishlist.filter(id => id !== productId);
				}

				button.classList.toggle('active', actionType === 'ADD');

				Toastify({
					text: response.data.message,
					duration: 3000,
					close: true,
					gravity: "top",
					position: "center",
					stopOnFocus: true,
					style: {
						background: "linear-gradient(to right, #069234, #09b53f)",
					},
				}).showToast();

				// Change Button Text
				const span = button.querySelector('span');
				if (span) {
					span.textContent = actionType === "ADD" ? "Remove from wishlist" : "Add to wishlist";
				}

				button.closest('tr')?.remove();

			} else {
				Toastify({
					text: response.data.message,
					duration: 3000,
					close: true,
					gravity: "top",
					position: "center",
					stopOnFocus: true,
					style: {
						background: "linear-gradient(to right, rgb(246, 50, 68), rgb(243, 111, 54))",
					},
				}).showToast();

				console.error('AWS_WISHLIST_ERROR:', response.data.message);
			}
		}
	});
}

// Event delegation to handle clicks efficiently
document.body.addEventListener('click', function (event) {
	let button = event.target.closest('.aws-wishlist--trigger');
	if (!button) return;

	// Ensure wishlist buttons are properly initialized before proceeding
	if (!button.hasAttribute('data-is-initialized')) {
		aws_wishlist_init();
	}

	// Fetch attributes AFTER ensuring initialization
	let productId = button.getAttribute('data-product-id');
	let actionType = button.getAttribute('data-type');

	// Safety check
	if (!productId || !actionType) {
		Toastify({
			text: "Something went wrong.",
			duration: 3000,
			close: true,
			gravity: "top",
			position: "center",
			stopOnFocus: true,
			style: {
				background: "linear-gradient(to right, rgb(246, 50, 68), rgb(243, 111, 54))",
			},
		}).showToast();
		return;
	}

	AwsAddToWishlist(button, productId, actionType);
});



// Run the init() function on initial render
document.addEventListener('DOMContentLoaded', aws_wishlist_init);
