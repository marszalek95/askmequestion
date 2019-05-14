<?php include 'core/init.php'; ?>
<?php if(!$session->is_signed_in()) {redirect("index.php");} ?>

<?php

$id = $_GET['id'];

$question = Question::find_by_id($id);


if(isset($_POST['submit']))
{
    $answer = trim($_POST['answer']);
    $question->answer = $answer;
    $question->status = 1;
    $question->update();
    redirect("question.php?id={$id}");
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
      <?php if($question->add_to == $session->user_id && $question->status == 0) : ?>
      <?php $friend = User::find_by_id($question->add_by); ?>
          <div class="col-sm-12">
            <div class="card text-white bg-dark border-secondary mb-3">
             <div class="card-header">From <?php echo $friend->username; ?></div>
             <div class="card-body">
               <p class="card-text"><?php echo $question->question; ?></p>
             </div>
           
           </div>
              <form class="form" method="post" autocomplete="off">
              <div class="form-group">
                <textarea class="form-control bg-dark text-white" rows="5" name="answer"></textarea>
              </div> 
              <input type="submit" name="submit" value="Answer!" class="btn btn-secondary btn-md">
          </form>
              </div>
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
