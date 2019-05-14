<?php include 'core/init.php'; ?>

<?php

$id = $_GET['id'];

if(!$relation = Friends::find_by_id($id))
{
    redirect('index.php');
}

if($relation->user_one_id == $session->user_id && $relation->status_user_one == (1 || 4))
{
    $friend = User::find_by_id($relation->user_two_id);
}
elseif($relation->user_two_id == $session->user_id && $relation->status_user_two == (1 || 4))
{
    $friend = User::find_by_id($relation->user_one_id);
}
else
{
    redirect('index.php');
}

if(isset($_POST['submit']))
{
    $question = new Question;
    $question->question = ($_POST['question']);
    $question->my_answer = ($_POST['my_answer']);
    $question->add_by = $session->user_id;
    $question->add_to = $friend->id;
    $question->status = 0;
    
    $question->create();
    redirect("sendquestions.php");
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
          <form class="form" method="post" autocomplete="off">
              <div class="form-group">
                <label for="comment">Question for @<?php echo $friend->username; ?>:</label>
                <textarea class="form-control bg-dark text-white" rows="5" name="question"></textarea>
                <label>Answer:</label>
                <textarea class="form-control bg-dark text-white" rows="5" name="my_answer"></textarea>
              </div> 
              <input type="submit" name="submit" value="Send!" class="btn btn-secondary btn-md">
          </form>
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
