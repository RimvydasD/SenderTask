<?php
define('PATH', __DIR__);
require_once 'startSettings.php';
// sesion unset
if(isset($_POST['session'])){
    session_unset();
    header('Location: '.$settings['uri']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sender Meals</title>
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <form class="session" action="" method="post">
        <input type="submit" name="session" value="Unset Session">
    </form>
    <div>
        <?php
        if(isset($_SESSION['logged'])){
            switch ($_SESSION['logged']) {
                case '1':
                    require_once 'admin.php';
                    break;
                case '2':
                    require_once 'user.php';
                    break;
            }
        }else{
            require_once 'main.php';
        }
        ?>
    </div>


</body>
</html> 