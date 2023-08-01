<?php include "../includes/db.php";
  function users_online() {
    global $db_connection;
    // session_id() gets or sets the current session id
    $session = session_id();
    $time = time();
    $time_offline_seconds = 30;
    $time_offline = $time - $time_offline_seconds;

    $query = "SELECT * FROM users_online WHERE session = '{$session}'";

    $online_query = mysqli_query($db_connection, $query);
    $online_count = mysqli_num_rows($online_query);

    // if new user logs in, insert time and session into users_online table
    if ($online_count == NULL) {
        $query = "INSERT INTO users_online (session, time) VALUES ('$session', '$time')";
        mysqli_query($db_connection, $query);
    } else {
        $query = "UPDATE users_online SET time = '$time' WHERE session = '$session'";
        mysqli_query($db_connection, $query);
    }

    // will only retrieve users who have been online within the time limit set
    $users_online_sql = "SELECT * FROM users_online WHERE time > '$time_offline'";
    $users_online_query = mysqli_query($db_connection, $users_online_sql);

    // the number of users who are online / were online 30 seconds ago
    $count_user = mysqli_num_rows($users_online_query);
    return $count_user;
  }
  function find_all_categories() {
    global $db_connection;

    $query = 'SELECT * FROM categories';
    $query_search = mysqli_query($db_connection, $query);

    while ($row = mysqli_fetch_assoc($query_search)) {
      $category_title = $row['category_title'];
      $category_id = $row['category_id'];

      echo "<tr>
              <td>{$category_id}</td>
              <td>{$category_title}</td>
              <td>
                <a href='categories.php?delete={$category_id}'>Delete</a>
              </td>
              <td>
                <a href='categories.php?edit={$category_id}'>Edit</a>
              </td>
            </tr>";
    }
  }
  function insert_categories() {
    global $db_connection;

    if (isset($_POST['submit'])) {
      $category_title = $_POST['category_title'];
      $query = "INSERT INTO categories(category_title) VALUE('{$category_title}')";
      $create_category = mysqli_query($db_connection, $query);

      if (!$create_category) {
        die("Query Failed" . mysqli_error($db_connection));
      }
    }
  }

  function delete_category() {
    global $db_connection;

    if (isset($_GET['delete'])) {
      $category_id = $_GET['delete'];
      $query = "DELETE FROM categories WHERE category_id = '{$category_id}'";

      $delete_query = mysqli_query($db_connection, $query);

      header("Location: categories.php");
    }
  }

  function check_query($query) {
    global $db_connection;

    if (!$query) {
      die("QUERY FAILED") . mysqli_error($db_connection);
    }
  }
?>