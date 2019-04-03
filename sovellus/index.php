<?php
  /**
    * @author Kim ja Alimu
    */
    require_once './onko_tavallinen_kayttaja.php';
    include_once './sovellus_header.php';
    include_once '../classes/Kisa.php';
    include_once '../classes/Sarja.php';
?>
  <section id="sovellus-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <h2>Kilpailut</h2>
            <ul class="list-group">
              <?php
                  $kisat = Kisa::kaikkiKisat();

                  foreach ($kisat as $kisa) {
                    echo '<li class="list-group-item">';
                    echo '<h4>' . $kisa['nimi'] .'   '.$kisa['date'].'   '.$kisa['aika'] . '</h4><br>';
                    $kisanSarjat = Sarja::sarjat($kisa['id']);
                    if ($kisanSarjat) {
                        echo '<p><strong>Sarjat:</strong></p>';
                        echo '<ul>';
                        foreach ($kisanSarjat as $sarja) {
                            if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                                echo '<li>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</li>';
                            } else {
                                echo '<li>TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</li>';
                            }
                        }
                        echo '</ul>';
                    }

                    echo '</li>';
                  }
               ?>
            </ul>
            </div>
        </div>
    </div>
  </section>

<?php
    include_once './sovellus_footer.php';
?>
