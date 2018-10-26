<?php
require_once 'startSettings.php';
if(!defined('PATH')){
    header('Location: '.$settings['uri']);
    die();
}
if(isset($_POST['session'])){
    session_unset();
    header('Location: '.$settings['uri']);
}
require_once 'server.php';
?>
<form class="session" action="" method="post">
    <input type="submit" name="session" value="Log Out">
</form>
<a href="?new=user">Create new user</a>

<?php
if(isset($_GET['new'])){
    switch ($_GET['new']) {
        case 'user':
            ?><form action="" method="post">
                <p>id:<p><input type="text" name="id" placeholder="id">
                <p>password:<p><input type="text" name="pw" placeholder="Password">
                <p>Select user role:<p>
                    <select name="role">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select> 
                <br><br>
                <input type="submit" name="createUser" value="Create">
            </form><?php
            break;
        default:
            break;
    }
}
if(isset($_POST['createUser'])){
    newUser($_POST['id'], $_POST['pw'], $_POST['role']);
}