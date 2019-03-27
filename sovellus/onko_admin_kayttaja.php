<?php

/**
 * Käytä tämä tiedosto jos haluat että käyttäjän
 * on oltava sisäänkirjautunut (admin kayttaja).
 * 
 * Laita tiedoston alkuun esim:
 * <?php require_once './onko_admin_kayttaja.php' ?>
 */


session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login-page.php');
}

if (isset($_SESSION['user']) && $_SESSION['user']['rooli'] !== 1) {
    header('Location: login-page.php');
}
