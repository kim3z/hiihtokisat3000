<?php

  /**
    * @author Alimu ja Kim
    */
  require_once './onko_admin_kayttaja.php';
  require_once '../kantayhteys.php';
  
  date_default_timezone_set('Europe/Helsinki');
  setlocale(LC_TIME, "fi_FI");

  // Error jos jotain puuttuu
  if (!isset($_POST['kilpailun_nimi']) || !isset($_POST['kilpailun_paiva']) || !isset($_POST['kilpailun_aika'])) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error</h1><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  $kilpailun_nimi = $_POST['kilpailun_nimi'];
  $kilpailun_paiva = $_POST['kilpailun_paiva'];
  $kilpailun_aika = $_POST['kilpailun_aika'];

  if ($kilpailun_paiva == date('Y-m-d') && $kilpailun_aika < date('H:i')) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error: aika on oltava vähintään ' . date('H:i') . ' koska kisa on jo tänään </h1><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  $stmt = $conn->prepare('INSERT INTO kisa (nimi, date, aika) VALUES (?, ?, ?)');
  $stmt->bind_param(
          'sss',
          $kilpailun_nimi, $kilpailun_paiva, $kilpailun_aika
  );


  if ($stmt->execute()) {
    // Jos tallennus onnistui, redirect etusivulle (sovellus)
    header('Location: index.php');
  } else {
    // Error jos tallennuksessa meni jotain pieleen
    $conn->close();
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error</h1><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  $conn->close();
 ?>