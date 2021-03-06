<?php 
    /**
     * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
     * 
     * Sisäänkirjautumis lomake
     * 
     * Ajax requesti löytyy tiedostosta hiihtokisat.js funktio initLogin().
     * 
     */

    include_once './header.php';
?>

<section id="login-form-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <div class="login-top-border bg-primary"></div>
                <div class="login-form-wrapper border-left border-right border-bottom">
                    <form id="login-form" method="post">
                        <h2>Kirjaudu sisään</h2>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" />
                        </div>
                        <div class="form-group">
                            <label for="salasana">Salasana</label>
                            <input class="form-control" type="password" name="salasana" />
                        </div>
                        <div style="display: none;" id="alert-login-failed" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div style="display: none;" id="login-form-spinner" class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="login" value="Kirjaudu sisään" />
                    </form>
                </div>
            </div>
        </div>
    </div>
  </section>

<?php 
    include_once './footer.php';
?>
