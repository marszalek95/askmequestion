<?php include 'core/init.php'; ?>
<?php if(!$session->is_signed_in()) {redirect("index.php");} ?>

<?php

$id = $_GET['id'];

$question = Question::find_by_id($id);


if($question->status == 1 && $question->add_by == $session->user_id)
{
    $question->update_status(2);
}



?>

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

      
      
      <main role="main" class="cover h-100 p-3">
      <div class="d-flex p-3 row">
      <?php if($question->add_by == $session->user_id) : ?>
      <?php $friend = User::find_by_id($question->add_to); ?>
          <div class="col-sm-12">
            <div class="card text-white bg-dark border-secondary mb-3">
             <div class="card-header">To <?php echo $friend->username; ?></div>
             <div class="card-body">
                <p class="card-text">Q: <?php echo $question->question; ?></p>   
             </div>
             <div class="card-body">
                <p class="card-text">A: <?php echo $question->my_answer; ?></p>
             </div>
             <div class="card-footer border-secondary"><?php echo $question->status == (1 || 2) ? "A: {$question->answer}" : "Waiting for {$friend->username} answer..."; ?></div>
           </div>
              </div>
      <?php elseif($question->add_to == $session->user_id) : ?>
      <?php $friend = User::find_by_id($question->add_by); ?>
          <div class="col-sm-12">
            <div class="card text-white bg-dark border-secondary mb-3">
             <div class="card-header">From <?php echo $friend->username; ?></div>
             <div class="card-body">
                <p class="card-text">Q: <?php echo $question->question; ?></p>
             </div>
             <div class="card-body">
                <p class="card-text">A: <?php echo $question->my_answer; ?></p>
             </div>
            <div class="card-footer border-secondary"><?php echo $question->status == (1 || 2) ? "A: {$question->answer}" : "Waiting for answer..."; ?></div>
            </div>
          </div>
      <?php else : ?>
          <a>Something went wrong.</a>
      <?php endif; ?>
      </div>
      </main>
   
      
      
      
      
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
