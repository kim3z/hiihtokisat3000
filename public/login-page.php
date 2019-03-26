<?php 
    /**
     * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
     */

    include_once './header.php';
?>

<section id="login-form-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <div style="display: none;" id="alert-login-failed" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mx-auto">
            <h2>Kirjaudu sisään</h2>
            <form id="login-form" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" />
                </div>
                <input type="submit" class="btn btn-primary" name="login" value="Kirjaudu sisään" />
            </form>
            </div>
        </div>
    </div>
  </section>

<?php 
    include_once './footer.php';
?>
