<?php
  /**
    * @author Kim ja Alimu
    */
    require_once './onko_tavallinen_kayttaja.php';
    include_once './sovellus_header.php';
    include_once '../classes/Kisa.php';
    include_once '../classes/Sarja.php';
    include_once '../classes/User.php';
    include_once '../classes/Osallistuminen.php';
?>
  <section id="sovellus-dashboard">
    <div class="container">
        <div class="row">
            <di class="col-lg-8 mx-auto">
            <h2>Kilpailut</h2>
              <?php
                  $kisat = Kisa::kaikkiKisat();

                  foreach ($kisat as $kisa) {

                    echo '<div class="border rounded table-responsive table-body" style="padding: 1rem;">';

                    if ($_SESSION['user']['rooli'] === User::$ADMIN_USER) {
                        echo '<h4>' . $kisa['nimi'] .'   '.$kisa['date'].'   '.$kisa['aika'] . ' ' . '<a href="muokkaa_kisa_sivu.php?id='. $kisa['id'] . '" class="btn btn-primary">Muokkaa</a>'.' '. '<a href="poista_kisa.php?id='. $kisa['id'] . '" class="btn btn-danger">Poista kisa</a>' . '</h4><br>';
                    } else {
                        if (!Osallistuminen::kayttajaOnJoRekisteroinyt($kisa['id'], $_SESSION['user']['id'])) {
                            echo '<h4>' . $kisa['nimi'] .'   '.$kisa['date'].'   '.$kisa['aika'] . ' ' . '<a href="ilmoittaudu_kisa_sivu.php?id='. $kisa['id'] . '" class="btn btn-primary">Ilmoittaudu</a>'. '</h4><br>';
                        } else {
                            echo '<h4>' . $kisa['nimi'] .'   '.$kisa['date'].'   '.$kisa['aika'] . ' ' . '<a href="poista_ilmoittautuminen.php?id='. $kisa['id'] . '" class="btn btn-danger">Poista ilmoittautuminen</a>'. '</h4><br>';
                        }
                    }

                    $kisanSarjat = Sarja::sarjat($kisa['id']);
                    if ($kisanSarjat) {
                        echo '<p><strong>Sarjat:</strong></p>';
                        echo '<table class="table"><tbody>';
                        foreach ($kisanSarjat as $sarja) {
                            echo '<tr>';
                            if ($_SESSION['user']['rooli'] === User::$ADMIN_USER) {
                                if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                                    echo '<td>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td><td>' . '<a href="muokkaa_sarja_sivu.php?id='. $sarja['id'] . '" class="btn btn-primary">Muokkaa</a>' . '</td><td>' . '<a href="poista_sarja.php?id='. $sarja['id'] . '" class="btn btn-danger">Poista</a>' . '</td>';
                                } else {
                                    echo '<td>TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td><td>' . '<a href="muokkaa_sarja_sivu.php?id='. $sarja['id'] . '" class="btn btn-primary">Muokkaa</a>' . '</td><td>' . '<a href="poista_sarja.php?id='. $sarja['id'] . '" class="btn btn-danger">Poista</a>' . '</td>';
                                }
                            } else {
                                if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                                    echo '<td>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td>';
                                } else {
                                    echo '<td>TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td>';
                                }
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
    </div>
  </section>

<?php
    include_once './sovellus_footer.php';
?>
