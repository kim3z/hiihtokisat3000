<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */
include_once '../classes/User.php';

$newUser = [
    'etunimi' => $_POST['etunimi'],
    'sukunimi' => $_POST['sukunimi'],
    'email' => $_POST['email'],
    'salasana' => password_hash($_POST['salasana'], PASSWORD_DEFAULT),
    'seuraId' => $_POST['seuraId'],
    'syntymaAika' => $_POST['syntymaAika'],
    'sukupuoli' => $_POST['sukupuoli'],
    'rooli' => User::$NORMAL_USER,
];

if (User::registerUser($newUser)) {
    echo 'true';
    // header('Location: ../kirjaudu_sisaan.php?register_success=true');
} else {
    echo 'false';
}

?>
