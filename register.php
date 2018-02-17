<?php
  ob_start();
  session_start(); // start a new session or continues the previous
  if( isset($_SESSION['user'])!="" ){
    header("Location: home.php"); // redirects to home.php
  }

  include_once 'dbconnect.php';
  $error = false;


  if ( isset($_POST['btn-signup']) ) {
    // sanitize users input to prevent sql injection

    $name = trim($_POST['first_name']);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);

    $last_name = trim($_POST['last_name']);
    $last_name = strip_tags($last_name);
    $last_name = htmlspecialchars($last_name);


    $gender = trim($_POST['gender']);
    $gender = strip_tags($gender);
    $gender = htmlspecialchars($gender);

    $birthdate = trim($_POST['birthdate']);
    $birthdate = strip_tags($birthdate);
    $birthdate = htmlspecialchars($birthdate);


    $user_email = trim($_POST['user_email']);
    $user_email = strip_tags($user_email);
    $user_email = htmlspecialchars($user_email);

    $user_pass = trim($_POST['user_pass']);
    $user_pass = strip_tags($user_pass);
    $user_pass = htmlspecialchars($user_pass);


    // first name validation
    if (empty($name)) {
      $error = true;
      $nameError = "Please enter your full first name.";
    } else if (strlen($name) < 3) {
      $error = true;
      $nameError = "Name must have at leat 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
      $error = true;
      $nameError = "Name must contain alphabets and space.";
    }

    //last name validation
    if (empty($last_name)) {
      $error = true;
      $last_nameError = "Please enter your full last name.";
    } else if (strlen($last_name) < 3) {
      $error = true;
      $last_nameError = "Last name must have at leat 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
      $error = true;
      $last_nameError = "Last name must contain alphabets and space.";
    }
    
    //basic email validation
    if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
      $error = true;
      $emailError = "Please enter valid user_email address.";
    } else {
      // check whether the email exist or not
      $query = "SELECT user_email FROM users WHERE user_email='$user_email'";
      $result = mysqli_query($conn, $query);
      $count = mysqli_num_rows($result);
      
      if($count!=0){
        $error = true;
        $emailError = "Provided Email is already in use.";
      }
    }
    // password validation
    if (empty($user_pass)){
      $error = true;
      $passError = "Please enter password.";
    } else if(strlen($user_pass) < 6) {
      $error = true;
      $passError = "Password must have at least 6 characters.";
    }
    
    // password encrypt using SHA256();
    $password = hash('sha256', $user_pass);
    
    // if there's no error, continue to signup
    if( !$error ) {
      $query = "
      INSERT INTO users(first_name, last_name, user_email, user_pass, gender, birthdate) 
      VALUES('$name', '$last_name', '$user_email','$password', '$gender', '$birthdate')
      ";

      $res = mysqli_query($conn, $query);
      
      if ($res) {
        //to clean form inputs
        // unset($name);
        // unset($last_name);
        // unset($email);
        // unset($pass);
        header("Location: index.php?success=true");
      } else {
        $errMSG = "Something went wrong, try again later...";
      }
    }
  }
?>


<!-- HTML -->

<!-- html/head/<body> -->
<?php include('navbar.php'); ?>

  <div class="container col-lg-6 col-m-8 col-sm-10 col-xs-12">

    <form class="form-control" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
      <h2>Registration</h2>
      <hr>

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
        <input  type="text" name="first_name" class="form-control" placeholder="Enter First Name" maxlength="50" value="<?php echo $name ?>" />
        <span class="text-danger"><?php echo $nameError; ?></span>
      </div>

      <div class="form-group">
        <input  type="text" name="last_name" class="form-control" placeholder="Enter Last Name" maxlength="50" value="<?php echo $last_name ?>" />
        <span class="text-danger"><?php echo $last_nameError; ?></span>
      </div>


      <div class="form-group">
        <label class="label label-default" >Gender:</label>
          <select class="custom-select form-control" name="gender" value="<?php echo $gender ?>" />
            <option selected value="male">Male</option>
            <option selected value="female">Female</option>
            <option selected value="others">Others</option>
          </select>
        <span class="text-danger"></span>
      </div>


      <div class="form-group">
        <label class="label label-default" >Birthdate:</label>
          <input  type="date" name="birthdate" class="form-control" placeholder="birthdate" maxlength="50" value="<?php echo $birthdate?>" />
        <span class="text-danger"></span>
      </div>

      <div class="form-group">
        <input type="email" name="user_email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $user_email ?>" />
        <span class="text-danger"><?php echo $emailError; ?></span>
      </div>
      
      <div class="form-group">
        <input type="password" name="user_pass" class="form-control" placeholder="Enter Password" maxlength="15" />
        <span class="text-danger"><?php echo $passError; ?></span>
      </div>

      <hr />

      <button type="submit" class="btn btn-block btn-primary col-8 m-auto" name="btn-signup" onclick="AlertIt()">Register</button>
      <hr />
      <a href="index.php">To Log In, press here...</a>
    </form>
  </div>

  
<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>