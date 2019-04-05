<?php

  /**
    * @author Alimu ja Kim
    */
  require_once './onko_admin_kayttaja.php';
  require_once '../kantayhteys.php';

  // Error jos jotain puuttuu
  if (!isset($_POST['kilpailun_nimi']) || !isset($_POST['kilpailun_paiva']) || !isset($_POST['kilpailun_aika']) || !isset($_POST['kilpailun_id'])) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error</h1><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  $kilpailun_nimi = $_POST['kilpailun_nimi'];
  $kilpailun_paiva = $_POST['kilpailun_paiva'];
  $kilpailun_aika = $_POST['kilpailun_aika'];
  $kilpailun_id = $_POST['kilpailun_id'];

  $stmt = $conn->prepare('UPDATE kisa SET nimi = ?, date = ?, aika = ? WHERE id = ?');
  $stmt->bind_param(
              'sssi',
              $kilpailun_nimi, $kilpailun_paiva, $kilpailun_aika, $kilpailun_id
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
