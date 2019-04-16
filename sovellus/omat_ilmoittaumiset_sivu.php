<?php
  require_once './onko_tavallinen_kayttaja.php';
  include_once './sovellus_header.php';
  require_once '../classes/Osallistuminen.php';
  require_once '../classes/Kisa.php';
  require_once '../classes/Sarja.php';
?>

 <section>
   <div class="container">
     <div class="row">
       <div class="col-lg-8 mx-auto">
         <h2>Omat ilmoittautumiset</h2>
         <?php
            $osallistumiset = Osallistuminen::kayttajanOsallistumiset($_SESSION['user']['id']);

            if (sizeof($osallistumiset) === 0) {
              echo '<div>Ei löytynyt</div>';
              include_once './sovellus_footer.php';
              return;
            }

            echo '<div class="border rounded table-responsive table-body" style="padding: 1rem;">';
            
            if (sizeof($osallistumiset) === 1) {
              echo '<table class="table table-borderless"><tbody>';
            } else {
              echo '<table class="table"><tbody>';
            }

            foreach ($osallistumiset as $osallistuminen) {
              $kisa = Kisa::haeKisa($osallistuminen['kisaId']);

              if (!isset($kisa)) {
                echo 'Kisa ei löydetty';
              }

              $sarja = Sarja::haeSarja($osallistuminen['sarjaId']);
              
              if (!isset($sarja)) {
                echo 'Sarja ei löydetty';
              }

              $kisaDate = $kisa['date'];
              $kisaAika = $kisa['aika'];
              $eiSaaPoistaaEnaa = date('Y-m-d H:i:s', strtotime("$kisaDate $kisaAika")) < date('Y-m-d H:i:s');

              echo '<tr>';
              echo '<td>' . $kisa['nimi'] .' '. $kisa['date'] .' '. $kisa['aika'] . '</td>';
              if ($eiSaaPoistaaEnaa) {
                echo '<td>Poistaminen liian myöhäistä</td>';
              } else {
                echo '<td>' . '<a href="poista_ilmoittautuminen.php?kisa_id='. $kisa['id'] . '" class="btn btn-danger">Poista</a>' . '</td>';
              }
              
              echo '</tr>';
            }
            echo '</tbody></table>';
            echo '</div>';
        ?>
       </div>
     </div>
   </div>
 </section>

 <?php
     include_once './sovellus_footer.php';
 ?>
