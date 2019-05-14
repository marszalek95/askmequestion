<?php include 'core/init.php'; ?>
<?php if(!$session->is_signed_in()) {redirect("index.php");} ?>

<?php

$friends_id = Friends::find_all_user_friends($session->user_id);

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
      

        <main role="main" class="cover h-100">
            <div class="col-sm-6 mx-auto p-3">
                <center>
                    <a href="friends.php" class="btn btn-sm btn-secondary">All friends</a>
                    <a href="#" class="btn btn-sm btn-secondary">Find friends</a>
                </center>
            </div>
            <div class="d-flex p-3 row">
                <div class="container">
                    <div class="list-group flex-row flex-wrap">
                        
                        
    
      
          <?php foreach($friends_id as $friend_id) : ?>
          <?php 
          
          if($friend_id->user_one_id == $session->user_id)
          {
              $friend = User::find_by_id($friend_id->user_two_id);
              $status = $friend_id->status_user_one == 4 ? true : false;
          }
          else
          {
              $friend = User::find_by_id($friend_id->user_one_id);
              $status = $friend_id->status_user_two == 4 ? true : false;
          }
          
          ?>
        
                        <div class="col-md-6 py-1 mx-auto">
                            <li class="list-group-item list-group-item-dark">
                             <a><?php echo $friend->username; ?></a>
                             <span class="float-right">
                                 <a href="newquestion.php?id=<?php echo $friend_id->id; ?>" class="btn btn-sm btn-outline-light">Ask</a>
                                <?php if($status) : ?>
                                <a href="action/delete_bestfriend.php?id=<?php echo $friend_id->id; ?>""><i class="fas fa-heart fa-lg"></i></a>
                                <?php else : ?>
                                <a href="action/add_bestfriend.php?id=<?php echo $friend_id->id; ?>"><i class="far fa-heart fa-lg"></i></a>
                                <?php endif; ?>
                                <a class="" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fas fa-list fa-lg"></i></a>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">All questions</a>
                                    <a class="dropdown-item" href="logout.php">Remove</a>
                                  </div>
                             </span>
                            </li>                              
                        </div>
        
          <?php endforeach; ?>
        
   
                    </div>    
                </div>
            </div>
        </main>

      
      
      
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
