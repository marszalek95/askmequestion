<?php include 'core/init.php'; ?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<!--    <link rel="icon" href="../../../../favicon.ico">-->

    <title>AskMeQuestion</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">
  </head>

  <body class="text-center">
      

    <?php include 'includes/navbar.php'; ?>

      
      <?php if(!$session->is_signed_in()) : ?>

      <main role="main" class="cover h-75">
        <h1 class="cover-heading">Just ask question.</h1>
        <p class="lead">On this site You can ask and answer questions. All you need to do is ask question, answer it and wait for reply. Your friend doesn't see the result of question till he answer it. This makes your answers do not affect each other.</p>
        <p class="lead">
          <a href="register.php" class="btn btn-lg btn-secondary">Sign up</a>
        </p>
      </main>
      <?php else : ?>
      <main role="main" class="cover h-100 p-3">
      <div class="d-flex p-3 row">
          <div class="col-sm-6">
            <div class="card text-white bg-dark border-secondary mb-3" style="max-width: 20rem;">
             <div class="card-header">@Marszal</div>
             <div class="card-body">
               <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                 card's content.</p>
             </div>
           </div>
          </div>
          <div class="col-sm-6">
            <div class="card text-white bg-dark border-secondary mb-3" style="max-width: 20rem;">
             <div class="card-header">Header</div>
             <div class="card-body">
               <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                 card's content.</p>
             </div>
           </div>
          </div>
          <div class="col-sm-6">
            <div class="card text-white bg-dark border-secondary mb-3" style="max-width: 20rem;">
             <div class="card-header">Header</div>
             <div class="card-body">
               <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                 card's content. </p>
             </div>
           </div>
          </div>
          <div class="col-sm-6">
            <div class="card text-white bg-dark border-secondary mb-3" style="max-width: 20rem;">
             <div class="card-header">Header</div>
             <div class="card-body">
               <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                 card's content.</p>
             </div>
           </div>
          </div>
          <div class="col-sm-6">
            <div class="card text-white bg-dark border-secondary mb-3" style="max-width: 20rem;">
             <div class="card-header">Header</div>
             <div class="card-body">
               <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                 card's content.</p>
             </div>
           </div>
          </div>
          <div class="col-sm-6">
            <div class="card text-white bg-dark border-secondary mb-3" style="max-width: 20rem;">
             <div class="card-header">Header</div>
             <div class="card-body">
               <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                 card's content.</p>
             </div>
           </div>
          </div>
    
          </div>
      </main>
      
      <?php endif; ?>
      
      
      
      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Copyright &copy; Adam Marszalek 2019</p>
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/javascript.js"></script>
  </body>
</html>
