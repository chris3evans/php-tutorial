<?php
if (isset($_GET['p_id'])) {
  $post_id = $_GET['p_id'];
}
  $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
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
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" class="form-control" name="post_title"
           value="<?php if (isset($post_title)) echo $post_title; ?>"/>
  </div>

  <div class="form-group">
    <select name="" id="">
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
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status"
           value="<?php if (isset($post_status)) echo $post_status; ?>"/>
  </div>

  <div class="form-group">
    <img src="../images/<?php echo $post_image;?>" width="100"/>
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="post_image" />
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags"
           value="<?php if (isset($post_tags)) echo $post_tags; ?>"/>
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10"
    ><?php if (isset($post_content)) echo $post_content; ?></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post" />
  </div>
</form>

<?php }?>