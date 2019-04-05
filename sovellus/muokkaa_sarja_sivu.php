<?php
  require_once './onko_admin_kayttaja.php';
  include_once './sovellus_header.php';
  require_once '../classes/Sarja.php';
  include_once '../classes/Kisa.php';

  if (!isset($_GET['id'])) {
      echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>sarja id parametri puuttuu</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
      return;
    }

  $sarja = Sarja::haeSarja($_GET['id']);

  if ($sarja== null){
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>sarja ei löydetty</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    return;
  }
?>

<section >
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h2>Muokkaa sarja</h2>
        <form method="post" action="muokkaa_sarja.php">
          <div class="form-group">
              <label for="sarja_min">Minimi Ikä</label>
              <input required class="form-control" type="number" name="sarja_min" min="4" value="<?php echo $sarja['min_ika']; ?>" />
          </div>
          <div class="form-group">
              <label for="sarja_max">Maksimi Ikä</label>
              <input required class="form-control" type="number" name="sarja_max" min="5" max="99" value="<?php echo $sarja['max_ika']; ?>" />
          </div>
          <div class="form-group">
              <label for="sukupuoli">Sukupuoli</label>
              <select required class="form-control" name="sukupuoli">
                <?php
                    if ($sarja['sukupuoli'] === 1) {
                        echo '<option value="1" selected>Mies</option>';
                    } else {
                        echo '<option value="1">Mies</option>';
                    }

                    if ($sarja['sukupuoli'] === 2) {
                        echo '<option value="2" selected>Nainen</option>';
                    } else {
                        echo '<option value="2">Nainen</option>';
                    }
                ?>
              </select>
          </div>
          <div class="form-group">
              <label for="kisaId">Kisa</label>
              <select required class="form-control" name="kisaId" >
                <?php
                  $kisat = Kisa::kaikkiKisat();

                  foreach ($kisat as $kisa) {
                    if ($sarja['kisaId'] === $kisa['id']) {
                        echo '<option value="' . $kisa['id'] . '" selected>' . $kisa['nimi'] .' '. $kisa['date'].' '.$kisa['aika'] . '</option>';
                    } else {
                        echo '<option value="' . $kisa['id'] . '">' . $kisa['nimi'] .' '. $kisa['date'].' '.$kisa['aika'] . '</option>';
                    }
                  }
                ?>
              </select>
          </div>
          <input type="hidden" name="sarjaId" value="<?php echo $sarja['id']; ?>">
          <input type="submit" class="btn btn-primary" value="Submit" />
      </form>
      </div>
    </div>
  </div>
</section>

<?php
  include_once './sovellus_footer.php';
 ?>
