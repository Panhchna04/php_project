<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
$con = new mysqli('localhost', 'root', '', 'ecommerce');
try {
    $con = new PDO('mysql:host=localhost;dbname=ecommerce', 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
function register() {
    global $con;
    if (isset($_POST['btn_register'])) {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        if (!empty($password) && !empty($email) && !empty($username)) {
            $password = md5($password);
            $sql = "INSERT INTO `users` (`password`, `email`, `username`) VALUES (:password, :email, :username)";
            $rs = $con->prepare($sql);
            $rs->bindParam(':password', $password);
            $rs->bindParam(':email', $email);
            $rs->bindParam (':username', $username);
            if ($rs) {
                header('Location: login.php');
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Created",
                            text: "Account registered",
                            icon: "success",
                            button: "Done",
                        });
                    });
                </script>
                ';
            } 
        } else {
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Error",
                            text: "Something went wrong",
                            icon: "error",
                            button: "Done",
                        });
                    });
                </script>
                ';
        }
    }
}
register();
session_start();
function login() {
    global $con;
    if (isset($_POST['btn_login'])) {
        $name_email = $_POST['name_email'];
        $password = $_POST['password'];
        $password = md5($password);
        $sql = "SELECT `id` FROM `users` WHERE (`username` = :name_email OR `email` = :name_email) AND `password` = :password";
        $rs = $con->prepare($sql);
        $rs->bindParam(':name_email', $name_email);
        $rs->bindParam(':password', $password);
        $rs->execute();
        $row = $rs->fetch(PDO::FETCH_ASSOC);
        if (!empty($row)) { 
            $_SESSION['user'] = $row['id'];
            header('Location: index.php');
            exit; 
        } else {
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "Error",
                        text: "Username or password is incorrect",
                        icon: "error",
                        button: "Done",
                    });
                });
            </script>
            ';
        }
    }    
}    
login();
function logout(){
    if(isset($_POST['btn_logout'])){
        session_destroy(); 
        header("Location: index.php"); 
        exit();
    }
}
logout();
function insert_data() {
    global $con;
    if (isset($_POST['btn_add_product'])) {
        $name = $_POST['pro_name'];
        $price = $_POST['pro_price'];
        $stock = $_POST['pro_stock'];
        $type = $_POST['pro_type'];
        if (isset($_FILES['pro_image'])) {
            $image = $_FILES['pro_image']['name'];
        } else {
            $image = null;
        }
        if (!empty($name) && !empty($price) && !empty($stock) && !empty($type) && !empty($image)) {
            $image = date('YmdHis') . '_' . basename($_FILES['pro_image']['name']);
            $path = 'images/' . $image;
            // Move the uploaded file
            if (move_uploaded_file($_FILES['pro_image']['tmp_name'], $path)) {
                $sql = ("INSERT INTO `products`(`name`, `stock`, `price`, `tpye`, `images`) 
                                VALUES ('$name','$stock','$price','$type','$image')");
                $rs = $con->query($sql);
                if ($rs) {
                    echo "
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: 'Success!',
                                    text: 'Data has been successfully inserted into the database',
                                    icon: 'success',
                                });
                            });
                        </script>
                    ";
                   header( "Location: ./product.php");
                   
                }
            } 
        }
      
    }
}
insert_data();

function get_data() {
    global $con; 
    $sql = $con->query("SELECT * FROM `products` ORDER BY id DESC");
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $row) {
        echo '
            <tr>
                <td>' . htmlspecialchars($row['id']) . '</td>
                <td>' . htmlspecialchars($row['name']) . '</td>
                <td>' . htmlspecialchars($row['stock']) . '</td>
                <td>' . htmlspecialchars($row['price']) . '$</td>
                <td>' . htmlspecialchars($row['tpye']) . '</td>
                <td><img src="images/' . htmlspecialchars($row['images']) . '" width="60"></td>
                <td>
                    <div>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>
                    </div>    
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="txt_id" value="' . htmlspecialchars($row['id']) . '">
                        <button name="btn_delete" type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        ';
    }
}
// not successful
function update_data() {
    global $con;
    if(isset($_POST['btn-update'])){
        $id = $_GET['id'];
        $name = $_POST['pro_name'];
        $price = $_POST['pro_price'];
        $stock = $_POST['pro_stock'];
        $type = $_POST['pro_type'];
        $image = $_FILES['pro_image']['name'];
        if(empty($image)){
            $image = $_POST['old_image'];
        }else{
            $image = rand(1,99999).'_'.$image;
            $path = 'images/' . $image;
            move_uploaded_file($_FILES['pro_iamge']['tmp_name'],$path);
        }

        if(!empty($status) && !empty($thumbnail)){
            $sql = "UPDATE `products` SET `name`='$name',`stock`='$stock',`price`='$price',`tpye`='$type',`images`='$image' WHERE '$id'";
            $rs  = $con->query($sql);
            if($rs){
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Done",
                            text: "logo Update successfully",
                            icon: "success",
                            button: "Done",
                        });
                    })
                </script>
                ';
            }
        }
        else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "Error",
                        text: "logo update not successfully",
                        icon: "error",
                        button: "Done",
                    });
                })
            </script>
            ';
        }


     
    }
}
update_data();
function delete_data() {
    global $con; // Assume $con is your PDO connection
    if (isset($_POST['btn_delete'])) {
        $id = $_POST['txt_id'];
        $sql = ("SELECT images FROM `products` WHERE `id` = :id");
        $rs = $con->prepare($sql); 
        $rs->execute([':id' => $id]);
        $row = $rs->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $imagePath = 'images/' . $row['images'];
            $rs = $con->prepare("DELETE FROM `products` WHERE `id` = :id");
            if ($rs->execute([':id' => $id])) {
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image file
                }
                echo '
                    <script>
                        $(document).ready(function(){
                            Swal.fire({
                                title: "Data has been deleted successfully!",
                                icon: "success",
                                draggable: true
                            });
                        });
                    </script>
                ';
            }
        }
    }
}
delete_data();
function search_data() {
    global $con; // Assume $con is your PDO connection
    if (isset($_POST['search_query']) && !empty($_POST['search_query'])) {
        $search_query = $_POST['search_query'];
        $search_query = "%$search_query%"; 
        $sql = "SELECT * FROM `products` WHERE `name` LIKE :search OR `tpye` LIKE :search ORDER BY id DESC";
        $rs = $con->prepare($sql);
        $rs->execute([':search' => $search_query]);
        if ($rs->rowCount() > 0) {
            while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
                echo '
                    <tr>
                        <td>' . htmlspecialchars($row['id']) . '</td>
                        <td>' . htmlspecialchars($row['name']) . '</td>
                        <td>' . htmlspecialchars($row['stock']) . '</td>
                        <td>' . htmlspecialchars($row['price']) . '$</td>
                        <td>' . htmlspecialchars($row['tpye']) . '</td>
                        <td><img src="images/' . htmlspecialchars($row['images']) . '" width="60"></td>
                        <td>
                            <div>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>
                            </div>    
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="txt_id" value="' . htmlspecialchars($row['id']) . '">
                                <button name="btn_delete" type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="7">No results found.</td></tr>';
        }
    }
}




?>
