<?php include 'core/init.php'; ?>
<?php if(!$session->is_signed_in()) {redirect("index.php");} ?>

<?php

        $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

        $items_per_page = 2;

        $items_total_count = Friends::count_friends_request($session->user_id);

        $paginate = new Pagination($page, $items_per_page, $items_total_count);

        $friends_id = Friends::friends_request_pagination($session->user_id, $items_per_page, $paginate->offset()); 
                        
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
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  </head>

  <body>
      

    <?php include 'includes/navbar.php'; ?>
      

      
            <div class="p-4 col-sm">
                <div class="float-right">
                    
                    <form action="searchfriends.php">
                        <div class="input-group">
                            <input class="form-control form-control-sm mr-sm-2 bg-dark text-white" type="text" placeholder="Search" name="query">
                            <span class="input-group-btn">
                                <button class="btn btn-sm" type="submit" ><i class="fas fa-search fa-lg"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
      
      
        <main role="main" class="cover h-100">
            <div class="d-flex p-3 row">
                <div class="container">
                    <div class="list-group flex-row flex-wrap">
                        
                        
        <?php echo $items_total_count == 0 ?  "You don't have any friends. Go invite someone!" : false ; ?>               
      
        <?php foreach($friends_id as $friend_id) : ?>
        <?php $friend = User::find_by_id($friend_id->user_one_id); ?>

        
        
       
                        <div class="col-md-6 py-1 mx-auto">
                            <li class="list-group-item list-group-item-dark">
                             <a><?php echo $friend->username; ?></a>
                             <span class="float-right">
                                <a href="action/add_friend.php?id=<?php echo $friend_id->id; ?>" class="btn btn-sm btn-outline-light">Accept</a>
                                <a href="action/delete_friend.php?id=<?php echo $friend_id->id; ?>" class="btn btn-sm btn-outline-danger">Reject</a>
                             </span>
                            </li>                              
                        </div>
        
          <?php endforeach; ?>
        
   
                    </div>    
                </div>
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
                            echo "<li class='page-item'><a class='page-link' href='friends.php?page={$paginate->previous()}'>Previous</a></li>";
                        }
                        
                        for ($i = 1; $i <= $paginate->page_total(); $i++)
                        {
                            if($i == $paginate->current_page)
                            {
                                echo "<li class='page-item active'><a class='page-link' href='friends.php?page={$i}'>{$i}</a></li>";
                            }
                            else
                            {
                                echo "<li class='page-item'><a class='page-link' class='page-link' href='friends.php?page={$i}'>{$i}</a></li>";
                            }
                        }
                        
                        if($paginate->has_next())
                        {
                            echo "<li class='page-item'><a class='page-link' href='friends.php?page={$paginate->next()}'>Next</a></li>";
                        }
                                     
                    }
                    
                    ?>
                    
                </ul>
            </div>
      
      
      <footer class="mastfoot">
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
