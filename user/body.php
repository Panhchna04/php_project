<!-- end breadcrumb section -->
<?php include 'function.php'; ?>
<!-- products -->
<div class="container mt-4">
    <h2 class="text-center">Our Fruits</h2>
    <div class="row">
        <?php get_data(); ?>
    </div>
</div>

<?php include 'modal.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    let cart = [];

    // Add to cart function
    $('.add-cart').on('click', function() {
        const title = $(this).data('title');
        const price = parseFloat($(this).data('price'));
        cart.push({ title, price });
        updateCart();
        alert(`${title} has been added to your cart.`);
    });

    // Update cart display
    function updateCart() {
        $('#cartItems').empty();
        let total = 0;
        cart.forEach(item => {
            $('#cartItems').append(`
                <tr>
                    <td>${item.title}</td>
                    <td>$${item.price.toFixed(2)}</td>
                </tr>
            `);
            total += item.price;
        });
        $('#totalPrice').text(total.toFixed(2));
        $('#cartCount').text(cart.length);
    }

    // Function to handle checkout with Payway
    async function checkout() {
        try {
            // Gather payment information
            const cardNumber = $('#cardNumber').val();
            const expiryDate = $('#expiryDate').val();
            const cvv = $('#cvv').val();
            const totalAmount = cart.reduce((total, item) => total + item.price, 0);
            
            // Encrypt card details
            const encryptedCardNumber = encryptor.encrypt(cardNumber);
            const encryptedExpiryDate = encryptor.encrypt(expiryDate);
            const encryptedCVV = encryptor.encrypt(cvv);

            // Prepare encrypted payment data
            const paymentData = {
                merchantId: 'ec449375', // Your Merchant ID
                cardNumber: encryptedCardNumber,
                expiryDate: encryptedExpiryDate,
                cvv: encryptedCVV,
                amount: totalAmount.toFixed(2) // Amount to charge
            };

            // Make API call to Payway
            const response = await fetch('https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer 81d770573fef1ab4f7468d04a8c31b4f3617172b' // Your API key
                },
                body: JSON.stringify(paymentData)
            });

            // Check response
            if (!response.ok) {
                throw new Error('Payment processing failed');
            }

            const result = await response.json();
            if (result.success) {
                alert('Payment successful! Thank you for your purchase.');
                $('#checkoutModal').modal('hide');
                cart = []; // Clear cart
                updateCart(); // Update cart display
            } else {
                alert('Payment failed: ' + result.message);
            }
        } catch (error) {
            console.error('Error during checkout:', error);
            alert('An error occurred during checkout. Please try again.');
        }
    }

    // Event listener for checkout form submission
    $('#checkoutForm').on('submit', function (e) {
        e.preventDefault();
        checkout(); // Call the checkout function
    });
    
    // Assuming you have included a library like JSEncrypt
    const encryptor = new JSEncrypt();
    encryptor.setPublicKey(`-----BEGIN PUBLIC KEY-----
    MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCQc4SCaDiB+YEFKEFrVH9WALRe
    pN8AsrdTOGW4ENZyCfBeFHieMgLaHSJqqBMuYcckBu5xZxf73sZzkahKoSqfJtKw
    viEYYD/TJxVH02FLs9bsP15J0M/QK/ubvTlAkc39bPS3fDCdyTCwhBl37PzIPkye
    thDSI9brQzjenNknpwIDAQAB
    -----END PUBLIC KEY-----`);
</script>