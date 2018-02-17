<?php
  ob_start();
  session_start();
  require_once 'dbconnect.php';
  // it will never let you open index(login) page if session is set
  if ( isset($_SESSION['user'])!="" ) {
    header("Location: home.php");
    exit;
  }
  $error = false;
  if( isset($_POST['btn-login']) ) {
    // prevent sql injections/ clear user invalid inputs
    $user_email = trim($_POST['user_email']);
    $user_email = strip_tags($user_email);
    $user_email = htmlspecialchars($user_email);
    $user_pass = trim($_POST['user_pass']);
    $user_pass = strip_tags($user_pass);
    $user_pass = htmlspecialchars($user_pass);
  
    // prevent sql injections / clear user invalid inputs
    if(empty($user_email)){
      $error = true;
      $emailError = "Please enter your Emailaddress.";
    } else if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
      $error = true;
      $emailError = "Please enter valid Emailaddress.";
    }
    if(empty($user_pass)){
      $error = true;
      $passError = "Please enter your password.";
    }
    // if there's no error, continue to login
    if (!$error) {
      $password = hash('sha256', $user_pass); // password hashing using SHA256
      $query = "SELECT * FROM users WHERE user_email='$user_email'";
      $res = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($res);
      $count = mysqli_num_rows($res); // if email/pass correct it returns must be 1 row
      
      // print_r($row); 
      
      if( $count != 1 ) {
        $errMSG = "Please register first";
      } else if ($row['user_pass']==$password) {
        $_SESSION['user'] = $row['user_id'];
        header("Location: home.php");
      } else {
        $errMSG = "Incorrect Password, please try again...";
      }
    }
  }

?>



<!-- HTML -->

<!-- html/head/<body> -->
<?php include('navbar.php'); ?>

  <div class="container-fluid row mx-auto">
  
  <!-- FORM LOG IN -->

  

    <div class="col-lg-3 col-md-10 col-sm-10 m-auto" id="services-cards">
      <div class="box wow fadeInUp">
        <i class="far fa-star fa-3x mb-3"></i>
        <h1>Happycars car rental</h1>

        <ul>
          <li><i class="ion-android-checkmark-circle"></i>best service in town</li>
          <li><i class="ion-android-checkmark-circle"></i> cheap package offers</li>
          <li><i class="ion-android-checkmark-circle"></i>cars include GPS/Navigation</li>
          <li><i class="ion-android-checkmark-circle"></i> four pick-up and return-locations </li>
        </ul>
        <a href="#" class="get-started-btn">Find out more</a>
      </div>
    </div>

      <div class="container col-lg-4 col-md-10 col-sm-10 m-auto my-auto">

    <?php 
      if( isset($_GET['success'])) { ?>
        <div class="alert alert-secondary">
          <strong>Successfully registered</strong>
        </div>
      <?php 
        }
      ?>
      <h1 style="color: darkcyan; padding-bottom:30px; border: solid lightgrey 1px; border-radius: 5px;font-size: 80px"><b><center>Happycars</center></b></h1>

      <form class="form-control" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
        <h2>Log In</h2>
        <hr />
        <?php
          if ( isset($errMSG) ) {
        ?>

          <div class="alert text-danger">
            <?php echo $errMSG; ?>
          </div>

        <?php
        }
        ?>
        
        <div class="form-group">
          <input type="email" name="user_email" class="form-control" placeholder="Your Email" value="<?php echo $user_email; ?>" maxlength="40" />
          <span class="text-danger"><?php echo $emailError; ?></span>
        </div>
        <div class="form-group">
          <input type="password" name="user_pass" class="form-control" placeholder="Your Password" maxlength="15" />
          <span class="text-danger"><?php echo $passError; ?></span>
        </div>
        
        <hr />
        <button class="btn btn-block btn-primary col-8 m-auto" type="submit" name="btn-login">Log In</button>
        <hr />
        <a href="register.php">Create your own account here...</a>
      </form>
    </div>



    <div class="col-lg-3 col-md-10 col-sm-10 m-auto" id="services-cards">
      <div class="box wow fadeInRight">
        <i class="far fa-star fa-3x mb-3"></i>
        <h1>Happycars Locations</h1>

        <ul>
          <li><i class="ion-android-checkmark-circle"></i>offices in 4 central locations</li>
          <li><i class="ion-android-checkmark-circle"></i>easy to access</li>
          <li><i class="ion-android-checkmark-circle"></i>friendly staff</li>
          <li><i class="ion-android-checkmark-circle"></i>previous reservation possible</li>
        </ul>
        <a href="#" class="get-started-btn">Register to get started</a>
      </div>
    </div>

  </div>

<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>