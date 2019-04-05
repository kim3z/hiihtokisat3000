<?php

  /**
    * @author Alimu ja Kim
    */

  require_once './onko_tavallinen_kayttaja.php';
  require_once '../kantayhteys.php';
  require_once '../classes/Sarja.php';
  require_once '../classes/Osallistuminen.php';

  if (!isset($_POST['kisa_Id']) ||
      !isset($_POST['sarja_Id']) ||
      !isset($_POST['user_Id']) ||
      !isset($_POST['kisaId'])
  ) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error: täytä kaikki kentät</h1><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  if ($_SESSION['user']['id'] !== $_POST['user_Id']) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error: et ole olemassa</h1><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  $kisa_id = $_POST['kisa_Id'];
  $sarja_id = $_POST['sarja_Id'];
  $user_id = $_POST['user_Id'];

  $jarjestys_numero = rand(1,100);
  while (Osallistuminen::onkoJarjestysNumeroOlemassa($kisa_id, $sarja_id, $jarjestys_numero) {
    $jarjestys_numero = rand(1,100);
  }

  $stmt = $conn->prepare('INSERT INTO osallistuminen (userId, kisaId, sarjaId, jarjestysNumero) VALUES (?, ?, ?, ?)');
  $stmt->bind_param(
              'iiii',
              $user_id, $kisa_id, $sarja_id, $jarjestys_numero
  );

  if ($stmt->execute()) {
    header('Location: index.php');
  } else {
    echo 'Ei toiminut';
  }

  $conn->close();
?>
