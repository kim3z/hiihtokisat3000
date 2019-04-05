<?php
require_once './onko_admin_kayttaja.php';
require_once '../classes/Sarja.php';

if (!isset($_GET['id'])) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>sarja id parametri puuttuu</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

if (Sarja::poistaSarja($_GET['id'])) {
    header('Location: index.php');
} else {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>Sarjan poistaminen epaonnistui</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

?>