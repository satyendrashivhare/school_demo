<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "school_db");

$conn= mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE); 

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

} 
?>