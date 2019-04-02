
<?php

  require_once '../kantayhteys.php';

  $kilpailun_nimi = $_POST['kilpailun_nimi'];
  $kilpailun_paiva = $_POST['kilpailun_paiva'];
  $kilpailun_aika = $_POST['kilpailun_aika'];

  $stmt = $conn->prepare('INSERT INTO kisa (nimi, date, aika) VALUES (?, ?, ?)');
  $stmt->bind_param(
              'sss',
              $kilpailun_nimi , $kilpailun_paiva , $kilpailun_aika


  );

  if ($stmt->execute()) {
      echo 'Tallennettu';
  } else {
    echo 'Ei toiminut';
  }

  $conn->close();
 ?>
