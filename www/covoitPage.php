
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>Covevent</title>

  <!-- Bootstrap core CSS -->
  <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="public/css/shop-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <?php 
  require('view/header.php'); 
  ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Paramètres</h1>
        <div class="list-group my-4">
          <a href="#" class="list-group-item disabled"><B>Evenements</B></a>
          <a class="list-group-item">
            <select id="eventSelect" class="lotDeSelection">
            </select>
          </a>
          <a href="#" class="list-group-item disabled"><B>Ville de Départ</B></a>
          <a class="list-group-item">
            <select id="villeDepartSelect" class="lotDeSelection">
            </select>
          </a>
          <a href="#" class="list-group-item disabled"><B>Ville D'arrivée</B></a>
          <a class="list-group-item">
            <select id="villeDarriveeSelect" class="lotDeSelection">
            </select>
          </a>
          <!-- <a href="#" class="list-group-item disabled"><B>Prix</B></a>
          <a class="list-group-item">
            <select id="prixSelect">
            </select>
          </a> -->
          <a href="#" class="list-group-item disabled"><B>Prix Mini</B></a>
          <a class="list-group-item"><input class="ui-hidden-accessible" type="range" name="rangeInput" id="rangeInputMin" value="0" data-show-value="true"/><div id="priceMin"></div></a>
          <a href="#" class="list-group-item disabled"><B>Prix Maxi</B></a>
          <a class="list-group-item"><input class="ui-hidden-accessible" type="range" name="rangeInput" id="rangeInputMax" value="0" data-show-value="true"/><div id="priceMax"></div></a>

        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="row" id="covoits" class="my-4">

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php include 'view/footer.php'; ?>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Veuiller confirmer votre réservation pour le trajet :
          <div id="currentSelection"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-success" onClick="covoiturageConfirme()">Confirmer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="public/vendor/jquery/jquery.min.js"></script>
  <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


</body>

</html>

<script>
    const url_api = "http://dev.paul-fouche.com"; //CHANGER L'URL ICI


    console.log("test")
    var listCovoits = [];
    var confirmationCovoit = {
      "id_utilisateur" : 0,
      "id_evenement" : 0,
      "id_covoit" : 0,
    }

    var navbar = {
      "nb_place" : [],
      "depart_date" : [],
      "localisation_depart" : [],
      "depart_date" : [],
      "prix" : [],
      "localisation_arrive" : [],
      "evenement" : []
    }

    var choix = {
      "localisation_depart" : "All",
      "prixMin" : 0,
      "prixMax" : 100000,
      "localisation_arrive" : "All",
      "evenement" : "All"
    }
    
    var settings = {
      "url": url_api.concat("/API/covoiturage/read.php"),
      "method": "GET",
      "timeout": 0,
    };

    $.ajax(settings).done(function (response) {
      listCovoits = response.records
      console.log(listCovoits)
      displayCovoit()
      setNavBar()
    });

    

    function displayCovoit(){
      document.getElementById("covoits").innerHTML = ""
      console.log(choix)
        listCovoits.forEach(function(item,index){
          if (item.nb_place > 0 && (choix.evenement == "All" || choix.evenement == item.nom_evenement)
                                && (choix.localisation_depart == "All" || choix.localisation_depart == item.localisation_depart)
                                && (choix.localisation_arrive == "All" || choix.localisation_arrive == item.localisation_arrive)
                                && (choix.prixMin <= item.prix && choix.prixMax >= item.prix)){

                                  var date = (new Date(item.depart_date)).toLocaleString()

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
                            +   'onclick="setCurrent(\'' + item.id +"\',\'" + item.localisation_depart + "\',\'" +  item.localisation_arrive + "\',\'" + item.prix + "\',\'" + item.id_evenement +"\',\'" + item.id_utilisateur + "\',\'" + date +'\')">Réserver</button>'
                            + '</div>'
                            + '</div>'

            document.getElementById("covoits").innerHTML += textHtml

            
            addInTheTable(navbar.prix,parseInt(item.prix, 10))
            addInTheTable(navbar.localisation_depart,item.localisation_depart)
            addInTheTable(navbar.localisation_arrive,item.localisation_arrive)
            addInTheTable(navbar.evenement,item.nom_evenement)

            addInTheTable(navbar.localisation_depart,"All")
            addInTheTable(navbar.localisation_arrive,"All")
            addInTheTable(navbar.evenement,"All")

            navbar.prix.sort((a, b) => a - b);
          }
          
        });

        console.log(navbar)
    }

    function selectionChange(){
      choix.evenement = document.getElementById("eventSelect").value
      choix.localisation_depart = document.getElementById("villeDepartSelect").value
      choix.localisation_arrive = document.getElementById("villeDarriveeSelect").value
      choix.prixMax = navbar.prix[document.getElementById("rangeInputMax").value]
      choix.prixMin = navbar.prix[document.getElementById("rangeInputMin").value]
      console.log("la Selection a changée")
      displayCovoit()
    }

    function setNavBar(){

      setSelect(navbar.evenement,"eventSelect")
      setSelect(navbar.localisation_depart,"villeDepartSelect")
      setSelect(navbar.localisation_arrive,"villeDarriveeSelect")


      $("#rangeInputMin").prop({
          max: navbar.prix.length - 1
      }).closest(".ui-slider")
          .find(".ui-slider-handle")
          .text(navbar.prix[0]);
          document.getElementById("priceMin").innerHTML = navbar.prix[0] + " €"
      
       $( ".lotDeSelection" ).change(function() {
          selectionChange()
        });
            

      $("#rangeInputMin").on("change", function () {
          var value = $(this).val(),
              button = $(this)
                  .closest(".ui-slider")
                  .find(".ui-slider-handle");
          setTimeout(function () { /* update text after jQM refreshes slider */
              document.getElementById("priceMin").innerHTML = navbar.prix[value] + " €"
              selectionChange()
          }, 0);
      });

      $("#rangeInputMax").prop({
          max: navbar.prix.length - 1,
          value: navbar.prix.length - 1
      }).closest(".ui-slider")
          .find(".ui-slider-handle")
          .text(navbar.prix[navbar.prix.length - 1]);
      document.getElementById("priceMax").innerHTML = navbar.prix[navbar.prix.length - 1] + " €"

      $("#rangeInputMax").on("change", function () {
          var value = $(this).val(),
              button = $(this)
                  .closest(".ui-slider")
                  .find(".ui-slider-handle");
          setTimeout(function () { /* update text after jQM refreshes slider */
              document.getElementById("priceMax").innerHTML = navbar.prix[value] + " €"
              selectionChange()
          }, 0);
      });
    }


    function addInTheTable(table, valeur){
      if(!table.includes(valeur)){
        table.push(valeur)
        table.sort()
      }
    }

    function setSelect(array,selection){
      var html = ""
      array.forEach(function(item, index){
        html += "<option value=" + item + ">" + item +"</option>"
      });
      document.getElementById(selection).innerHTML = html
    }

    function setCurrent(id,localisation_depart,localisation_arrive,prix,id_evenement,id_utilisateur,depart_date){
      confirmationCovoit.id = id
      confirmationCovoit.id_evenement = id_evenement
      confirmationCovoit.id_utilisateur = id_utilisateur
      console.log("changement")
      document.getElementById("currentSelection").innerHTML =  localisation_depart 
                                                              + ' - '+ localisation_arrive
                                                              + ' <br> prix : ' + prix
                                                              + ' € <br> date : ' + depart_date
    }

    function covoiturageConfirme2(){
      var data = "This is my email";
      $.ajax({
          type: "POST",
          url: "email.php",
          data: data,
          dataType: "text"
      });
    }

    function covoiturageConfirme(){

      var settingsCovoit = {
        "url": url_api.concat("/API/covoiturage/updateReservationMoins.php"),
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "text/plain"
        },
        "data": "{\n\t\"id\":\""+ confirmationCovoit.id + "\"\n}",
      };

      $.ajax(settingsCovoit).done(function (response) {
        console.log(response);
      });

      var settingsEvent = {
        "url": url_api.concat("/API/evenement/updateReservationMoins.php"),
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "text/plain"
        },
        "data": "{\n\t\"id\":\""+ confirmationCovoit.id_evenement + "\"\n}",
      };

      $.ajax(settingsEvent).done(function (response) {
        console.log(response);
      });

      var emailSettings = {
<<<<<<< HEAD
        "url": url_api.concat("/emailReservation.php"),
=======
        "url": "http://dev.paul-fouche.com/emailReservation.php?id=" + confirmationCovoit.id_utilisateur,
>>>>>>> 86bfb20db7f1a5ad67302c5ee2df169c8b8efb3e
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Content-Type": "text/plain"
        },
        "data": "",
      };

      $.ajax(emailSettings).done(function (response) {
        console.log(reponse)
      });

      var settings = {
        "url": url_api.concat("/API/reservation/create.php"),
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "text/plain"
        },
        "data": "{\n\t\"id_utilisateur\": \"" + <?php echo $_SESSION["id"]; ?> + "\",\n    \"id_covoiturage\": \"" + confirmationCovoit.id + "\"\n}",
      };

      $.ajax(settings).done(function (response) {
        console.log(response);
        console.log("c'est réservé")
        //document.location.href="emailReservation.php"
      });



    }
</script>