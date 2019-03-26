<?php 
    include_once './header.php';
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
                <label for="username">Käyttäjätunnus</label>
                <input class="form-control" type="text" name="username" autocomplete="off" />
            </div>

            <div class="form-group">
                <label for="password">Salasana</label>
                <input class="form-control" type="password" name="password" autocomplete="off" />
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