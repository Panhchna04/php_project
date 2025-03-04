<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fruitkha</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .cart {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>

<!-- header -->
<?php include 'header.php'; ?>
<!-- end header -->

<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Fresh & Organic</p>
                        <h1>Delicious Seasonal Fruits</h1>
                        <div class="hero-btns">
                            <a href="shop.php" class="boxed-btn">Fruit Collection</a>
                            <a href="contact.php" class="bordered-btn">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<!-- Product Section -->
<div class="container mt-4">
    <h2 class="text-center">Our Fruits</h2>
    <div class="row">
        <div class="col-md-4" data-title="Strawberry" data-price="85">
            <div class="card mb-4 shadow-sm">
                <img src="assets/img/products/product-img-1.jpg" class="card-img-top" alt="Strawberry">
                <div class="card-body">
                    <h5 class="card-title">Strawberry</h5>
                    <p class="card-text"><span>Per Kg</span> 85$</p>
                   
                </div>
            </div>
        </div>
        <div class="col-md-4" data-title="Berry" data-price="70">
            <div class="card mb-4 shadow-sm">
                <img src="assets/img/products/product-img-2.jpg" class="card-img-top" alt="Berry">
                <div class="card-body">
                    <h5 class="card-title">Berry</h5>
                    <p class="card-text"><span>Per Kg</span> 70$</p>
                   
                </div>
            </div>
        </div>
        <div class="col-md-4" data-title="Lemon" data-price="35">
            <div class="card mb-4 shadow-sm">
                <img src="assets/img/products/product-img-3.jpg" class="card-img-top" alt="Lemon">
                <div class="card-body">
                    <h5 class="card-title">Lemon</h5>
                    <p class="card-text"><span>Per Kg</span> 35$</p>
                   
                </div>
            </div>
        </div>
        <div class="col-md-4" data-title="Avocado" data-price="50">
            <div class="card mb-4 shadow-sm">
                <img src="assets/img/products/product-img-4.jpg" class="card-img-top" alt="Avocado">
                <div class="card-body">
                    <h5 class="card-title">Avocado</h5>
                    <p class="card-text"><span>Per Kg</span> 50$</p>
                   
                </div>
            </div>
        </div>
        <div class="col-md-4" data-title="Green Apple" data-price="45">
            <div class="card mb-4 shadow-sm">
                <img src="assets/img/products/product-img-5.jpg" class="card-img-top" alt="Green Apple">
                <div class="card-body">
                    <h5 class="card-title">Green Apple</h5>
                    <p class="card-text"><span>Per Kg</span> 45$</p>
                   
                </div>
            </div>
        </div>
        <div class="col-md-4" data-title="Strawberry" data-price="60">
            <div class="card mb-4 shadow-sm">
                <img src="assets/img/products/product-img-6.jpg" class="card-img-top" alt="Strawberry">
                <div class="card-body">
                    <h5 class="card-title">Strawberry</h5>
                    <p class="card-text"><span>Per Kg</span> 80$</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>

<!-- Cart Modal -->
<?php include 'modal.php'; ?>

<!-- Scripts -->
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

    // Checkout function
    function checkout() {
        alert('Thank you for shopping with us!');
        // Implement checkout logic here
    }
</script>

</body>
</html>