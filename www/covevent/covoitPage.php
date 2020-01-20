<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pick your Covoit</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Shop Name</h1>
        <div class="list-group">
          <a href="#" class="list-group-item">Category 1</a>
          <a href="#" class="list-group-item">Category 2</a>
          <a href="#" class="list-group-item">Category 3</a>
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
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>


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
          <button type="button" class="btn btn-success">Confirmer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


</body>

</html>

<script>
    console.log("test")
    var listCovoits = [];
    var currentCovoitId
    
    var settings = {
      "url": "http://localhost/projetCovoit/www/API/covoiturage/read.php",
      "method": "GET",
      "timeout": 0,
    };

    $.ajax(settings).done(function (response) {
      listCovoits = response.records
      console.log(listCovoits)
      displayCovoit()
    });

    function displayCovoit(){
        listCovoits.forEach(function(item,index){
          console.log(item)
          if (item.nb_place > 0 ){
            var textHtml = '<div class="col-lg-4 col-md-6 mb-4 my-4">'
                            + '<div class="card h-100">'
                            +   '<div class="card-body">'
                            +     '<h4 class="card-title">'
                            +       '<a href="#">'+ item.localisation_depart + ' - '+ item.localisation_arrive +'</a>'
                            +     '</h4>'
                            +     '<h5>'+ item.prix +' €</h5>'
                            +     '<p class="card-text"> date : ' + item.depart_date + '</p>'
                            +   '</div>'
                            +   '<div class="card-footer">'
                            +     '<small class="text-muted">' + item.nb_place + ' places disponibles</small>'
                            +   '</div>'
                            +   '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setCurrent('+ index +')">Réserver</button>'
                            + '</div>'
                            + '</div>'
            }
            document.getElementById("covoits").innerHTML += textHtml
        });
        var current = document.getElementById("covoits").innerHTML
        document.getElementById("covoits").innerHTML = current + current + current + current
    }

    function setCurrent(index){
      currentCovoitId = listCovoits[index].id
      document.getElementById("currentSelection").innerHTML =  listCovoits[index].localisation_depart 
                                                              + ' - '+ listCovoits[index].localisation_arrive
                                                              + ' <br> prix : ' + listCovoits[index].prix
                                                              + ' € <br> date : ' + listCovoits[index].depart_date
    }
</script>