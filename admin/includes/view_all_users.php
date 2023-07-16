<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Role</th>
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
        <td>
          <a href="comments.php?approve='">Approve</a>
        </td>
        <td>
          <a href="comments.php?unapprove='">Unapprove</a>
        </td>
        <td>
          <a href="users.php?delete=<?php echo $user_id;?>">Delete</a>
        </td>
      </tr>

      <?php } ?>
  </tbody>
</table>

<?php
  if (isset($_GET['delete'])) {
    $comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";

    $delete_comment_query = mysqli_query($db_connection, $query);
    header("Location: comments.php");
  }
?>

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
    $user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$user_id}";

    $delete_user_query = mysqli_query($db_connection, $query);
    header("Location: users.php");
  }
?>