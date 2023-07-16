<?php
  if (isset($_GET['edit_user'])) {
    $user_id = $_GET['edit_user'];
  }
?>

<?php
  if (isset($_POST['edit_user'])) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    // $user_image = $_FILES['user_image']['name'];
    // $user_image_temp = $_FILES['user_image']['tmp_name'];
    // move_uploaded_file($user_image_temp, "../images/{$user_image}");

    $query = "INSERT INTO users (
      user_name,
      user_password,
      first_name,
      user_last_name,
      user_email,
      user_role) VALUES (
      '{$user_name}',
      '{$user_password}',
      '{$user_first_name}',
      '{$user_last_name}',
      '{$user_email}',
      '{$user_role}')";

    $add_user_query = mysqli_query($db_connection, $query);
    check_query($add_user_query);
  }
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_first_name">First Name</label>
    <input type="text" class="form-control" name="user_first_name" />
  </div>

  <div class="form-group">
    <label for="user_last_name">Last Name</label>
    <input type="text" class="form-control" name="user_last_name" />
  </div>

  <div class="form-group">
    <select name="user_role" id="">
      <option value="subsriber">Select User Role</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>

  <!-- <div class="form-group">
    <label for="post_image"></label>
    <input type="file" class="form-control" name="post_image" />
  </div> -->

  <div class="form-group">
    <label for="user_name">Username</label>
    <input type="text" class="form-control" name="user_name" />
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email" />
  </div>

  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password" />
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Add User" />
  </div>
</form>