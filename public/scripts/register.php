<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

include_once './Database/DB.php';
include_once './Database/Models/User.php';

$db = new DB();
$dbConn = $db->newConnection();

$user = new User($dbConn);

$user->username = $_POST['username'];
$user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if ($user->register()) {
    echo 'true';
    //header('Location: page_login.php?register_success=true');
} else {
    echo 'false';
    //header('Location: page_register.php?register_success=false');
}

?>
