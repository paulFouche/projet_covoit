<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/dashboard/">

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

      #informations {
        
      }

      #reservations {
        
      }

      #covoiturages {
      }
    </style>
    <!-- Custom styles for this template -->
  </head>
  <body>
    <?php
      session_start();
      $email = $_SESSION["email"];
      $password = $_SESSION["password"];


      $curling = curl_init();
        $requete="http://dev.paul-fouche.com/API/utilisateur/read_one_by_email.php?email=".$email."&password=".$password ;
        echo $requete;

        curl_setopt_array($curling, array(
          CURLOPT_URL => "http://dev.paul-fouche.com/API/utilisateur/read_one_by_email.php?email=".$email."&password=".$password,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));

        $response = curl_exec($curling);
        curl_close($curling);
        $informations = json_decode($response);
        $id_str = $informations->id;
        $id_str_2=str_replace(' ','',$id_str);
        $id = (int)$id_str_2;
        //echo $id;

        $_SESSION["id"] = $id;

        if ($_SESSION["email"]==null){
          header('Location: index.php');
        }
    ?>
    <?php 
  require('view/header.php'); 
  ?>
    <div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar" style="height: 100vh">
      <div class="sidebar-sticky" style="height: 100vh">
        <ul class="nav flex-column" style="margin-top: 25%;">
          <li class="nav-item">
            <a class="nav-link" href="#informations" onclick="afficher_informations()">
              Mes informations
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#reservations" onclick="afficher_reservations()">
              Mes reservations
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#covoiturages" onclick="afficher_covoiturages()">
              Mes covoiturages
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="margin-top: 10%">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mes informations</h1>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="row" id="informations" class="my-4"></div>
        </div>
      </div>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mes réservations</h1>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="row" id="reservations" class="my-4"></div>
        </div>
      </div>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mes covoiturages</h1>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="row" id="covoits" class="my-4"></div>
        </div>
      </div>
    </main>

  </div>
</div>

<?php include 'view/footer.php'; ?>

      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script>




        var id = <?php echo $_SESSION["id"]; ?>; // ICI JULIEN REGARDE LA 

        function afficher_informations() {

        }

        function afficher_reservations() {

        }

        function afficher_covoiturages() {

        }


        let url_base_covoit = "http://dev.paul-fouche.com/API/covoiturage/read_my_covoiturage.php?id="
        let url_covoit = url_base_covoit.concat(id)

        var settings_covoit = {
          "url": url_covoit, 
          "method": "GET",
          "timeout": 0,
          "headers": {
            "Content-Type": "text/plain"
          },
        };

        $.ajax(settings_covoit).done(function (response) {
          listCovoits = response.covoiturages;
          console.log(listCovoits);
          displayCovoit()
        });

        let url_base_reser = "http://dev.paul-fouche.com/API/covoiturage/read_one_reservation.php?id="
        let url_reser = url_base_reser.concat(id)

        var settings_resa = {
          "url": url_reser, 
          "method": "GET",
          "timeout": 0,
          "headers": {
            "Content-Type": "text/plain"
          },
        };

        $.ajax(settings_resa).done(function (response) {
          listResa = response.reservations;
          console.log(listResa);
          displayResa()
        });

        let url_base_user = "http://dev.paul-fouche.com/API/utilisateur/read_one.php?id="
        let url_user = url_base_user.concat(id)

        var settings_user = {
          "url": url_user, 
          "method": "GET",
          "timeout": 0,
          "headers": {
            "Content-Type": "text/plain"
          },
        };

        $.ajax(settings_user).done(function (response) {
          user = response;
          displayUser();
        });

        function displayCovoit(){
          document.getElementById("covoits").innerHTML = ""
            listCovoits.forEach(function(item,index){

                var date = (new Date(item.depart_date)).toLocaleString();

                var textHtml = '<div class="col-lg-4 col-md-6 mb-4 my-4">'
                                + '<div class="card h-100">'
                                +   '<div class="card-body">'
                                +     '<h4 class="card-title">'
                                +       '<a href="#">'+ item.localisation_depart + ' - '+ item.localisation_arrive +'</a>'
                                +     '</h4>'
                                +     '<h5>'+ item.prix +' €</h5>'
                                +     '<p class="card-text"> date : ' + date + '</p>'
                                +   '</div>'
                                + '</div>'
                                + '</div>'

                document.getElementById("covoits").innerHTML += textHtml
            });
        }

        function displayResa(){
          document.getElementById("reservations").innerHTML = ""
            listResa.forEach(function(item,index){

                var date = (new Date(item.depart_date)).toLocaleString();

                var textHtml = '<div class="col-lg-4 col-md-6 mb-4 my-4">'
                                + '<div class="card h-100">'
                                +   '<div class="card-body">'
                                +     '<h4 class="card-title">'
                                +       '<a href="#">'+ item.localisation_depart + ' - '+ item.localisation_arrive +'</a>'
                                +     '</h4>'
                                +     '<h5>'+ item.prix +' €</h5>'
                                +     '<p class="card-text"> date : ' + date + '</p>'
                                +   '</div>'
                                +   '<div class="card-footer">'
                                +     '<small class="text-muted">Places disponibles:  ' + item.nb_place + '</small>'
                                +   '</div>'
                                +   '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"'
                                +   'onclick="setCurrent(\'' + item.id +"\',\'" + item.localisation_depart + "\',\'" +  item.localisation_arrive + "\',\'" + item.prix + "\',\'" + item.id_evenement + "\',\'" + date +'\')">Réserver</button>'
                                + '</div>'
                                + '</div>'

                document.getElementById("reservations").innerHTML += textHtml
            });
        }


        function displayUser(){
          document.getElementById("informations").innerHTML = ""

            var textHtml = '<div class="col-lg-6">'
                            + '<ul class="list-group">'
                            +   '<li class="list-group-item">'+user.prenom+' '+user.nom+'</li>'
                            +   '<li class="list-group-item">'+user.email+'</li>'
                            +   '<li class="list-group-item">'+user.tel+'</li>'
                            + '</ul>'
                            +'</div>'  

            document.getElementById("informations").innerHTML += textHtml
        }

      </script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
      <script src="dashboard.js"></script></body>
</html>

