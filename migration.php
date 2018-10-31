<?php
require_once 'startSettings.php';

$servername = $serverSettings['servername'];
$username = $serverSettings['username'];
$password = $serverSettings['password'];
$DBname = $serverSettings['DBname'];


// Prisijungiam prie serverio
$conn = mysqli_connect($servername, $username, $password);

// Patikrinam prisijungimą
if (!$conn) {
   die('Connection failed: ' . mysqli_connect_error());
}
// Sukuriam duomenų bazę
$sql = "CREATE DATABASE IF NOT EXISTS $DBname";
if (mysqli_query($conn, $sql)) {
   echo "Database created successfully ";
} else {
   echo "Error creating database: " . mysqli_error($conn);
}
//Uždarom prisijungimą
mysqli_close($conn);

// Prisijungiam prie serverio
$conn = mysqli_connect($servername, $username, $password, $DBname);

// Patikrinam prisijungimą
if (!$conn) {
   die('Connection failed: ' . mysqli_connect_error());
}

//kuria tables
mysqli_query($conn, 'DROP TABLE IF EXISTS `users`');

$sql = "CREATE TABLE users(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(32) NOT NULL UNIQUE,
    user_password VARCHAR(32) NOT NULL,
    user_role VARCHAR(6) NOT NULL,
    reg_date TIMESTAMP
)";
   
if (mysqli_query($conn, $sql)) {
    $createAdmin = "INSERT INTO users (user_name, user_password, user_role)
        VALUES ('admin', 'admin', 'admin')";
    mysqli_query($conn, $createAdmin);
    echo "Tables created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_query($conn, 'DROP TABLE IF EXISTS `meals`');

$sql = "CREATE TABLE meals(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    meal TEXT NOT NULL,
    meal_date DATETIME NOT NULL
)";
   
if (mysqli_query($conn, $sql)) {
    echo "Tables created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_query($conn, 'DROP TABLE IF EXISTS `orders`');

$sql = "CREATE TABLE orders(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) NOT NULL,
    user_order TEXT NOT NULL,
    reg_date TIMESTAMP
)";
   
if (mysqli_query($conn, $sql)) {
    echo "Tables created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
