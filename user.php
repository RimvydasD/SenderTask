<?php
require_once 'startSettings.php';
if(!defined('PATH')){
    header('Location: '.$settings['uri']);
    die();
}
if(isset($_POST['logout'])){
    session_unset();
    header('Location: '.$settings['uri']);
}
require_once 'server.php';
?>
<form class="session" action="" method="post">
    <input type="submit" name="logout" value="Logout">
</form>

<p>USERISSSS<p>