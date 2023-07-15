<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Date</th>
    </tr>
  </thead>

  <tbody>
    <?php
      $query = "SELECT * FROM users";
      $query_all_users = mysqli_query($db_connection, $query);

      if (!$query_all_users) { die("Failed to fetch all users"); }

      while ($row = mysqli_fetch_assoc($query_all_users)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_first_name = $row['first_name'];
        $user_last_name = $row['user_last_name'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    ?>
      <tr>
        <td><?php echo $user_id;?></td>
        <td><?php echo $user_name;?></td>
        <td><?php echo $user_first_name;?></td>
        <td><?php echo $user_last_name;?></td>
        <td><?php echo $user_email;?></td>
        <td><?php echo $user_role;?></td>

        <?php
          $query = "SELECT * FROM users WHERE user_id = $user_id";
          $select_user_query = mysqli_query($db_connection, $query);

          while ($row = mysqli_fetch_assoc($select_user_query)) {
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