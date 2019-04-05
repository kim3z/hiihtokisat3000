<?php

  /**
    * @author Kim
    */
  require_once './onko_admin_kayttaja.php';
  require_once '../kantayhteys.php';
  require_once '../classes/Sarja.php';

  if (!isset($_POST['sarja_max']) ||
      !isset($_POST['sarja_min']) ||
      !isset($_POST['sukupuoli']) ||
      !isset($_POST['kisaId']) ||
      !isset($_POST['sarjaId'])
  ) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error: täytä kaikki kentät</h1><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }
  $kilpailun_sarjaId = (int)$_POST['sarjaId'];
  $kilpailun_sarja_max = $_POST['sarja_max'];
  $kilpailun_sarja_min = $_POST['sarja_min'];
  $kilpailun_sukupuoli = $_POST['sukupuoli'];
  $kilpailun_Id = $_POST['kisaId'];

  if ($kilpailun_sarja_max <= $kilpailun_sarja_min) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>Max ika on oltava isompi kuin min ika</p><br> <a class="btn btn-primary" href="../sovellus/uusi_sarja.php"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  if (Sarja::onkoSarjaOlemassa($kilpailun_sarja_min, $kilpailun_sarja_max, $kilpailun_sukupuoli, $kilpailun_Id)) {
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>Sarja on jo olemassa</p><br> <a class="btn btn-primary" href="../sovellus/uusi_sarja.php"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  $stmt = $conn->prepare('UPDATE sarja SET max_ika = ?, min_ika = ?, kisaId = ?, sukupuoli = ? WHERE id = ?');
  $stmt->bind_param(
              'iiiii',
              $kilpailun_sarja_max, $kilpailun_sarja_min, $kilpailun_Id, $kilpailun_sukupuoli, $kilpailun_sarjaId
  );


  if ($stmt->execute()) {
    header('Location: index.php');
  } else {
    $conn->close();
    include_once './sovellus_header.php';
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error</h1><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  $conn->close();
 ?>
