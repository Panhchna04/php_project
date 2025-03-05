<!DOCTYPE html>
<?php 
  include("../admin/function.php");
?>
<html lang="en">
<?php include("../admin/include/head.php") ?>
<body class="g-sidenav-show bg-gray-200">
  <?php include("../admin/include/side.php") ?> 
  <div class="main-content position-relative max-height-vh-100 h-100 border-radius-l">
    <?php include('../admin/include/navbar.php') ?>
    <!-- <h1 class="text-center">Products List</h1> -->
      <div class="mt-4">
    <!-- Button trigger modal -->
        <button id="openAdd" type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i class="fa-solid fa-square-plus"></i>
          Add Product
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
                <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Product Name" name="pro_name" id="pro_name">
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Product stocks" name="pro_stock" id="pro_stock">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Product Price" name="pro_price" id="pro_price">
                  </div>
                  <select class="custom-select" name="pro_type" id="pro_type">
                    <option selected>Chose Type of products</option>
                    <option value="Strawberry">Strawberry</option>
                    <option value="Berry">Berry</option>
                    <option value="Lemon">Lemon</option>
                  </select>
                  <br>
                  <div class="form-control mt-4">
                    <input type="file" id="pro_image" name="pro_image" required>
                  </div>
                  <input type="hidden" name="pro_id" id="pro_id">
                  <div class="modal-footer">
                    <input id="add" class="btn btn-outline-danger" type="submit" name="btn_add_product" value="ADD">
                    <input id="close" class="btn btn-outline-primary" type="submit" name="btn_close" value="CLOSE">
                    <input id="edit" class="btn btn-outline-success" type="submit" name="btn_update" value="EDIT" style="display: none;">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">NAME</th>
              <th scope="col">STOCK</th>
              <th scope="col">PRICE</th>
              <th scope="col">TYPE</th>
              <th scope="col">IMAGES</th>
              <th scope="col">ACTIVE</th>
            </tr>
          </thead>
          <?php 
            if (isset($_POST['search_query']) && !empty($_POST['search_query'])) {
              search_data(); 
          } else {
              get_data(); 
          }
          ?>
        </table>
      </div>
  </div>
  <?php include("../admin/include/footer.php") ?> 
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      $(document).ready(function(){
        $('#openAdd').click(function(){
            $('#add').show();
            $('#edit').hide();
            $('#pro_name').val('');
            $('#pro_price').val('');
            $('#pro_stock').val('');
            $('#pro_type').val('');
            $('#pro_image').val('');
            $('#pro_id').val('');
        });

        $("body").on("click", "#openEdit", function(){
            $('#add').hide();
            $('#edit').show();
            var pro_name = $(this).parents("tr").find("td").eq(1).text();
            var pro_stock = $(this).parents("tr").find("td").eq(2).text();
            var pro_price = $(this).parents("tr").find("td").eq(3).text();
            var pro_type = $(this).parents("tr").find("td").eq(4).text();
            var pro_image = $(this).parents("tr").find("td").eq(5).text();
            var id = $(this).parents("tr").find("td").eq(0).text();

            $("#pro_name").val(pro_name);
            $("#pro_price").val(pro_price);
            $("#pro_stock").val(pro_stock);
            $("#pro_type").val(pro_type);
            $("#pro_image").val(pro_image);
            $("#stu_id").val(id);
        });
    });
  </script>


</html>