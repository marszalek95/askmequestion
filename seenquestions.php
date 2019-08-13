<?php include 'core/init.php'; ?>
<?php if(!$session->is_signed_in()) {redirect("index.php");} ?>




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

        
    <?php 

        $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

        $items_per_page = 6;

        $items_total_count = Question::count_seen_questions($session->user_id);

        $paginate = new Pagination($page, $items_per_page, $items_total_count);

        $questions = Question::find_seen_questions($session->user_id,  $items_per_page, $paginate->offset()); 

     ?>
      
      <main role="main" class="cover h-100 p-3">
      <div class="d-flex p-3 row">
          
      <?php echo $items_total_count == 0 ?  "You don't have seen questions!" : false ; ?>     
          
      <?php foreach($questions as $question) : ?>
      <?php if($question->add_by == $session->user_id && $question->status != 1) : ?>
      <?php $friend = User::find_by_id($question->add_to); ?>
          <div class="col-sm-6">
              <div class="card card-hover text-white bg-dark border-secondary mb-3" data-clickable="true" data-href="question.php?id=<?php echo $question->id; ?>" style="max-width: 20rem;">
             <div class="card-header">To <?php echo $friend->username; ?></div>
             <div class="card-body">
               <p class="card-text"><?php echo $question->question; ?></p>
             </div>
           </div>
              </div>
      <?php elseif($question->add_to == $session->user_id) : ?>
      <?php $friend = User::find_by_id($question->add_by); ?>
          <div class="col-sm-6">
            <div class="card card-hover text-white bg-dark border-secondary mb-3" data-clickable="true" data-href="question.php?id=<?php echo $question->id; ?>" style="max-width: 20rem;">
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
                    $pagination_lenght = 7;
                    $pagination_delay = 3;
                    $pagination_total = $paginate->page_total();
                    
              
                    if($pagination_total <= $pagination_lenght)
                    {
                        $pagination_min = 1;
                        $pagination_max = $pagination_total;
                    }
                    elseif($page <= $pagination_delay)
                    {
                        $pagination_min = 1;
                        $pagination_max = $pagination_lenght;
                    }
                    elseif($page <= ($pagination_total - $pagination_delay))
                    {
                        $pagination_min = $page - $pagination_delay;
                        $pagination_max = $page + $pagination_delay;
                    }
                    elseif($page >= ($pagination_total - $pagination_delay))
                    {
                        $pagination_min = $pagination_total - (2 * $pagination_delay);
                        $pagination_max = $pagination_total;
                    }
                             
                    
                    if($paginate->page_total() > 1)
                    {
                        if($paginate->has_previous())
                        {
                            echo "<li class='page-item'><a class='page-link' href='seenquestions.php?page={$paginate->previous()}'>Previous</a></li>";
                        }
                        
                        for ($i = $pagination_min; $i <= $pagination_max; $i++)
                        {
                            if($i == $paginate->current_page)
                            {
                                echo "<li class='page-item active'><a class='page-link' href='seenquestions.php?page={$i}'>{$i}</a></li>";
                            }
                            else
                            {
                                echo "<li class='page-item'><a class='page-link' class='page-link' href='seenquestions.php?page={$i}'>{$i}</a></li>";
                            }
                        }
                        
                        if($paginate->has_next())
                        {
                            echo "<li class='page-item'><a class='page-link' href='seenquestions.php?page={$paginate->next()}'>Next</a></li>";
                        }
                                     
                    }
                    
                    ?>
                    
                </ul>
            </div>
      
      
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
