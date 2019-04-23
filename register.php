<?php include 'core/init.php'; ?>
<?php if($session->is_signed_in()) {redirect("index.php");} ?>


<?php

$message = '';

if(isset($_POST['submit']))
{
    $username = trim($_POST['username']);
    $useremail = trim($_POST['useremail']);
    $password = trim($_POST['password']);
    $passwordverify = trim($_POST['passwordverify']);
    
    if(isset($username) && isset($useremail) && isset($password) && isset($passwordverify))
    {
        $user = new User();
        if($user->register($username, $useremail, $password, $passwordverify))
        {
        $message = 'User added succesfully';
        }
        else
        {
        $message = join("<br>", $user->errors);
        }
    }  
}
 else
{
$username = '';
$useremail = '';
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

      <div class="row cover h-100 p-3">
          <div class="col-lg-6 mx-auto"></div>
                <div class="col-lg-6 mx-auto">
                    <div class="card bg-dark text-white border-secondary">
                        <div class="card-header">
                            <h3 class="mb-0 my-2">Sign Up</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" autocomplete="off" method="post">
                                <div class="form-group">
                                    <label>Profile name</label>
                                    <input type="text" class="form-control" name="username" placeholder="Profile name" required="" value="<?php echo htmlentities($username) ?>">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="useremail" placeholder="email@gmail.com" required="" value="<?php echo htmlentities($useremail) ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="password" title="At least 6 characters" required="">
                                </div>
                                <div class="form-group">
                                    <label>Verify password</label>
                                    <input type="password" class="form-control" name="passwordverify" placeholder="password" required="">
                                </div>
                                <a><?php echo $message; ?></a>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Register" class="btn btn-secondary btn-lg float-right">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->

      <footer class="mastfoot">
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
