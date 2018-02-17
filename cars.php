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

	$filter = "all";



	?>

<!-- HTML-->

<!-- html/head/<body> -->

	<style type="text/css">
		
		body{

			background-color: white;
		}

	.split {
    height: 400px;
    width: 50%;
   
    top: 0;
   
    background-color: white;
}

.left {

overflow-x: ;

margin-bottom: 30px


}

.right {
    right: 0;
background-color: #f3f3f3;
padding-top:100px;
padding-bottom:10px;

line-height: 2;
margin-bottom: 30px
}

.centered {

    top: 50%;
    left: 50%;

    text-align: center;
}
.cars{
padding: 80px;
}
.centered img {
    width: 150px;
    border-radius: 50%;
}

.text-center{

	margin: 0 auto;
}

.btn-group-lg{

	padding: 40px;
}

.text-center{

margin-bottom: 30px ;
}


	</style>

<?php include('navbar.php'); ?>

	<div class="jumbotron">
	  <h1 class="display-3">Hello, <?php echo ucwords($userRow['first_name']); ?>!</h1>
	  </div>

	<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="img/audi.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="img/home2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="img/bmw.jpg" alt="Third slide">
      </div>
    </div>

	</div>


<?php


$sql1 = "SELECT * FROM cars WHERE car_id = 1 || car_id = 5 || car_id = 10";

$result1 = $conn->query($sql1);



if ($result1->num_rows > 0) {
  echo '
  <main role="main" class="main">
    <div class="album py-5 ">
    <div class="container">
    <div class="row">
          ';

    while($row1 = $result1->fetch_assoc()) {
      echo '
   

  <div class="split left">

    <center class="container">
      <img class="cars" src='.$row1["image"].' height="100%" >
    </center>
  </div>

  <div class="split right">
    <div class="centered">

  <h2>'.$row1["model"].' </h2>
    
  <h3>'.$row1["details"].' </h3>
  <br>

    
    <a href="open_rent_this_car_page.php?id='.$row1["car_id"].'&details='.$row1["details"].'&model='.$row1["model"].'&image='.$row1["image"].'    " ><button type="button" class="btn btn-outline-secondary">Rent</button></a>
  
  </div>
</div>



   
            ';
    }
       echo "
           </div>
          </div>
        </div>
      </main>";
 } else {
    echo "0 results";
}



?>

		




		

<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>