<?php
$con = new mysqli('localhost', 'root', '', 'ecommerce');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

function log_error($error) {
    file_put_contents('error_log.txt', date('Y-m-d H:i:s') . " - " . $error . "\n", FILE_APPEND);
}

function get_data() {
    global $con;
    try {
        $sql = "SELECT * FROM `products` ORDER BY id DESC";
        $rs = $con->query($sql);

        if (!$rs) {
            throw new Exception("Database query failed: " . $con->error);
        }

        while ($row = mysqli_fetch_assoc($rs)) {
            
          
            echo '
                <div class="col-md-4" data-title="' . htmlspecialchars($row['name'], ENT_QUOTES) . '" data-price="' . $row['price'] . '">
                    <div class="card mb-4 shadow-sm">
                        <img src="../admin/images/' . $row['images'] . '" class="card-img-top" alt="' . htmlspecialchars($row['name'], ENT_QUOTES) . '">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($row['name'], ENT_QUOTES) . '</h5>
                            <p class="card-text"><span>Per Kg</span> ' . $row['price'] . '$</p>
                            <button class="btn btn-danger add-cart" data-title="' . htmlspecialchars($row['name'], ENT_QUOTES) . '" data-price="' . $row['price'] . '">Add to Cart</button>
                        </div>
                    </div>
                </div>
            ';
        }
        
    } catch (Exception $e) {
        log_error($e->getMessage());
        echo '<div class="alert alert-danger">We are currently experiencing issues. Please try again later.</div>';
    }
}
?>