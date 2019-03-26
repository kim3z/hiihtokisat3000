<?php 
    include_once './header.php';
    include_once './classes/Seura.php'
?>

  <section id="register-form-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Rekisteröidy</h2>
          <div style="display: none;" id="alert-register-success" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div style="display: none;" id="alert-register-failed" class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div style="display: none;" id="register-form-spinner" class="text-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <form id="register-form" method="post">
            <div class="form-group">
                <label for="email">Sähköpostiiii</label>
                <input required class="form-control" type="text" name="email"   />
            </div>
            <div class="form-group">
                <label for="etunimi">Etunimi</label>
                <input required class="form-control" type="text" name="etunimi"   />
            </div>
            <div class="form-group">
                <label for="sukunimi">Sukunimi</label>
                <input required class="form-control" type="text" name="sukunimi"   />
            </div>
            <div class="form-group">
                <label for="syntymaAika">Syntymäaika</label>
                <input required class="form-control" type="date" name="syntymaAika" id="syntymaAika"   />
            </div>
            <div class="form-group">
                <label for="seuraId">Seura</label>
                <select required class="form-control" name="seuraId" id="seuraId">
                  <?php
                    $seurat = Seura::kaikkiSeurat();

                    foreach ($seurat as $seura) {
                      echo '<option value="' . $seura['id'] . '">' . $seura['nimi'] . '</option>';
                    }
                  ?>
                </select>
            </div>
            <div class="form-group">
                <label for="salasana">Salasana</label>
                <input required class="form-control" type="password" name="salasana"   />
            </div>

            <input type="submit" class="btn btn-primary" value="Rekisteröidy" />
        </form>
        </div>
      </div>
    </div>
  </section>

<?php 
    include_once './footer.php';
?>