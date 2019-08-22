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
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
        <?php 

          $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
          
          $friend_id = $_GET['id'];

          $items_per_page = 6;

          $items_total_count = Question::count_friend_questions($friend_id, $session->user_id);

          $paginate = new Pagination($page, $items_per_page, $items_total_count);

          $questions = Question::find_friend_questions($friend_id, $session->user_id, $items_per_page, $paginate->offset()); 
          

        ?>
        <main role="main" class="cover h-100 p-3">
        <div class="d-flex p-3 row">
            
        <?php echo $items_total_count == 0 ?  "You don't have questions with this friend!" : false ; ?> 
            
        <?php foreach($questions as $question) : ?>
        <?php if($question->add_by == $session->user_id) : ?>
        <?php $friend = User::find_by_id($question->add_to); ?>
            <div class="col-sm-6">
                <div class="card card-hover text-white bg-dark border-secondary mb-3" data-clickable="true" data-href="question.php?id=<?php echo $question->id; ?>" style="max-width: 20rem;">
               <div class="card-header">To <?php echo $friend->username; ?> <?php echo $question->status == 1 ? '<i class="fas fa-check-circle float-right"></i>' : ""; ?> </div>
               <div class="card-body">
                 <p class="card-text"><?php echo $question->question; ?></p>
               </div>
             </div>
                </div>
        <?php elseif($question->add_to == $session->user_id) : ?>
        <?php $friend = User::find_by_id($question->add_by); ?>
            <div class="col-sm-6">
              <div class="card card-hover text-white bg-dark border-secondary mb-3" data-clickable="true" data-href="answerquestion.php?id=<?php echo $question->id; ?>" style="max-width: 20rem;">
               <div class="card-header">From <?php echo $friend->username; ?></div>
               <div class="card-body">
                 <p class="card-text"><?php echo $question->question; ?></p>
               </div>
             </div>
                </div>
        <?php endif; ?>
        <?php endforeach; ?>
        </div>
        </main>
      
        
            <div class="d-flex justify-content-center">
                <ul class="pagination bg-dark">
                    
                    <?php 
                    
                    if($paginate->page_total() > 1)
                    {
                        if($paginate->has_previous())
                        {
                            echo "<li class='page-item'><a class='page-link' href='friendquestions.php?page={$paginate->previous()}&id={$friend_id}'>Previous</a></li>";
                        }
                        
                        for ($i = 1; $i <= $paginate->page_total(); $i++)
                        {
                            if($i == $paginate->current_page)
                            {
                                echo "<li class='page-item active'><a class='page-link' href='friendquestions.php?page={$i}&id={$friend_id}'>{$i}</a></li>";
                            }
                            else
                            {
                                echo "<li class='page-item'><a class='page-link' class='page-link' href='friendquestions.php?page={$i}&id={$friend_id}'>{$i}</a></li>";
                            }
                        }
                        
                        if($paginate->has_next())
                        {
                            echo "<li class='page-item'><a class='page-link' href='friendquestions.php?page={$paginate->next()}&id={$friend_id}'>Next</a></li>";
                        }
                                     
                    }
                    
                    ?>
                    
                </ul>
            </div>
                
        
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
