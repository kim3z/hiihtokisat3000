<?php

require_once '../classes/User.php';

/**
 * Käytä tämä tiedosto jos haluat että käyttäjän
 * on oltava sisäänkirjautunut (admin kayttaja).
 * 
 * Laita tiedoston alkuun esim:
 * <?php require_once './onko_admin_kayttaja.php' ?>
 */


session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../kirjaudu_sisaan_sivu.php');
}

if (isset($_SESSION['user']) && $_SESSION['user']['rooli'] !== User::$ADMIN_USER) {
    header('Location: ../kirjaudu_sisaan_sivu.php');
}
