
<?php

  require_once '../kantayhteys.php';

  $kilpailun_sarja_max = $_POST['sarja_max'];
  $kilpailun_sarja_min = $_POST['sarja_min'];
  $kilpailun_sukupuoli = $_POST['sukupuoli'];
  $kilpailun_Id = $_POST['kisaId'];

  $stmt = $conn->prepare('INSERT INTO sarja (max_ika, min_ika, kisaId, sukupuoli) VALUES (?, ?, ?, ?)');
  $stmt->bind_param(
              'iiii',
              $kilpailun_sarja_max, $kilpailun_sarja_min, $kilpailun_Id, $kilpailun_sukupuoli 


  );

  if ($stmt->execute()) {
      echo 'Tallennettu';
  } else {
    echo 'Ei toiminut';
  }

  $conn->close();
 ?>
