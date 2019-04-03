<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */
session_start();
require_once './onko_tavallinen_kayttaja.php';
include_once '../classes/User.php';

if ($_SESSION['user']['email'] !== $_POST['email']) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>Authorization exception</p><br> <a class="btn btn-primary" href="../sovellus/uusi_sarja.php"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

if (
    !isset($_POST['etunimi']) ||
    !isset($_POST['sukunimi']) ||
    !isset($_POST['email']) ||
    !isset($_POST['seuraId']) ||
    !isset($_POST['syntymaAika']) ||
    !isset($_POST['sukupuoli'])
) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error</h1><br> <a class="btn btn-primary" href="../sovellus/profiili_sivu.php"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

$user = [
    'etunimi' => $_POST['etunimi'],
    'sukunimi' => $_POST['sukunimi'],
    'email' => $_POST['email'],
    'seuraId' => $_POST['seuraId'],
    'syntymaAika' => $_POST['syntymaAika'],
    'sukupuoli' => $_POST['sukupuoli'],
    'id' => $_SESSION['user']['id'],
];

if (User::updateUser($user)) {
    $updatedUser = User::getUserByEmail($_SESSION['user']['email']);

    if (isset($updatedUser)) {
        $_SESSION['user'] = $updatedUser;
        header('Location: profiili_sivu.php');
    } else {
        include_once './sovellus_header.php';
        echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>update failed</p><br> <a class="btn btn-primary" href="../sovellus/uusi_sarja.php"> < Takaisin</a><br><br></div>';
        include_once './sovellus_footer.php';
        return;
    }
} else {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>update failed</p><br> <a class="btn btn-primary" href="../sovellus/uusi_sarja.php"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

?>