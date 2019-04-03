<?php
session_start();
require_once './onko_admin_kayttaja.php';
require_once '../classes/Kisa.php';

if (!isset($_GET['id'])) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa id parametri puuttuu</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

if (Kisa::poistaKisanSarjat($_GET['id'])) {
    if (Kisa::poistaKisa($_GET['id'])) {
        header('Location: index.php');
    } else {
        include_once './sovellus_header.php';
        echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>Kisan poistaminen epaonnistui</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
        include_once './sovellus_footer.php';
        return;
    }
} else {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>Kisan sarjojen poistaminen epaonnistui, joten kisan poistaminen epaonnistui myos</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

?>