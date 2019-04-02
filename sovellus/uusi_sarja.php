<?php
  require_once './onko_admin_kayttaja.php';
  include_once './sovellus_header.php';
  include_once '../classes/Kisa.php';
?>

<section id="register-form-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h2>Uusi sarja</h2>
        <form method="post" action="tallenna_sarja.php">
          <div class="form-group">
              <label for="sarja_max">Maksimi Ikä</label>
              <input required class="form-control" type="number" name="sarja_max"   />
          </div>
          <div class="form-group">
              <label for="sarja_min">Minimi Ikä</label>
              <input required class="form-control" type="number" name="sarja_min"   />
          </div>
          <div class="form-group">
              <label for="sukupuoli">Sukupuoli</label>
              <select required class="form-control" name="sukupuoli">
                <option value="1">Mies</option>
                <option value="2">Nainen</option>
              </select>
          </div>
          <div class="form-group">
              <label for="kisaId">Kisa</label>
              <select required class="form-control" name="kisaId" >
                <?php
                  $kisat = Kisa::kaikkiKisat();

                  foreach ($kisat as $kisa) {
                    echo '<option value="' . $kisa['id'] . '">' . $kisa['nimi'] .' '. $kisa['date'].' '.$kisa['aika'] . '</option>';
                  }
                ?>
              </select>
          </div>
          <input type="submit" class="btn btn-primary" value="Submit" />
      </form>
      </div>
    </div>
  </div>
</section>

<?php
  include_once './sovellus_footer.php';
 ?>
