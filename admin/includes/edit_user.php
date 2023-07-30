<?php
  if (isset($_GET['edit_user'])) {
    $user_id = $_GET['edit_user'];
    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $current_user_info_query = mysqli_query($db_connection, $query);

    while($row = mysqli_fetch_assoc($current_user_info_query)) {
      $username = $row['user_name'];
      $user_password = $row['user_password'];
      $user_first_name = $row['first_name'];
      $user_last_name = $row['user_last_name'];
      $user_email = $row['user_email'];
      $user_role = $row['user_role'];
    }
  }

  if (isset($_POST['edit_user'])) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    // password encryption
    // get the salt
    $salt_query = "SELECT rand_salt FROM users";
    $get_salt_query = mysqli_query($db_connection, $salt_query);

    if (!$get_salt_query) {
      die ("Failed to get salt" . mysqli_error($db_connection));
    }

    $row = mysqli_fetch_assoc($get_salt_query);
    $salt = $row['rand_salt'];
    // encrypt password with the salt, submit this
    $encrypted_password = crypt($user_password, $salt);


    $query = "UPDATE users SET
      user_name = '{$user_name}',
      user_password = '{$encrypted_password}',
      first_name = '{$user_first_name}',
      user_last_name = '{$user_last_name}',
      user_email = '{$user_email}',
      user_role = '{$user_role}'
      WHERE user_id = {$user_id}";

    $edit_user_query = mysqli_query($db_connection, $query);
  }
?>

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
      <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>
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
    <input type="text" class="form-control" name="user_name" value="<?php echo $username; ?>"/>
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
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update User" />
  </div>
</form>