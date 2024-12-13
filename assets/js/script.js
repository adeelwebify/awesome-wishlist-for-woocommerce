import Toastify from 'toastify-js'

window.aws_wishlist_init = () => {
  
  let buttons = document.querySelectorAll('.aws-wishlist--trigger');
  console.log('All Buttons:', buttons)
  buttons.forEach(button => {
    let productId = button.getAttribute('data-product-id');
    
    // Check if the product is already in the wishlist
    if (aws_wishlist_data.wishlist.includes(+productId)) {
      
      button.setAttribute('data-type', 'REMOVE')
      button.classList.add('active');
      
      if(button.querySelector('span')) {
        button.querySelector('span').textContent = "Remove from wishlist"
      }
      
    } else {
      button.setAttribute('data-type', 'ADD')
    }
    
    function buttonClickHandler() {
      // Send AJAX request to add product to the wishlist
      let actionType = button.getAttribute('data-type');
      AwsAddToWishlist(button, productId, actionType);
    }
    
    if (button.getAttribute('data-is-initialized') !== 'YES') {
      button.addEventListener('click', buttonClickHandler);
      button.setAttribute('data-is-initialized', 'YES');
    }
    
  });
}

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
        button.setAttribute('data-type', actionType === 'ADD' ? 'REMOVE' : 'ADD');
        button.classList.toggle('active', actionType === 'ADD');
        
        Toastify({
          text: response.data.message,
          duration: 3000,
          close: true,
          gravity: "top", // `top` or `bottom`
          position: "center", // `left`, `center` or `right`
          stopOnFocus: true, // Prevents dismissing of toast on hover
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
          gravity: "top", // `top` or `bottom`
          position: "center", // `left`, `center` or `right`
          stopOnFocus: true, // Prevents dismissing of toast on hover
          style: {
            background: "linear-gradient(to right, rgb(246, 50, 68), rgb(243, 111, 54))",
          },
        }).showToast();
        
        console.error('AWS_WISHLIST_ERROR:', response.data.message);
      }
    }
  });
}


/**
 * Run the init() function on initial render
 */
document.addEventListener('DOMContentLoaded', aws_wishlist_init);