<?php
require_once 'startSettings.php';
if(!defined('PATH')){
    header('Location: '.$settings['uri']);
    die();
}
?>
<form action="" method="post" class="loginForm">
    <span>id:</span> <input type="text" name="id">
    <span>password:</span> <input type="password" name="pw">
    <input type="submit" name="login" value="Login">
</form>
<?php

if(isset($_POST['login'])){
    $conn = mysqli_connect($serverSettings['servername'], $serverSettings['username'], $serverSettings['password'], 'sender');
    $id = $_POST['id'] ?? '';
    $pw = $_POST['pw'] ?? '';

    $sql = "SELECT userPassword, userRole, userId FROM users 
    WHERE userId = '$id'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if ($row['userPassword'] == $pw ){
            switch ($row['userRole']) {
                case 'admin':
                    $_SESSION['logged'] = 1;
                    break;
                case 'user':
                    $_SESSION['logged'] = 2;
                    break;
            }
            header('Location: http://localhost/SenderTask');
            die();
        }
        else {
            echo 'Bad password';
        }
    } 
    else {
       echo "User don't exist";
    }

}

?>
<p> Prasome prisijunkti kad uzsisakyti maista <p>
