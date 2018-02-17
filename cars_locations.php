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

	$queryAutoReturn = "
		DELETE FROM cars_status
		WHERE CURRENT_TIMESTAMP > `status` + INTERVAL 90 DAY
	";

	$resAutoReturn = mysqli_query($conn, $queryAutoReturn);

	//show selected colums
	$getAllInfo = "SELECT image, model, details, adress, status
					FROM cars
					INNER JOIN offices ON cars.fk_offices_id = offices.offices_id
					INNER JOIN cars_status ON cars.car_id = cars_status.fk_car_id";

	$allInfoResult = mysqli_query($conn, $getAllInfo);



	//on click check if item is available
	if (isset($_GET['car_id'])) {
		$insert = $_GET['car_id'];

	
		$reseRes = mysqli_query($conn,$getReservations);
		$countRes = mysqli_num_rows($reseRes);
		
		if ($countRes!=0) {
			$errMSG = "I'm sorry! This car has already been rented";

		// borrow item
		} else {
			$queryBorrow = "
				INSERT INTO cars_status (fk_car_id, fk_user_id)
				VALUES
				($insert, $userID);
			";

			$res = mysqli_query($conn, $queryBorrow);
			header("Location: cars_locations.php");
			$borrowedRows = $borrowedRows+1;

			//create a rented cars history (stays even when returned)
			$queryHistory = "
				INSERT INTO history (fk_car_id, fk_user_id)
				VALUES
				($insert, $userID);
			";

			$resHis = mysqli_query($conn, $queryHistory);
			$borrowedRows = $borrowedRows+1;

			if ($res && $resHis) {
				$errMSG = "Successfully rented. Check your Account";
			} else {
				$errMSG = "Something went wrong, try again later...";
			}
		}
	}



	$queryaddress = "
			
			";
			$res = mysqli_query($conn, $query);
		$userRow = mysqli_fetch_assoc($res);
		$userID = $userRow['user_id'];



?>


<style type="text/css">
	

	table{

		text-align: center;
	}

	.td {
    padding: 2.3rem;
}
</style>

<!-- HTML-->

<!-- html/head/<body> -->
<?php include('navbar.php'); ?>
	<div class="jumbotron">
	  <h1 class="display-3">Hello, <?php echo ucwords($userRow['first_name']); ?>!</h1>
	  <p class="lead">Welcome to Happycars.</p>
	  <p>Want to rent a car? You can choose your perfect car here:

		  <?php
		  	echo $borrowedRows; 
		  ?>
	  	
	  </p>
	  <hr class="my-4">


	  <?php
	    if ( isset($errMSG) ) {
	  ?>

	    <div class="alert">
	     <?php echo $errMSG; ?>
	    </div>

	  <?php
	  }
	  ?>


	  <p class="lead">
	    <a class="btn btn-primary btn-lg" href="#carselect
	    " role="button">See more</a>
	  </p>
	</div>


	<div class="container-fluid row mx-auto">
		
		<div class="px-5 p-3 m-auto" style="overflow-x:auto;">
			<h3 class="py-2 " id="carselect">Select a car</h3>
			<table class="table table-hover table-striped">
				<thead>
    				<th>Image</th> 
    				<th>Model</th>
    				<th>Details</th>
    				<th>Status</th>
    				<th>Adress</th>
  				</thead>

			<?php 
				while($infoRow = mysqli_fetch_assoc($allInfoResult)) {
			?>
				<tr>
					 <td><img src="<?php echo $infoRow  ['image']; ?>" alt="car image" style="max-height:45px; max-width:45px;"></td> 
					<td><?php echo $infoRow ['model']; ?></td>
					<td><?php echo $infoRow ['details']; ?></td>
					<td><?php echo $infoRow ['status']; ?></td>
					<td><?php echo $infoRow ['adress']; ?></td>
				
					<td>
						<?php  
							if (empty($infoRow['reservation_id'])) {
						?>

						<a class="to_rent" id="visibility" href="cars.php"><button type="button" class="btn btn-outline-primary">Rent</button></a>
						<?php
						
							} else {
						?>
								<a class="text-muted not-active" >Unavailable</a>
						<?php
							}
						?>
					</td>

				</tr>
			<?php
				}
			?>

			</table>

		</div>




<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>