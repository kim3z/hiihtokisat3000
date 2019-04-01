<?php

/**
 * Käytä tämä tiedosto jos haluat että käyttäjän
 * on oltava sisäänkirjautunut (tavallinen kayttaja).
 * 
 * Laita tiedoston alkuun esim:
 * <?php require_once './onko_tavallinen_kayttaja.php' ?>
 * 
 * Huom! Admin kayttaja nakee kylla sivun sisalto
 */


session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../kirjaudu_sisaan_sivu.php');
}
