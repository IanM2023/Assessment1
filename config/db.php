<?php
    $localhost = "localhost";
    $username  = "root";
    $password  = "";
    $database  = "assessment_tbl";

    $conn = new mysqli(hostname: $localhost, username: $username, password: $password, database: $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;

?>