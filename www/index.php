<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css">
      body {
        padding-top: 5rem;
      }
      .starter-template {
        padding: 3rem 1.5rem;
        text-align: center;
      }

    </style>

    <title>CovEvent</title>
  </head>
  <body>
    <!-- Navigation -->
    <?php 
    require('view/header.php'); 
    ?>


  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="public/images/02.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="p-5">
            <h2 class="display-4">Allez aux plus grands festivals!</h2>
            <p>Rassemblez-vous lors d'un covoiturage afin d'économiser de l'argent et partager un moment avec les même fans que vous</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="public/images/03.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Ne ratez pas un évènement !</h2>
            <p>Ne laissez pas le trajet devenir l'ennemie de vos passion, grâce à Covevent vous pouvez tout faire !</p>
          </div>
        </div>
      </div>
    </div>
  </section><!-- /.container -->

  <?php include 'view/footer.php'; ?>

  <?php
      $to      = "julien.bardin@reseau.eseo.fr";
      $subject = "votre reservation";
      $message = "c'est good baby";
      $headers = array(
          'From' => 'julien@bardin.me',
          'Reply-To' => 'julien@bardin.me',
          'X-Mailer' => 'PHP/' . phpversion()
      );

      echo '<script>console.log("email here")</script>';

      if(mail($to, $subject, $message, $headers))
      {
              echo "<script>console.log(L'email a bien été envoyé.</script>";
      }
      else
      {
              echo "<script>console.log(Une erreur c'est produite lors de l'envois de l'email.</script>";
      }
      ?>
      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>