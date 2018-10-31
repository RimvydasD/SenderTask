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
<a href="?new=user">Create new user</a>
<a href="?new=meals">New meals</a>
<a href="?showUsers">Show users</a>

<?php
if(isset($_GET['new'])){
    switch ($_GET['new']) {
        case 'user':
            ?><form action="" method="post">
                <p>Username:<p><input type="text" name="username" placeholder="username">
                <p>Password:<p><input type="text" name="password" placeholder="Password">
                <p>Select user role:<p>
                    <select name="role">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select> 
                <br><br>
                <input type="submit" name="createUser" value="Create">
                <input type="submit" name="back" value="Back">
            </form><?php
            break;
        case 'meals':
            ?><form action="" method="post">
                <input type="submit" name="meals" value="Get meals menu">
                <input type="submit" name="back" value="Back">    
            </form>
            <?php
            break;
    }
}
if(isset($_POST['createUser'])){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        newUser($_POST['username'], $_POST['password'], $_POST['role']);
        // header('Location: '.$settings['uri']);
    }else {
        echo "Username and password can't be empty";
    }
}
if(isset($_POST['back'])){
    header('Location: '.$settings['uri']);
}
if(isset($_GET['showUsers'])){
    echo "<br>";
    showUsers();
    echo '<form action="" method="post"><input type="submit" name="back" value="Back"></form>';
}
if(isset($_POST['meals'])){
    $meals = apiMeals();
    echo '<pre>';
    print_r($meals);
    echo '</pre>';
}

