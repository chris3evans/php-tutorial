<?php
if (isset($_GET["p_id"])) {
  $the_post_id = $_GET['p_id'];
}
  $query = "SELECT * FROM posts WHERE post_id = '$the_post_id'";
  $edit_query = mysqli_query($db_connection, $query);

  while ($row = mysqli_fetch_assoc($edit_query)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];

    if (isset($_POST['update_post'])) {
      $post_author = $_POST['post_author'];
      $post_title = $_POST['post_title'];
      $post_category_id = $_POST['post_category'];
      $post_status = $_POST['post_status'];
      $post_image = $_FILES['post_image']['name'];
      $post_image_temp = $_FILES['post_image']['tmp_name'];
      $post_content = $_POST['post_content'];
      $post_tags = $_POST['post_tags'];

      move_uploaded_file($post_image_temp, "../images/$post_image");

      if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image = mysqli_query($db_connection, $query);

        while ($row = mysqli_fetch_assoc($select_image)) {
          $post_image = $row['post_image'];
        }
      }

      $query = "UPDATE posts SET
        post_title = '{$post_title}',
        post_category_id = '{$post_category_id}',
        post_date = now(),
        post_author = '{$post_author}',
        post_status = '{$post_status}',
        post_tags = '{$post_tags}',
        post_content = '{$post_content}',
        post_image = '{$post_image}'
        WHERE post_id = {$post_id}";

      $update_post = mysqli_query($db_connection, $query);

      check_query($update_post);

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
    <input type="text" class="form-control" name="post_title"
           value="<?php if (isset($post_title)) echo $post_title; ?>"/>
  </div>

  <div class="form-group">
    <select name="post_category" id="">
      <?php
        $query = "SELECT * FROM categories";
        $select_category_query = mysqli_query($db_connection, $query);
        check_query($select_category_query);

        while ($row = mysqli_fetch_assoc($select_category_query)) {
          $category_title = $row['category_title'];
          $category_id = $row['category_id'];
      ?>
        <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

  <?php } ?>

    </select>
  </div>

  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="post_author"
           value="<?php if (isset($post_author)) echo $post_author; ?>"/>
  </div>

  <div class="form-group">
    <select name="post_status" id="">
      <option value=<?php echo $post_status;?>><?php echo $post_status;?></option>
      <?php
        if ($post_status == 'published') {
          echo "<option value='draft'>Draft</option>";
        } else {
          echo "<option value='published'>Publish</option>";
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="post_image">Post Image</label>
    <img src="../images/<?php echo $post_image;?>" width="100"/>
    <input type="file" class="form-control" name="post_image" />
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags"
           value="<?php if (isset($post_tags)) echo $post_tags; ?>"/>
  </div>

  <div class="form-group">
    <label for="summernote">Post Content</label>
    <textarea class="form-control" id="summernote" name="post_content" id="" cols="30" rows="10"
    ><?php if (isset($post_content)) echo $post_content; ?></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post" />
  </div>
</form>

<?php }?>