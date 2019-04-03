<?php
  /**
    * @author Kim
    */
    require_once './onko_tavallinen_kayttaja.php';
    include_once './sovellus_header.php';
    include_once '../classes/Seura.php';
    include_once '../classes/User.php';
?>
  <section id="sovellus-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <h2>Profiili</h2>
            <div>
            <?php if (isset($_SESSION['user'])): ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div><strong>Etunimi:</strong> <?php echo $_SESSION['user']['etunimi']; ?></div>
                    </li>
                    <li class="list-group-item">
                        <div><strong>Sukunimi:</strong> <?php echo $_SESSION['user']['sukunimi']; ?></div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            <strong>Seura:</strong> 
                            <?php 
                             $seura_id =  $_SESSION['user']['seuraId'];

                             $seura = Seura::seuraNimi($seura_id);

                             if (isset($seura)) {
                                echo $seura;
                             } else {
                                echo 'Ei löytynyt';
                             }
                            ?>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div><strong>Email:</strong> <?php echo $_SESSION['user']['email']; ?></div>
                    </li>
                    <li class="list-group-item">
                        <div><strong>Syntymäaika:</strong> <?php echo $_SESSION['user']['syntymaAika']; ?></div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            <strong>Sukupuoli:</strong>
                            <?php 
                                $sukupuoli_id = $_SESSION['user']['sukupuoli'];

                                if ($sukupuoli_id === User::$GENDER_MALE) {
                                    echo 'Mies';
                                } else if ($sukupuoli_id === User::$GENDER_FEMALE) {
                                    echo 'Nainen';
                                } else {
                                    echo '';
                                }
                            ?>
                        </div>
                    </li>
                </ul>
            <?php endif; ?>
            </div>
            <br>
            <a href="muokkaa_profiili_sivu.php" class="btn btn-primary">
                Muokkaa
            </a>
            </div>
        </div>
    </div>
  </section>

<?php
    include_once './sovellus_footer.php';
?>
