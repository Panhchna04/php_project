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
if (!isset($_SESSION)) {
    session_start();
}

// PayWay constants and helper class
define('ABA_PAYWAY_API_URL', 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase');
define('ABA_PAYWAY_API_KEY', 'c3c9dda7b9503335447e818a22095e587a75ee2a');
define('ABA_PAYWAY_MERCHANT_ID', 'ec449305');

class PayWayApiCheckout
{
    public static function getHash($str)
    {
        return base64_encode(hash_hmac('sha512', $str, ABA_PAYWAY_API_KEY, true));
    }

    public static function getApiUrl()
    {
        return ABA_PAYWAY_API_URL;
    }
}

// Cart data
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
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
$return_url = "https://yourdomain.com/thank-you.php";
$merchant_id = ABA_PAYWAY_MERCHANT_ID;

$hash = PayWayApiCheckout::getHash($req_time . $merchant_id . $transactionId . $amount . $return_params);
?>

<div class="container mt-5">
    <h2 class="text-center">Your Order</h2>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="p-3 border">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_items as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']); ?> x <?= $item['quantity']; ?></td>
                                <td>$<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><strong>Order Total</strong></td>
                            <td><strong>$<?= number_format($cart_total, 2); ?></strong></td>
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
<script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>
<script>
    document.getElementById("checkout_button").addEventListener("click", function() {
        AbaPayway.checkout();
    });

    // Update cart dynamically (if needed)
    let cart = <?= json_encode($cart_items); ?>;
    function updateCart() {
        let total = 0;
        cart.forEach(item => {
            total += item.price * item.quantity;
        });
        console.log("Cart total:", total);
    }
</script>

</body>
</html>