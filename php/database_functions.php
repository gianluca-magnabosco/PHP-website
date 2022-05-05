<?php
  require "php/database_credentials.php";

  function connect_database() {
    global $servername, $username, $database_password, $dbname;
    $conn = mysqli_connect($servername, $username, $database_password, $dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    return($conn);
  }

  function disconnect_database($conn){
    mysqli_close($conn);
  }
?>
