<?php
// Get the current script name
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <h4 class="ms-1 font-weight-bold text-white">Admin Dashboad</h4>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white <?= $current_page == 'index.php' ? 'active bg-gradient-primary' : '' ?>" href="../admin/index.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">dashboard</i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $current_page == 'product.php' ? 'active bg-gradient-primary' : '' ?>" href="../admin/product.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $current_page == 'orders.php' ? 'active' : '' ?>" href="./pages/orders.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">view_in_ar</i>
                </div>
                <span class="nav-link-text ms-1">Orders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $current_page == 'pages.php' ? 'active' : '' ?>" href="./pages/pages.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                </div>
                <span class="nav-link-text ms-1">Pages</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $current_page == 'notifications.php' ? 'active' : '' ?>" href="./pages/notifications.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">notifications</i>
                </div>
                <span class="nav-link-text ms-1">Notifications</span>
            </a>
        </li>
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $current_page == 'profile.php' ? 'active bg-gradient-primary' : '' ?>" href="../admin/profile.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <span class="nav-link-text ms-1">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $current_page == 'logout.php' ? 'active' : '' ?>" href="../admin/logout.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">assignment</i>
                </div>
                <span class="nav-link-text ms-1">Log out</span>
            </a>
        </li>
    </ul>
</div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" href="https://www.facebook.com/Panhchna.Minh" target="_blank" type="button">Make by Mrs Panhchna</a>
      </div>
    </div>
  </aside>