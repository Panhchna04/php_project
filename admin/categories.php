<?php 
  include("../admin/function.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php include("../admin/include/head.php") ?>
<body class="g-sidenav-show  bg-gray-200">
    <?php include("../admin/include/side.php") ?> 
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-l">
        <?php include('../admin/include/navbar.php') ?>
        <div class="mt-4">
              <!-- Button trigger modal -->
            <button name="category_add" type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-folder-plus"></i>&nbsp;
                ADD Category           
            </button>
            <div class="search float-end mx-10">
                <form class="form-inline my-2 my-lg-0" method="POST" action="">
                    <input class="form-control mr-sm-2" type="search" name="search_query" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> &nbsp;
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">ALL</button>
                </form>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter Your Categories Name" name="cate_name" id="cate_name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-success">Save</button>
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
        </div>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NAME CATEGORISE</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

        </table>

    </div>   
    <?php include("../admin/include/footer.php") ?>
</body>
</html>