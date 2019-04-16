<?php
require_once './onko_tavallinen_kayttaja.php';
require_once '../classes/Osallistuminen.php';
require_once '../classes/Kisa.php';

if (!isset($_GET['kisa_id'])) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa id parametri puuttuu</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

$kisa = Kisa::haeKisa($_GET['kisa_id']);

// Katso voiko käyttäjä enää poistaa ilmoittautuminen
if (isset($kisa)) {
    $kisaDate = $kisa['date'];
    $kisaAika = $kisa['aika'];
    if (date('Y-m-d H:i:s', strtotime("$kisaDate $kisaAika")) < date('Y-m-d H:i:s')) {
        include_once './sovellus_header.php';
        echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>et pysty poistamaan kisaa enää</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
        include_once './sovellus_footer.php';
        return;
    }
} else {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa ei löydetty</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

if (Osallistuminen::poistaOsallistuminen($_GET['kisa_id'], $_SESSION['user']['id'])) {
    header('Location: index.php');
} else {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>Poistaminen epaonnistui</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
}

?>