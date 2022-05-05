<?php
    require "php/database_credentials.php";
    require "php/database_functions.php";

    $conn = mysqli_connect($servername, $username, $database_password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
  
    // Create database
    $sql = "CREATE DATABASE $dbname";
    if (mysqli_query($conn, $sql)) {
        echo "<br>Database created successfully<br>";
    } else {
        echo "<br>Error creating database: " . mysqli_error($conn);
    }

    // Choose database
    $sql = "USE $dbname";
    if (mysqli_query($conn, $sql)) {
        echo "<br>Database changed successfully<br>";
    } else {
        echo "<br>Error changing database: " . mysqli_error($conn);
    }
    
    // sql to create table Users
    $sql = "CREATE TABLE $table_users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        cpf CHAR(11) NOT NULL,
        endereco VARCHAR(200) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(128) NOT NULL,
        data_registro VARCHAR(50),
        last_changed VARCHAR(50),
        admin BOOLEAN NOT NULL,
        UNIQUE (email)
        );";

    if (mysqli_query($conn, $sql)) {
        echo "<br>Table created successfully<br>";
    } else {
        echo "<br>Error creating database $table_users: " . mysqli_error($conn);
    }


    // sql to create table Atividades
    $sql = "CREATE TABLE $table_atividades (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(20) NOT NULL,
        dia_da_semana VARCHAR(20) NOT NULL,
        userid INT(6) UNSIGNED,
        CONSTRAINT FK_UserActivity FOREIGN KEY (userid) REFERENCES $table_users(id)
        );";
    
    if (mysqli_query($conn, $sql)) {
        echo "<br>Table created successfully<br>";
    } else {
        echo "<br>Error creating database $table_atividades: " . mysqli_error($conn);
    }

    mysqli_close($conn)
?>
