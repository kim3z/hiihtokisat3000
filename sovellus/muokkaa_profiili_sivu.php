<?php
    require_once './onko_tavallinen_kayttaja.php';
    include_once './sovellus_header.php';
    include_once '../classes/Seura.php'
?>

  <section id="register-form-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
            <a class="btn btn-primary" href="../sovellus/profiili_sivu.php"> < Takaisin </a>
            <br><br>
            <h2>Muokkaa profiili</h2>
            <form method="post" action="tallenna_muokkaa_profiili.php">
                <div class="form-group">
                    <label for="email">Sähköposti</label>
                    <input required class="form-control" type="text" name="email" value="<?php echo $_SESSION['user']['email']; ?>" />
                </div>
                <div class="form-group">
                    <label for="etunimi">Etunimi</label>
                    <input required class="form-control" type="text" name="etunimi" value="<?php echo $_SESSION['user']['etunimi']; ?>"   />
                </div>
                <div class="form-group">
                    <label for="sukunimi">Sukunimi</label>
                    <input required class="form-control" type="text" name="sukunimi" value="<?php echo $_SESSION['user']['sukunimi']; ?>"   />
                </div>
                <div class="form-group">
                    <label for="syntymaAika">Syntymäaika</label>
                    <input required class="form-control" type="date" name="syntymaAika" id="syntymaAika" value="<?php echo $_SESSION['user']['syntymaAika']; ?>"  />
                </div>
                <div class="form-group">
                    <label for="syntymaAika">Sukupuoli</label>
                    <select required class="form-control" name="sukupuoli" id="sukupuoli">

                    <?php 
                        if ($_SESSION['user']['sukupuoli'] === 1) {
                            echo '<option value="1" selected>Mies</option>';
                        } else {
                            echo '<option value="1">Mies</option>';
                        }
                    ?>
                    <?php 
                        if ($_SESSION['user']['sukupuoli'] === 2) {
                            echo '<option value="2" selected>Nainen</option>';
                        } else {
                            echo '<option value="2">Nainen</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="seuraId">Seura</label>
                    <select required class="form-control" name="seuraId" id="seuraId">
                    <?php
                        $seurat = Seura::kaikkiSeurat();

                        foreach ($seurat as $seura) {
                            if ($_SESSION['user']['seuraId'] === $seura['id']) {
                                echo '<option value="' . $seura['id'] . '" selected>' . $seura['nimi'] . '</option>';
                            } else {
                                echo '<option value="' . $seura['id'] . '">' . $seura['nimi'] . '</option>';
                            }
                        }
                    ?>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" value="Tallenna" />
            </form>
        </div>
      </div>
    </div>
  </section>

<?php
    include_once './sovellus_footer.php';
?>
