<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

include_once '../classes/User.php';

$user = [
  'email' => isset($_POST['email']) ? $_POST['email'] : die(),
  'salasana' =>  isset($_POST['salasana']) ? $_POST['salasana'] : die(),
];

if (User::login($user['email'], $user['salasana'])) {
  echo 'true';
} else {
  echo 'false';
}
