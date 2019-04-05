<?php 
  /**
    * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
    */
  
  include_once './header.php';
  include_once './classes/Kisa.php';
  include_once './classes/Sarja.php';
  include_once './classes/Osallistuminen.php';
?>
  <div class="hero-image">
    <div class="hero-text">
      <br><br>
      <h1 style="font-size: 80px;">Kråkolman Puhti</h1>
    </div>
  </div>

  <section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <h2>Kilpailut</h2>
              <?php
                  $kisat = Kisa::kaikkiKisat();

                  foreach ($kisat as $kisa) {

                    echo '<div class="border rounded table-responsive table-body" style="padding: 1rem;">';

                    echo '<h4>' . $kisa['nimi'] .'   '.$kisa['date'].'   '.$kisa['aika'] . '</h4><br>';

                    $kisanSarjat = Sarja::sarjat($kisa['id']);
                    if ($kisanSarjat) {
                        echo '<p><strong>Sarjat:</strong></p>';
                        echo '<table class="table"><tbody>';
                        foreach ($kisanSarjat as $sarja) {
                            echo '<tr>';
                            if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                              echo '<td>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td>';
                              echo '<td><a href="tulosseuranta_sivu.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Tulosseuranta</a></td>';
                            } else {
                                echo '<td>TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td>';
                                echo '<td><a href="tulosseuranta_sivu.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Tulosseuranta</a></td>';
                            }
                            echo '</tr>';
                        }
                        echo '</tbody></table>';
                    } else {
                        echo 'Sarjoja ei ole vielä lisätty';
                    }

                    echo '</div><br>';
                  }
               ?>
        </div>
    </div>
  </section>

<?php 
  include_once './footer.php';
?>