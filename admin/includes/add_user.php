<?php
  if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(
      post_category_id,
      post_title, post_author,
      post_date, post_image,
      post_content,
      post_tags,
      post_status) VALUES(
        {$post_category_id},
        '{$post_title}',
        '{$post_author}',
         now(),
        '{$post_image}',
        '{$post_content}',
        '{$post_tags}',
        '{$post_status}')";

    $add_post_query = mysqli_query($db_connection, $query);

    check_query($add_post_query);
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
      <?php
        $query = "SELECT * FROM users";
        $all_users_query = mysqli_query($db_connection, $query);
        check_query($all_users_query);

        while ($row = mysqli_fetch_assoc($all_users_query)) {
          $user_id = $row['user_id'];
          $user_role = $row['user_role'];
        ?>
        <option value="<?php echo $user_id;?>"><?php echo $user_role;?></option>
        <?php }?>
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
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User" />
  </div>
</form>


<div class="form-group">
    <select name="post_category" id="">
    <?php
      $query = "SELECT * FROM categories";
      $query_all_categories = mysqli_query($db_connection, $query);

      check_query($query_all_categories);

      while ($row = mysqli_fetch_assoc($query_all_categories)) {
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
    ?>
      <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
      <?php } ?>
    </select>
  </div>