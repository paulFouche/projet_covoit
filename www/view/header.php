<?php

    session_start();
    $email = $_SESSION["email"];
    $tel = $_SESSION["tel"];
    $id = $_SESSION["id"];
    
    


    if (($_SESSION["email"]==null) && (basename($_SERVER['PHP_SELF']) != "index.php") && (basename($_SERVER['PHP_SELF']) != "inscription.php") && (basename($_SERVER['PHP_SELF']) != "login.php")){
        header('Location: index.php');
    }

    if (($_SESSION["email"]!=null) && ((basename($_SERVER['PHP_SELF']) == "inscription.php") || (basename($_SERVER['PHP_SELF']) == "login.php"))){
        header('Location: index.php');
    }

    if($_SESSION["email"]!=null){ // session active
        echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark fixed-top' style='background-color:#112233;'>
            <div class='container'>
              <a class='navbar-brand' href='index.php'><img src='public/images/covevent.png' style='width:12rem;height:2.8rem;'></a>
              <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
              </button>
              <div class='collapse navbar-collapse' id='navbarResponsive'>
                <ul class='navbar-nav ml-auto'>
              <li class='nav-item'>
                <a class='nav-link' href='index.php'>Accueil</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='covoitPage.php'>Les covoiturages</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='create_covoiturage.php'>Proposer un covoit'</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='account.php'>Mon Compte</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='logout.php'>Déconnexion</a>
              </li>
                </ul>
              </div>
            </div>
          </nav>";
    }else{
        echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark fixed-top'>
                  <div class='container'>
                  <a class='navbar-brand' href='index.php'><img src='public/images/covevent.png' style='width:12rem;height:2.8rem;'></a>
                  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'>
                      <span class='navbar-toggler-icon'></span>
                    </button>
                    <div class='collapse navbar-collapse' id='navbarResponsive'>
                      <ul class='navbar-nav ml-auto'>
                      <li class='nav-item'>
                        <a class='nav-link' href='index.php'>Accueil</a>
                    </li>
                        <li class='nav-item'>
                          <a class='nav-link' href='inscription.php'>Inscription</a>
                        </li>
                        <li class='nav-item'>
                          <a class='nav-link' href='login.php'>Connexion</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </nav>";
    }



  ?>