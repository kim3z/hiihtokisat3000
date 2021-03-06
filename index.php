<?php 
  /**
    * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
    * 
    * SOVELLUKSEN LANDING PAGE
    *
    * Tulostetaan kaikki kisat ja niiden sarjat.
    * Linkit kisan kaikki sarjojen tulosseurantaan tai yksittäisen sarjan tulosseurantaan.
    *
    */
  
  include_once './header.php';
  include_once './classes/Kisa.php';
  include_once './classes/Sarja.php';
  include_once './classes/Osallistuminen.php';
?>
  <div class="hero-image">
    <div class="hero-text">
      <br><br>
      <h1 style="font-size: 80px;">Kråkholman Puhti</h1>
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

                    echo '<h4>' . $kisa['nimi'] .'   '.$kisa['date'].'   '.$kisa['aika'] . ' ' . '<a href="tulosseuranta_kisa_sivu.php?kisa_id='. $kisa['id'] . '" class="btn btn-primary">Tulosseuranta (kaikki sarjat)</a>' . '</h4><br>';

                    $kisanSarjat = Sarja::sarjat($kisa['id']);
                    if ($kisanSarjat) {
                        echo '<p><strong>Sarjat:</strong></p>';
                        echo '<table class="table"><tbody>';
                        foreach ($kisanSarjat as $sarja) {
                            echo '<tr>';
                            if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                              echo '<td>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td>';
                              echo '<td><a href="tulosseuranta_kisa_sarja_sivu.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Tulosseuranta</a>' . ' ' . '<a href="lahtolista_sivu.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Lahtolista</a></td>';
                            } else {
                                echo '<td>TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td>';
                                echo '<td><a href="tulosseuranta_kisa_sarja_sivu.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Tulosseuranta</a>' . ' ' . '<a href="lahtolista_sivu.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Lahtolista</a></td>';
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