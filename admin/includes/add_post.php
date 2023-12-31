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
      post_title,
      post_author,
      post_date,
      post_image,
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

    $the_post_id = mysqli_insert_id($db_connection);

    echo "<p class='bg-success'>Post Updated.
            <a href='../post.php?p_id={$the_post_id}'>View Post</a>
            or
            <a href='posts.php'>Edit More Posts</a>
          </p>";
  }
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" class="form-control" name="post_title" />
  </div>

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

  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="post_author" />
  </div>

  <div class="form-group">
    <select name="post_status" id="">
      <option value="draft">Post Status</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
    </select>
  </div>

  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="post_image" />
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" />
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post" />
  </div>
</form>