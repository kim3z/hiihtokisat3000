<?php
  require_once './onko_admin_kayttaja.php';
  include_once './sovellus_header.php';
  require_once '../classes/Kisa.php';

  if (!isset($_GET['id'])) {
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa id parametri puuttuu</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    return;
  }

  $kisa = Kisa::haeKisa($_GET['id']);

  if ($kisa == null){
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa ei löydetty</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    return;
  }
?>

<section >
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h2>Muokkaa kisa</h2>
        <form method="post" action="muokkaa_kisa.php">
          <div class="form-group">
              <label for="kilpailun_nimi">Kilpailun nimi</label>
              <input required class="form-control" type="text" name="kilpailun_nimi" value="<?php echo $kisa['nimi']; ?>"  />
          </div>
          <div class="form-group">
              <label for="kilpailun_paiva">Kilpailun päivä</label>
              <input required class="form-control" type="date" name="kilpailun_paiva" value="<?php echo $kisa['date']; ?>"   />
          </div>
          <div class="form-group">
              <label for="kilpailun_aika">Kilpailun aika</label>
              <input required class="form-control" type="time" name="kilpailun_aika"  value="<?php echo $kisa['aika']; ?>" />
          </div>
          <input type="hidden" name="kilpailun_id" value="<?php echo $kisa['id']; ?>">
          <input type="submit" class="btn btn-primary" value="Submit" />
      </form>
      </div>
    </div>
  </div>
</section>

<?php
  include_once './sovellus_footer.php';
 ?>
