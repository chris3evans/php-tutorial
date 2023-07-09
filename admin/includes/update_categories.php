<form action="" method="post">
  <div class="form-group">
    <label for="category_title">Edit Category</label>

    <?php
      if (isset($_GET['edit'])) {
        $category_id = $_GET['edit'];


      $query = "SELECT * FROM categories WHERE category_id = $category_id";
      $update_category_query = mysqli_query($db_connection, $query);

      while ($row = mysqli_fetch_assoc($update_category_query)) {
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];

    ?>
        <input value="<?php if (isset($category_title)) { echo $category_title; } ?>" class="form-control" type="text" name="category_title">

      <?php }} ?>

      <!-- UPDATE CATEGORY -->
      <?php
        if (isset($_POST['update_category'])) {
          $category_title = $_POST['category_title'];
          $query = "UPDATE categories SET category_title = '{$category_title}' WHERE category_id = {$category_id}";
          $update_query = mysqli_query($db_connection, $query);

          if (!$update_query) {
            die("Update Query Failed");
          }

        }
      ?>
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
  </div>
</form>