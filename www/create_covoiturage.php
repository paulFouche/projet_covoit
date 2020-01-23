<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>CovEvent</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <?php
    session_start();
    $email = $_SESSION["email"];
    $tel = $_SESSION["tel"];
    $id = $_SESSION["id"];

    if ($_SESSION["email"]==null){
      header('Location: index.php');
    }

  ?>
  <body class="bg-light">
  <?php 
  require('view/header.php'); 
  ?>

    <div class="container" style="margin-top: 4%">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h2>Creer un covoiturage</h2>
    <p class="lead"></p>
  </div>

  <div class="row justify-content-md-center">
    <form class="form-signin" action="create_covoiturage_script.php" method="POST">
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Inscription</h4>

        <select id="locality-dropdown" name="lieu"></select>

        <div class="mb-3">
          <label for="address">Lieu de départ</label>
          <input type="text" class="form-control" id="localisation_adepart" name="localisation_depart" placeholder="Angers" required>
        </div>

        <div class="mb-3">
          <label for="address">Lieu d'arrivée</label>
          <input type="text" class="form-control" id="localisation_arrive" name="localisation_arrive" placeholder="Angers" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Date de départ</label>
            <input type="date" class="form-control" id="depart_date" name="depart_date" placeholder="" value="" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nombre de place passager</label>
            <input type="text" class="form-control" id="nb_place" name="nb_place" placeholder="" value="" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Prix du covoiturage</label>
            <input type="text" class="form-control" id="prix" name="prix" placeholder="" value="" required>
          </div>
        </div>

        <hr class="mb-4">
        <input class="btn btn-primary btn-lg btn-block" type="submit" id='submit' value='Proposer mon covoiturage'>
      </form>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017-2019 Company Name</p>
  </footer>
</div>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script>
        const url_api = "http://dev.paul-fouche.com";
        var settings = {
          "url": url_api.concat("/API/evenement/read.php"),
          "method": "GET",
          "timeout": 0,
          "headers": {
            "Content-Type": "application/x-www-form-urlencoded"
          },
        };

        $.ajax(settings).done(function (response) {
          list_event = response.evenements;

          console.log(list_event);

          let dropdown = $('#locality-dropdown');

          dropdown.empty();

          dropdown.append('<option selected="true" disabled>Choisir un evenement</option>');
          dropdown.prop('selectedIndex', 0);


          // Populate dropdown with list of provinces
          $.each(list_event, function (key, entry) {
            dropdown.append($('<option></option>').attr('value', entry.id).text(entry.nom));
          });
        });

      </script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>

