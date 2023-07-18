<?php include "includes/admin_header.php"; ?>
<?php include "functions.php"; ?>

<?php
  if (isset($_SESSION['username'])) {
    $user_name = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";

    $get_user_profile_query = mysqli_query($db_connection, $query);

    while ($row = mysqli_fetch_assoc($get_user_profile_query)) {
      $user_id = $row['user_id'];
      $user_name = $row['user_name'];
      $user_password = $row['user_password'];
      $user_first_name = $row['first_name'];
      $user_last_name = $row['user_last_name'];
      $user_email = $row['user_email'];
      $user_role = $row['user_role'];
    }
  }
?>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users
                            <small>Author Name</small>
                        </h1>

                        <form action="" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="user_first_name">First Name</label>
                            <input type="text" class="form-control" name="user_first_name" value="<?php echo $user_first_name;?>"/>
                          </div>

                          <div class="form-group">
                            <label for="user_last_name">Last Name</label>
                            <input type="text" class="form-control" name="user_last_name" value="<?php echo $user_last_name;?>"/>
                          </div>

                          <div class="form-group">
                            <select name="user_role" id="">
                              <option value="subscriber"><?php echo $user_role;?></option>
                              <?php
                                if ($user_role == 'admin') {
                                  echo "<option value='subscriber'>Subscriber</option>";
                                } else {
                                  echo "<option value='admin'>Admin</option>";
                                }
                              ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="user_name">Username</label>
                            <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>"/>
                          </div>

                          <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email;?>"/>
                          </div>

                          <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" class="form-control" name="user_password" value="<?php echo $user_password;?>"/>
                          </div>

                          <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile" />
                          </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>