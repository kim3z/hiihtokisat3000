<?php
  require_once './onko_admin_kayttaja.php';
  include_once './sovellus_header.php';
?>

<section id="register-form-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h2>Uusi kisa</h2>
        <form method="post" action="tallenna_kisa.php">
          <div class="form-group">
              <label for="kilpailun_nimi">Kilpailun nimi</label>
              <input required class="form-control" type="text" name="kilpailun_nimi"   />
          </div>
          <div class="form-group">
              <label for="kilpailun_paiva">Kilpailun päivä</label>
              <input required class="form-control" type="date" name="kilpailun_paiva" min=<?php echo date('Y-m-d'); ?>   />
          </div>
          <div class="form-group">
              <label for="kilpailun_aika">Kilpailun aika</label>
              <input required class="form-control" type="time" name="kilpailun_aika"   />
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
