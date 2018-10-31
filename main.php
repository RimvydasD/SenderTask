<?php
require_once 'startSettings.php';
if(!defined('PATH')){
    header('Location: '.$settings['uri']);
    die();
}
require_once 'server.php';
?>
<form action="" method="post" class="loginForm">
    <span>Username:</span> <input type="text" name="username">
    <span>Password:</span> <input type="password" name="password">
    <input type="submit" name="login" value="Login">
</form>
<?php
$conn = mysqli_connect($serverSettings['servername'], $serverSettings['username'], $serverSettings['password'], $serverSettings['DBname']);

if(isset($_POST['login'])){
    login($_POST['username'] ?? '', $_POST['password'] ?? '');
}

?>
<p> Prasome prisijunkti kad uzsisakyti maista <p>

<?php
mysqli_close($conn);
?>