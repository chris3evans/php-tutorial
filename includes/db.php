<?php
  $db_host = 'localhost';
  $db_username = 'root';
  $db_password = '';
  $db_database = 'cms';

  $db_connection = mysqli_connect($db_host, $db_username, $db_password, $db_database);

  // if ($db_connection) {
  //   echo "We are connected";
  // } else {
  //   echo "Connection not found";
  // }
?>