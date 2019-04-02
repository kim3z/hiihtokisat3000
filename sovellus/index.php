<?php
  /**
    * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
    */
    require_once './onko_tavallinen_kayttaja.php';
    include_once './sovellus_header.php';
?>
  <section id="sovellus-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <h2>Kilpailut</h2>
            <ul class="list-group">
              <?php
                  include_once './tulosta_kisat.php';
                  foreach ($kisat as $kisa) {
                    echo '<li class="list-group-item">';
                    echo $kisa['nimi'] .'   '.$kisa['date'].'   '.$kisa['aika'] . '<br>';
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
