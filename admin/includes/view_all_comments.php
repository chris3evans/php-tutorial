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

        <?php
          $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
          $select_post_query = mysqli_query($db_connection, $query);

          while ($row = mysqli_fetch_assoc($select_post_query)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title']
          ?>

        <td>
            <a href="../post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
        </td>
        <?php } ?>

        <td><?php echo $comment_date;?></td>
        <td>
          <a href="comments.php?approve=<?php echo $comment_id;?>">Approve</a>
        </td>
        <td>
          <a href="comments.php?unapprove=<?php echo $comment_id;?>">Unapprove</a>
        </td>
        <td>
          <a href="comments.php?delete=<?php echo $comment_id;?>">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<!-- Unapprove Comment -->
<?php
  if (isset($_GET['unapprove'])) {
    $unapprove_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$unapprove_comment_id}";
    $update_unapprove_query = mysqli_query($db_connection, $query);
    header("Location: comments.php");
  }
?>

<!-- Approve Comment -->
<?php
  if (isset($_GET['approve'])) {
    $approve_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approve_comment_id}";
    $update_approve_query = mysqli_query($db_connection, $query);
    header("Location: comments.php");
  }
?>

<!-- Delete Comment -->
<?php
  if (isset($_GET['delete'])) {
    $comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";

    $delete_comment_query = mysqli_query($db_connection, $query);
    header("Location: comments.php");
  }
?>