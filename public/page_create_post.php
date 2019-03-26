<?php 
    //require_once './authenticate.php';
    include_once './layout/site_header.php';
?>

<section id="create-post-form-section">
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
            <div class="col-lg-8 mx-auto">
            <?php // $_SESSION['user'] ?>
            <h2>Uusi postaus</h2>
            <div style="display: none;" id="alert-create-post-success" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="display: none;" id="alert-create-post-failed" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="display: none;" id="create-post-form-spinner" class="text-center">
                <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form id="create-post-form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Otsikko</label>
                    <input class="form-control" type="text" name="title" />
                </div>
                <div class="form-group">
                    <label for="title">Teksti</label>
                    <textarea class="form-control" id="summernote" rows="5" type="text" name="content"></textarea>
                </div>
                <div class="form-group">
                    <label for="post-category">Kategoria</label>
                    <select name="post-category" class="form-control" id="post-category">
                        <option value="1">Tekniikka</option>
                        <option value="2">Urheilu</option>
                        <option value="3">Matkailu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="create-post-img">Kuva</label>
                    <input type="file" class="form-control-file" id="create-post-img" name="create-post-img" />
                </div>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>">
                <input type="submit" class="btn btn-success" name="login" value="Lisää" />
            </form>
            </div>
        </div>
    </div>
  </section>

<?php 
    include_once './layout/site_footer.php';
?>
