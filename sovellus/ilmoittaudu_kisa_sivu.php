<?php
  require_once './onko_tavallinen_kayttaja.php';
  include_once './sovellus_header.php';
  include_once '../classes/Kisa.php';
  include_once '../classes/Sarja.php';
  include_once '../classes/Osallistuminen.php';

  if (!isset($_GET['id'])) {
      echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa id parametri puuttuu</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
      include_once './sovellus_footer.php';
      return;
    }

  $kisa = Kisa::haeKisa($_GET['id']);

  if ($kisa == null){
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa ei löydetty</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  if (Osallistuminen::kayttajaOnJoRekisteroinyt($kisa['id'], $_SESSION['user']['id'])) {
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error: olet jo ilmoittautunut</h1><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    include_once './sovellus_footer.php';
    return;
  }

  $ika = $_SESSION['user']['syntymaAika'];
  $date = new DateTime($ika);
  $now = new DateTime();
  $interval = $now->diff($date);
  $ika = (int)$interval->y;

  $sarja = Sarja::haeSopivaSarja($kisa['id'], $ika, $_SESSION['user']['sukupuoli']);

  if ($sarja == null){
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>ei löydetty sopivaa sarjaa</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    return;
  }

 ?>

 <section >
   <div class="container">
     <div class="row">
       <div class="col-lg-8 mx-auto">
          <a class="btn btn-primary" href="../sovellus"> < Takaisin </a>
          <br><br>
          <h2>Ilmoittaudu kilpailuun</h2>
          <form method="post" action="tallenna_ilmoittautuminen.php">
          <ul class="list-group">
            <li class="list-group-item"><?php echo '<strong>Kilpailu: </strong>' . $kisa['nimi'] .'   '.$kisa['date'].'   '.$kisa['aika']; ?></li>
            <li class="list-group-item">
              <?php
              if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                  echo '<div><strong>Sarja: </strong>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</div>';
              } else {
                  echo '<div><strong>Sarja: </strong>TYTÖT/NAISET' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</div>';
              }
                ?>
            </li>
          </ul>
          <input type="hidden" name="kisa_Id" value="<?php echo $kisa['id']; ?>">
          <input type="hidden" name="sarja_Id" value="<?php echo $sarja['id']; ?>">
          <input type="hidden" name="user_Id" value="<?php echo $_SESSION['user']['id']; ?>">
          <br>
          <input type="submit" class="btn btn-primary" value="Tallenna ilmoittautuminen" />
       </form>
       </div>
     </div>
   </div>
 </section>

 <?php
     include_once './sovellus_footer.php';
 ?>
