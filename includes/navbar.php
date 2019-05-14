<div class="cover-container d-flex p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
          <div class="inner">
          <h3 class="masthead-brand">AskMeQuestion</h3>
          <nav class="nav nav-masthead justify-content-center">          
            <?php if(!$session->is_signed_in()) : ?>
              <a class="nav-link <?php echo active_url('index');  ?>" href="index.php">Home</a>
            <a class="nav-link <?php echo active_url('contact');  ?>" href="#">Contact</a>
            <a class="nav-link <?php echo active_url('login');  ?>" href="login.php">Login</a>
            <?php else : ?>
            <a class="nav-link <?php echo active_url('index');  ?>" href="index.php">New</a>
            <a class="nav-link <?php echo active_url('sentquestions');  ?>" href="sentquestions.php">Sent</a>
            <a class="nav-link <?php echo active_url('seenquestions');  ?>" href="seenquestions.php">Seen</a>
            <a class="nav-link <?php echo active_url('friends');  ?>" href="friends.php">Friends</a>
                  
            <a class="nav-link dropdown-toggle" href="#" id="myDIV" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Profile
            </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">My Profile</a>
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>

            <?php endif; ?>
          </nav>
        </div>
      </header>
