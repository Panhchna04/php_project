<?php include("../admin/function.php") ?>
<!DOCTYPE html>
<html lang="en">
<?php include("include/head.php")?>

<body class="bg-gray-200">
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Log in</h4>
                </div>
              </div>
              <div class="card-body">
                <form role="form" method="post" action="" class="text-start">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label" >Name or Email</label>
                    <input type="text" name="name_email" class="form-control" placeholder="Username" required>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                  <?php if (isset($error)): ?>
                      <p style="color:red;"><?= htmlspecialchars($error) ?></p>
                  <?php endif; ?>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember me</label>
                  </div>
                  
                  <div class="text-center">
                    <input class="btn bg-gradient-primary w-100 my-4 mb-2" type="submit" name="btn_login" value="LOGIN">
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="../admin/register.php" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include("../admin/include/footer.php") ?>
</body>
</html>
