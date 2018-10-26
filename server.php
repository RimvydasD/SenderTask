<?php
require_once 'startSettings.php';
if(!defined('PATH')){
    header('Location: '.$settings['uri']);
    die();
}
$conn = mysqli_connect($serverSettings['servername'], $serverSettings['username'], $serverSettings['password'], 'sender');
// https://sender.net/meals/

function newUser($id, $password, $role){
    global $conn;
    $newUser = "INSERT INTO users (userId, userPassword, userRole)
        VALUES ('{$id}', '{$password}', '{$role}')";
    mysqli_query($conn, $newUser);
}

// $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, "http://localhost/pirma-dalis/Rimvydas/parduotuve/server.php");
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
//         // curl_setopt($ch, CURLOPT_POST,1);
//         // curl_setopt($ch, CURLOPT_POSTFIELDS, 'data');
//         $result = curl_exec ($ch); 
//     curl_close ($ch);
//     echo json_decode($result);