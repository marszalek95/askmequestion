<?php include 'core/init.php'; ?>
<?php if($session->is_signed_in()) {redirect("index.php");} ?>


<?php

$message = '';

if(isset($_POST['submit']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if(isset($username) && isset($password))
    {
    
    $user_found = User::find_by_name('username' ,$username);   
    
    if($user_found)
    {
    if(password_verify($password, $user_found->password))
    {
        $session->login($user_found);
        redirect("index.php");
     
    }
    else
    {
        $message = "Your password or username are incorrect! <br>";
    }
    }
    else
    {
        $message = "User with this username not found";
    }
    }  
}
 else
{
$username = '';
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

  <body>

    <?php include 'includes/navbar.php'; ?>

      <div class="row h-100 p-3">
          <div class="col-lg-6 mx-auto"></div>
                <div class="col-lg-6 mx-auto">
                    <div class="card bg-dark text-white border-secondary">
                        <div class="card-header">
                            <h3 class="mb-0 my-2">Login</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" method="post" autocomplete="off">
                                <div class="form-group">
                                    <label>Profile name</label>
                                    <input type="text" class="form-control" name="username" placeholder="Profile name" value="<?php echo $username; ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="password" required="">
                                </div>
                                <a><?php echo $message; ?></a>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Sign In" class="btn btn-secondary btn-lg float-right">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->

      <footer class="mastfoot mt-auto">
        <div class="container text-center">
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
  </body>
</html>
