<?php
require_once 'startSettings.php';

$servername = $serverSettings['servername'];
$username = $serverSettings['username'];
$password = $serverSettings['password'];


// Prisijungiam prie serverio
$conn = mysqli_connect($servername, $username, $password);

// Patikrinam prisijungimą
if (!$conn) {
   die('Connection failed: ' . mysqli_connect_error());
}
// Sukuriam duomenų bazę
$sql = "CREATE DATABASE IF NOT EXISTS sender";
if (mysqli_query($conn, $sql)) {
   echo "Database created successfully ";
} else {
   echo "Error creating database: " . mysqli_error($conn);
}
//Uždarom prisijungimą
mysqli_close($conn);

// Prisijungiam prie serverio
$conn = mysqli_connect($servername, $username, $password, 'sender');

// Patikrinam prisijungimą
if (!$conn) {
   die('Connection failed: ' . mysqli_connect_error());
}

//kuria tables
mysqli_query($conn, 'DROP TABLE IF EXISTS `users`');

$sql = "CREATE TABLE users(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userId VARCHAR(32) NOT NULL,
    userPassword VARCHAR(32) NOT NULL,
    userRole VARCHAR(6) NOT NULL,
    reg_date TIMESTAMP
)";
   
if (mysqli_query($conn, $sql)) {
    $admin = "admin";
    $createAdmin = "INSERT INTO users (userId, userPassword, userRole)
        VALUES ('{$admin}', '{$admin}', '{$admin}')";
    mysqli_query($conn, $createAdmin);
    echo "Tables created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
