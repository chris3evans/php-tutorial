<?php include "../includes/db.php";
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