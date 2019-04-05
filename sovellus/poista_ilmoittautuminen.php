<?php
require_once './onko_tavallinen_kayttaja.php';
require_once '../classes/Osallistuminen.php';

if (!isset($_GET['id'])) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa id parametri puuttuu</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

if (Osallistuminen::poistaOsallistuminen($_GET['id'], $_SESSION['user']['id'])) {
    header('Location: index.php');
} else {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>Poistaminen epaonnistui</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

?>