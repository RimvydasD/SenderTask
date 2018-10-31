<?php
require_once 'startSettings.php';
if(!defined('PATH')){
    header('Location: '.$settings['uri']);
    die();
}
// PDO Setup
$host = $serverSettings['servername'];
$db   = $serverSettings['DBname'];
$user = $serverSettings['username'];
$pass = $serverSettings['password'];
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
     echo $e->getMessage(), (int)$e->getCode();
}

function login($username, $password){
    global $pdo;

    $stmt = $pdo->prepare('SELECT user_role FROM users WHERE user_name = :username AND user_password = :password');
    $stmt->execute(['username' => $username, 'password' => $password]);
    $user = $stmt->fetch();
    file_put_contents(__DIR__.'/log.txt' , print_r($user, true));

    if(!empty($user['user_role'])){
        switch ($user['user_role']) {
            case 'admin':
                $_SESSION['logged'] = 1;
                break;
            case 'user':
                $_SESSION['logged'] = 2;
                break;
        }
        header('Location: '.$settings['uri']);
        die();
    }else {
        echo "User or Password is incorrect";
    }
}

function newUser($username, $password, $role){
    global $pdo;

    try{
        $stmt = $pdo->prepare('INSERT INTO users (user_name, user_password, user_role) VALUES (:username, :password, :role)');
        $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role]);
        echo "Created successfully";
    } catch (PDOException $e){
        print_r($e->errorInfo[2] ?? $e->getMessage());
    }
}
function showUsers(){
    global $pdo;

    $stmt = $pdo->prepare('SELECT * FROM users');
    $stmt->execute();
    $user = $stmt->fetchAll();

    foreach ($user as $key => $value) {
        echo "id: " . $value["id"]. " - Name: " . $value["user_name"]. " Password: " . $value["user_password"]. " Role: " . $value["user_role"] . " Registration time: " . $value["reg_date"]
                .'<a style="color:blue" href="?view=edit&id='.$value["id"].'"> REDAGUOTI</a><a style="color:red" href="?view=delete&id='.$value["id"].'  "> TRINTI</a>'."<br>";
    }
}
function apiMeals(){
    $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.sender.net/meals/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            // curl_setopt($ch, CURLOPT_POST,1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, 'data');
            $result = curl_exec ($ch); 
        curl_close ($ch);
        return json_decode($result);
}