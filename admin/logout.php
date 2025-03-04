<?php
include('../admin/function.php');
include('../admin/include/head.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card my-5">
            <h2 class="text-center text-dark mt-5 font-weight-bolder mt-2 mb-0">Logout Confirmation</h2>
          <form class="card-body cardbody-color p-lg-5">
            <div class="text-center"><p>Are you sure you want to log out?</p></div>
            <div id="emailHelp" class="form-text text-center mb-5 text-dark">
            <a href="../admin/login.php" class="btn btn-danger" name="btn_logout" >Logout</a>&nbsp;&nbsp;
            <a href="../admin/index.php" class="btn btn-secondary">Stay Logged In</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</body>
</html>