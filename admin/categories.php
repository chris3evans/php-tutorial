<?php include "includes/admin_header.php"; ?>
<?php include "functions.php"; ?>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Author Name</small>
                        </h1>

                        <div class="col-xs-6">

                          <?php insert_categories(); ?>

                          <form action="" method="post">
                            <div class="form-group">
                              <label for="category_title">Add Category</label>
                              <input class="form-control" type="text" name="category_title">
                            </div>
                            <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                          </form>

                          <!-- Update form and db query -->
                          <?php
                            if (isset($_GET['edit'])) {
                              $category_id = $_GET['edit'];
                              include "includes/update_categories.php";
                            }
                          ?>

                        </div>

                        <div class="col-xs-6">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                              </tr>
                            </thead>
                            <tbody>

                              <!-- Get all categories db query logic -->
                              <?php find_all_categories()?>

                              <!-- Delete category db query logic -->
                              <?php delete_category()?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>