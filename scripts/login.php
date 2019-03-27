<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

include_once '../kantayhteys.php';
include_once './classes/User.php';

$user = new User($conn);

$user->username = isset($_POST['username']) ? $_POST['username'] : die();
$user->password = isset($_POST['password']) ? $_POST['password'] : die();

if ($user->login()) {
  header('Location: sovellus/index.php');
} else {
  echo 'false';
}
