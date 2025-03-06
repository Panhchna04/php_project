<?php
	$current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
	.active {
  	background-color:rgba(240, 240, 240, 0.23); /* Optional: background color for active item */
}
</style>

<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <div class="site-logo">
                        <a href="index.php">
                            <img src="assets/img/logo.png" alt="">
                        </a>
                    </div>
                    <nav class="main-menu">
                        <ul>
                        <li class="<?php echo $current_page == 'index.php' ? 'active bg' : ''; ?>"><a href="index.php">Home</a></li>
                            <li class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>"><a href="about.php">About</a></li>
                            <li class="<?php echo $current_page == 'shop.php' ? 'active' : ''; ?>"><a href="shop.php">Shop</a></li>
                            <li class="<?php echo $current_page == 'contact.php' ? 'active' : ''; ?>"><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the cart count from localStorage or initialize it
    let cartCount = localStorage.getItem('cartCount') || 0;
    document.getElementById('cartCount').textContent = cartCount;
    
    // Add click event for cart button
    document.getElementById('cartButton').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default link behavior
        $('#cartModal').modal('show'); // Show the cart modal using Bootstrap
    });
    
    // Function to add to cart without page refresh
    window.addToCart = function(productId) {
        // Prevent default form submission behavior if called from a form
        event.preventDefault();
        
        // Increment cart count
        cartCount = parseInt(cartCount) + 1;
        
        // Update display
        document.getElementById('cartCount').textContent = cartCount;
        
        // Save to localStorage
        localStorage.setItem('cartCount', cartCount);
        
        // You can add AJAX call here to update server-side cart
        // Example:
        /*
        fetch('add-to-cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ productId: productId })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
        */
        
        // Optional: Show a confirmation message
        const confirmMessage = document.createElement('div');
        confirmMessage.textContent = 'Product added to cart!';
        confirmMessage.className = 'add-to-cart-confirm';
        confirmMessage.style.position = 'fixed';
        confirmMessage.style.top = '20px';
        confirmMessage.style.right = '20px';
        confirmMessage.style.padding = '10px 15px';
        confirmMessage.style.backgroundColor = '#4CAF50';
        confirmMessage.style.color = 'white';
        confirmMessage.style.borderRadius = '5px';
        confirmMessage.style.zIndex = '1000';
        document.body.appendChild(confirmMessage);
        
        setTimeout(() => {
            confirmMessage.remove();
        }, 2000);
        
        return false; // Prevent form submission
    }
});
</script>