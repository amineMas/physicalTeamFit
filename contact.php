<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.12.0/css/mdb.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/style.css">
    <title>Accueil</title>
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark ">
      <a class="navbar-brand ml-lg-2 ml-xl-4 p-0" href="index.html">
          <img src="img/logo.png" alt="logo-site" width="270" height="110">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          <i class="fas fa-times d-none"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link" href="index.html">Accueil</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.html#about-us">Notre équipe</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.html#services">Nos services</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.html#en-entreprise">Formule Entreprise</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.html#association">Association</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="contact.html">Contact</a>
              </li>
          </ul>
      </div>
    </nav>
    
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto mt-5">
          <img class="mw-100" src="img/rsz_photo_entreprise2.jpg" alt="">
        </div>
        <div class="col-8 mx-auto mt-3">
          <p>Vous serez accompagné d’un coach professionnel diplômé d’état qui vous guidera et vous corrigera sur les différents exercices énoncés. Les séances seront adaptées aux créneaux horaires et à l’espace disponibles dans le respect des modalités pré-requises. L’avantage du coaching en entreprise est de permettre pour certains employés, qui n’ont pas le temps, de pratiquer une activité sportive régulière. Il prévient aussi des éventuelles maux causés par le travail et renforce les liens entre collègues par une cohésion de groupe en partageant un bon moment ensemble dans la joie et la bonne humeur.</p>
        </div>
      </div>
      <h1 class="my-5">Contactez-nous via ce formulaire, on vous répondra le plus vite possible</h1>
      <form method="POST" class="pb-5">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email <span class="required">*</span><?php if(isset($emailErr)){echo $emailErr;}?></label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group col-md-6">
              <label for="num">Numéro de téléphone</label>
              <input type="text" class="form-control" id="num" name="num">
            </div>
        </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="age">Raison sociale <span class="required">*</span></label>
              <input type="text" class="form-control" id="age" name="name" required>
            </div>
            <div class="form-group col-md-6 px-0">
              <label for="subject">Sujet</label>
              <select class="form-control" id="subject" name="subject">
                <option>Formule entreprise</option>
                <option>Autre</option>
              </select>
            </div>
          </div>
          <div class="form-group col-md-6 px-0">
              <label for="message">Votre message <span class="required">*</span></label>
              <textarea class="form-control" id="message" name="message" rows="8" required></textarea>
            </div>
          <button type="submit" class="btn btn-danger" name="envoyer">Envoyer votre message</button>
      </form>
  </div>
<?php 
  function validation($data) {
    $data = trim($data); // supprime les espaces à la fin
    $data = stripslashes($data);
    $data = htmlspecialchars($data); //transforme les caractères spéciaux en entités html
    return $data;
  }

  if(isset($_POST['envoyer']))
  {   
    if(!empty($_POST["email"]))
    {
      $email = validation($_POST["email"]);
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    } else {
      $emailErr = 'champ mail requis';
    }
    
    if(!empty($_POST["num"]))
    {
      $num = filter_var($_POST["num"], FILTER_SANITIZE_NUMBER_INT);
      $coord = "Numéro de téléphone : $num";
    } else {
      $coord = 'Numéro de téléphone non renseigné';
    }
    
    if(!empty($_POST["name"]))
    {
      $name = validation($_POST["name"]);
      // check if name only contains letters and whitespaces
      preg_match('/^[-a-zA-Z ]*$/', $name);
    } else {
      return $nameErr = 'Le nom est requis';
    }
    
    if(!empty($_POST["subject"]))
    {
      $subject = validation($_POST["subject"]);
    } else {
      $subject = 'Contact - Physicalteamfit';
    }
    
    if(!empty($_POST["message"]))
    {
      $message = validation($_POST["message"]);
      nl2br($message);
      // $message = wordwrap($message, 70, PHP_EOL);
    } else {
      $messageErr = 'Vous devez écrire un message';
    }
    
    $to_email = "aminemastouri@gmail.com";
    $headers = array(
      'MIME-Version' => '1.0',
      'Content-type' => "text/html; charset=utf-8",
      'From' => $email,
      'Reply-To' => $email,
      'X-Mailer' => 'PHP/' . phpversion()
    );
    
    $messageHtml = '
    <html>
    <body>
    <div align="center" style="font-size:21px;">
    <p>Vous avez reçu un mail de la part de ' . $name .' au sujet de ' . $subject . '.</p>
    <p> ' . $message . '</p>
    <p> Coordonnées : ' . $coord .'
    </div>
    </body>
    </html>
    ';
    
    //envoi du mail après verification et traitement des données
    if (mail($to_email, $subject, $messageHtml, $headers)){
      echo '<div class="container"><div class="alert alert-success" role="alert">
      <p>Merci de nous avoir contacté. Nous vous répondrons au plus vite.</p>
      </div>';
      echo "<a href='index.html'>Retour sur la page d'accueil</a></div>";
    } else {
      echo 'Une erreur est survenue lors de l\'envoi';
    }
  }
?>
        <!-- Footer -->
    <footer class="page-footer font-small pt-4 ">

        <!-- Footer Links -->
        <div class="container">
          
            <!-- Grid row-->
            <div class="row text-center d-flex justify-content-center pt-5 mb-3">
    
                
    
                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Notre équipe</a>
                </h6>
                </div>
                <!-- Grid column -->
        
                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Nos services</a>
                </h6>
                </div>
                <!-- Grid column -->
        
                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Formule Entreprise</a>
                </h6>
                </div>
                <!-- Grid column -->
        
                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Association</a>
                </h6>
                </div>
                <!-- Grid column -->
        
                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Contact</a>
                </h6>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row-->
            </div>
          <hr class="rgba-white-light" style="margin: 0 15%;">
              
        </div>
            <!-- Footer Links -->
            
    
            <!-- Grid column -->
          <div class="col-md-12 py-5">
            <div class="mb-5 text-center">
    
              <!-- Facebook -->
              <a class="fb-ic">
                <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a>
              <!-- Twitter -->
              <a class="tw-ic">
                <i class="fab fa-youtube fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
              </a>
              <!--Instagram-->
              <a class="ins-ic">
                <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a>
            </div>
          </div>
          <!-- Grid column -->
    
    
    
            <!-- Social buttons -->
            <ul class="list-unstyled list-inline text-center">
              <li class="list-inline-item px-4 mr-lg-5">
                <img src="img/unnamed.png" alt="" width="120" height="100">
              </li>
              <li class="list-inline-item px-4 mr-lg-5">
                <img src="img/logo-lass-2.png" alt="" width="120" height="100">
              </li>
              <li class="list-inline-item px-4 mr-lg-5">
                <img src="img/logo-curtis.png" alt="" width="120" height="100">
              </li>
              <li class="list-inline-item px-4 mr-lg-5">
                <img src="img/handi-logo.png" alt="" width="120" height="100">
              </li>
            </ul>
            <!-- Social buttons -->
            <!-- Copyright -->
            <div class="footer-copyright text-center py-3 mt-5">© 2019 Copyright Team Fit</div>
            <!-- Copyright -->
          
        </footer>
          <!-- Footer -->
        
        <button id="scrollToTop"><i class="fas fa-arrow-up"></i></button>
    
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- MDB core JavaScript -->
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.12.0/js/mdb.min.js"></script> -->
        <script src="js/main.js"></script>
        
    </body>
    </html>