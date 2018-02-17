<?php
	ob_start();
	session_start();
  	include_once 'dbconnect.php';

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}

	// select logged-in users detail
	$query = "SELECT * FROM users WHERE user_id=".$_SESSION['user'];
	$res = mysqli_query($conn, $query);
	$userRow = mysqli_fetch_assoc($res);
	$userID = $userRow['user_id'];

	$resAutoReturn = mysqli_query($conn, $queryAutoReturn);	

?>

<!-- HTML -->

<!-- html/head/<body> -->
<style type="text/css">

  .hero-image {
  background-image: url("home.jpg");
  height: 50%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;

}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: black;
}


.hero-text button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 10px 25px;
  color: black;
  text-align: center;
  cursor: pointer;
}

.text-muted{
  color: black;
}

.ci{
 padding: 70px 0px;
}


</style>

	<?php include('navbar.php'); ?>

  <div class="card text-center">
  <div class="card-body">
    <div> <h2> Welcome at Happycars</h2> </div> 
  </div>
  <div class="card-footer">

	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 ci img-responsive" src="img/home2.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 ci img-responsive" src="img/home.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 ci img-responsive" src="img/home3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



<div class="card text-center">
 
  <div class="card-body">
    <div> </div> 
    <p class="card-text">Renting a car has never been easier. Register, log in and drive. <br> With Happycars you will enjoy the car that you choose .</p>
   
  </div>
  <div class="card-footer">
<div class="card-group">
  <div class="card">
  
    <div class="card-body">

<i class="fas fa-user fa-3x"></i>
      <h5 class="card-title">Register</h5>
      <p class="card-text">Sign up now to choose a car and drive.<br>Create you own account.</p>

    </div>
  </div>
  <div class="card">
  
    <div class="card-body">

    	<i class="fa fa-desktop fa-3x"></i>
      <h5 class="card-title">Search & Reserve</h5>
      <p class="card-text">With Happycars you can see immediately which cars are available for you.<br> Choose one and reserve it.</p>

    </div>
  </div>
  <div class="card">
   
    <div class="card-body">

    	<i class="fas fa-car fa-3x"></i>

      <h5 class="card-title">Pick up your car</h5>
      <p>Pick up your car in four central locations in Vienna and return in any of our offices.</p>

    </div>
  </div>
</div>
<br>
 <a href="contactus.php" class="btn btn-secondary">Reservation</a>
 <br>
 <br>
  </div>
</div>


<div class="card text-center">
  
  <div class="card-body">
    <h5 class="card-title">Make your car-dreams come true with Happycars</h5>
    <img class="card-img" src="img/audi.jpg">
  </div>
  <div class="card-footer text-muted">
    <div class="card text-center">
  
  <div class="card-body">
    <h5 class="card-title">Check our cars out!</h5>
    <p class="card-text">Different types of cars are waiting for you.</p>
  </div>
  

</div>
  <div class="card-footer text-muted">
  <div class="card-group">
  <div class="card">
  
    <div class="card-body">
      <h5 class="card-title">Sport cars</h5>
      <img class="card-img" src="img/mercedes.jpg">
      
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Business cars</h5>
      <img class="card-img" src="img/bmw.jpg">
    </div>
  </div>
  <div class="card">

    <div class="card-body">
      <h5 class="card-title">Small cars</h5>
      <img class="card-img" src="img/blacksmart.jpg">
    </div>
  </div>
</div>
</div>
</div>


<div class="card text-center">

  
</div>
 <a href="cars.php" class="btn btn-secondary">see more</a>
  </div>
</div>

		

<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>