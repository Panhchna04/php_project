<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php
 // Ensure session is started

// Database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "ecommerce"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$sql = "SELECT * FROM products"; // Adjust table name if necessary
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row; // Store each product in the array
    }
}
$conn->close();

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart_items = $_SESSION['cart'];
$cart_total = array_sum(array_map(function ($item) {
    return $item['price'] * $item['quantity'];
}, $cart_items));

$items = [];
foreach ($cart_items as $index => $item) {
    $items[$index]['name'] = $item['name'];
    $items[$index]['quantity'] = $item['quantity'];
    $items[$index]['price'] = $item['price'];
}
$encoded_items = base64_encode(json_encode($items));

$req_time = time();
$transactionId = time();
$amount = number_format($cart_total, 2, '.', '');
$return_params = "Order Completed";
$payment_option = "abapay";
$type = "purchase";
$currency = "KHR";
$return_url = "https://yourdomain.com/thank-you.php"; // Update this URL
$merchant_id = 'ec449305'; // Your merchant ID
$api_key = 'c3c9dda7b9503335447e818a22095e587a75ee2a'; // Your API key

class PayWayApiCheckout
{
    public static function getHash($str, $api_key)
    {
        return base64_encode(hash_hmac('sha512', $str, $api_key, true));
    }

    public static function getApiUrl()
    {
        return 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase';
    }
}

$hash = PayWayApiCheckout::getHash($req_time . $merchant_id . $transactionId . $amount . $return_params, $api_key);
?>

<div class="container mt-5">
    <h2 class="text-center">Available Products</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?= htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>" />
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text">$<?= number_format($product['price'], 2); ?></p>
                        <button class="btn btn-primary add-to-cart" 
                                data-id="<?= $product['id']; ?>" 
                                data-name="<?= htmlspecialchars($product['name']); ?>" 
                                data-price="<?= $product['price']; ?>">Add to Cart</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h2 class="text-center mt-5">Your Order</h2>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="p-3 border">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="cart_items">
                        <?php foreach ($cart_items as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']); ?></td>
                                <td><?= $item['quantity']; ?></td>
                                <td>$<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><strong>Order Total</strong></td>
                            <td></td>
                            <td><strong id="order_total">$<?= number_format($cart_total, 2); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
                <button id="checkout_button" class="btn btn-primary btn-lg btn-block">Proceed to Payment</button>
            </div>
        </div>
    </div>
</div>

<form method="POST" target="aba_webservice" action="<?= PayWayApiCheckout::getApiUrl(); ?>" id="aba_merchant_request">
    <input type="hidden" name="hash" value="<?= $hash; ?>" />
    <input type="hidden" name="tran_id" value="<?= $transactionId; ?>" />
    <input type="hidden" name="amount" value="<?= $amount; ?>" />
    <input type="hidden" name="items" value="<?= $encoded_items; ?>" />
    <input type="hidden" name="return_params" value="<?= $return_params; ?>" />
    <input type="hidden" name="payment_option" value="<?= $payment_option; ?>" />
    <input type="hidden" name="currency" value="<?= $currency; ?>" />
    <input type="hidden" name="type" value="<?= $type; ?>" />
    <input type="hidden" name="return_url" value="<?= $return_url; ?>" />
    <input type="hidden" name="merchant_id" value="<?= $merchant_id; ?>" />
    <input type="hidden" name="req_time" value="<?= $req_time; ?>" />
</form>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    let cart = <?= json_encode($cart_items); ?>;

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const product = {
                id: this.getAttribute('data-id'),
                name: this.getAttribute('data-name'),
                price: parseFloat(this.getAttribute('data-price')),
                quantity: 1 // Default to 1 for simplicity
            };

            // Check if the product is already in the cart
            const existingProduct = cart.find(item => item.id === product.id);
            if (existingProduct) {
                existingProduct.quantity += 1; // Increment quantity
            } else {
                cart.push(product); // Add new product
            }

            // Update session cart
            $.post('update_cart.php', { cart: cart }, function() {
                updateCartDisplay();
            });
        });
    });

    document.getElementById("checkout_button").addEventListener("click", function() {
        // Update the total amount before submitting
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        document.querySelector('input[name="amount"]').value = total.toFixed(2);
        document.getElementById("aba_merchant_request").submit();
    });

    function updateCartDisplay() {
        const cartItems = document.getElementById('cart_items');
        cartItems.innerHTML = '';
        let total = 0;

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            cartItems.innerHTML += `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>$${itemTotal.toFixed(2)}</td>
                </tr>
            `;
        });

        document.getElementById('order_total').innerText = `$${total.toFixed(2)}`;
    }
</script>

</body>
</html>