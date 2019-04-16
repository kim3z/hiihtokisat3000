<?php
/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

date_default_timezone_set('Europe/Helsinki');
setlocale(LC_TIME, "fi_FI");

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Hiihtokisat 3000</title>

  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/hiihtokisat.css" rel="stylesheet">
  <style>
  /* Hero image css from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_hero_image */
  body, html {
    height: 100%;
    margin: 0;
  }
  .hero-image {
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/img/skiing.jpg');
  height: 80%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

.hero-text button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 10px 25px;
  color: black;
  background-color: #ddd;
  text-align: center;
  cursor: pointer;
}

.hero-text button:hover {
  background-color: #555;
  color: white;
}
/*./hero-image css*/

.card-img-top, .single-post-img {
  width: 100%;
  height: 20vw;
  object-fit: cover;
}

@media only screen and (max-width: 650px) {
  .single-post-img, .card-img-top {
    height: 50vw;
  }
}

.single-post-title-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
}

.single-post-title {
  border-bottom: 1px solid #000;
  padding-bottom: 3px;
  display: inline-block;
}

.login-form-wrapper {
  border-bottom-left-radius: 0.5rem;
  border-bottom-right-radius: 0.5rem;
}

#login-form {
  margin-left: 2rem;
  margin-right: 2rem;
  margin-bottom: 2rem;
  padding-top: 1.5rem;
}

.login-top-border {
  height: 2rem;
  border-top-left-radius: 0.5rem;
  border-top-right-radius: 0.5rem;
}
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="/">K-Puhti</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Etusivu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tulosseuranta.php">Tulosseuranta</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/sovellus">Sovellus</a>
          </li>
          
          <?php if (isset($_SESSION['user'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="./scripts/logout.php">Kirjaudu ulos</a>
            </li>
          <?php } ?>

          <?php if (!isset($_SESSION['user'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="rekisteroidy_sivu.php">Rekisteröidy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-primary text-white" href="kirjaudu_sisaan_sivu.php">Kirjaudu sisään</a>
            </li>
          <?php } ?>

        </ul>
      </div>
    </div>
  </nav>
