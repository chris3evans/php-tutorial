<?php
  if (isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $checkBoxValue) {
      $bulk_options = $_POST['bulk_options'];
    }
  }
?>

<form action="" method='post'>
  <table class="table table-bordered table-hover">
    <div id="bulkOptionContainer" class="col-xs-4">
      <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="">Publish</option>
        <option value="">Draft</option>
        <option value="">Delete</option>
      </select>
    </div>
    <div class="col-xs-4">
      <input type="submit" name="submit" class="btn btn-success" value="Apply">
      <a class="btn btn-primary" href="add_post.php">Add New</a>
    </div>

    <thead>
      <tr>
        <th>
          <input id="selectAllBoxes" type="checkbox">
        </th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>
      <?php
        $query = "SELECT * FROM posts";
        $posts_query = mysqli_query($db_connection, $query);

        if (!$posts_query) { die("Failed to fetch all posts"); }

        while ($row = mysqli_fetch_assoc($posts_query)) {
          $post_id = $row['post_id'];
          $post_author = $row['post_author'];
          $post_title = $row['post_title'];
          $post_category_id = $row['post_category_id'];
          $post_status = $row['post_status'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_comment_count = $row['post_comment_count'];
          $post_date = $row['post_date'];
      ?>
        <tr>
          <td>
            <input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id;?>">
          </td>
          <td><?php echo $post_id;?></td>
          <td><?php echo $post_author;?></td>
          <td><?php echo $post_title;?></td>

          <?php
            $query = "SELECT * FROM categories WHERE category_id = {$post_category_id}";
            $query_categories = mysqli_query($db_connection, $query);

            while ($row = mysqli_fetch_assoc($query_categories)) {
              $category_id = $row['category_id'];
              $category_title = $row['category_title'];

          ?>
          <td><?php echo $category_title;?></td>
          <?php  } ?>

          <td><?php echo $post_status;?></td>
          <td>
            <img style="height: 100px; width: auto;" src="../images/<?php echo $post_image;?>" />
          </td>
          <td><?php echo $post_tags;?></td>
          <td><?php echo $post_comment_count;?></td>
          <td><?php echo $post_date;?></td>
          <td>
            <a href="posts.php?source=edit_post&p_id=<?php echo $post_id; ?>">Edit</a>
          </td>
          <td>
            <a href="posts.php?delete=<?php echo $post_id; ?>">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</form>

<?php
  if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = '$post_id'";
    $delete_query = mysqli_query($db_connection, $query);
    header("Location: post.php");
  }
?>