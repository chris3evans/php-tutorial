<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Status</th>
      <th>In Response To</th>
      <th>Date</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Delete</th>
    </tr>
  </thead>

  <tbody>
    <?php
      $query = "SELECT * FROM comments";
      $query_all_comments = mysqli_query($db_connection, $query);

      if (!$query_all_comments) { die("Failed to fetch all posts"); }

      while ($row = mysqli_fetch_assoc($query_all_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
    ?>
      <tr>
        <td><?php echo $comment_id;?></td>
        <td><?php echo $comment_author;?></td>
        <td><?php echo $comment_content;?></td>
        <td><?php echo $comment_email;?></td>
        <td><?php echo $comment_status;?></td>
        <td>user John Doe</td>
        <td><?php echo $comment_date;?></td>
        <td>
          <a href="#">Approve</a>
        </td>
        <td>
          <a href="#">Unapprove</a>
        </td>
        <td>
          <a href="#">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<?php
  if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = '$post_id'";
    $delete_query = mysqli_query($db_connection, $query);
    header("Location: posts.php");
  }
?>