<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

include_once './Database/DB.php';
include_once './Database/Models/User.php';

$db = new DB();
$dbConn = $db->newConnection();

$user = new User($dbConn);

$user->username = isset($_POST['username']) ? $_POST['username'] : die();
$user->password = isset($_POST['password']) ? $_POST['password'] : die();

if ($user->login()) {
  echo 'true';
} else {
  echo 'false';
}
