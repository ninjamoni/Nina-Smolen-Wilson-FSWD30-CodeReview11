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


		$getAllOffices = "
		SELECT * FROM offices ;
	";

	$allOfficesResult = mysqli_query($conn, $getAllOffices);
?>

<style type="text/css">
	


	.card {



		margin-top: 70px;
	}
</style>



<?php include('navbar.php'); ?>

<div class="container" style="border: solid darkgrey 2px;
border-radius: 50px" outline-border-secondary rounded">
	
		<div class="px-5 p-3 m-auto" style="overflow-x:auto;">
			<h3 class="py-2 ">Our offices</h3>
			<table class="table">
				<thead>
    				<td>Station</td> 
    				<td>Adress</td>	
  				</thead>

			<?php 
				while($mediaRow = mysqli_fetch_assoc($allOfficesResult)) {
			?>
				<tbody>	
					<td><?php echo $mediaRow ['offices_id']; ?></td>
					<td><?php echo $mediaRow ['adress']; ?></td>
				</tbody>
			<?php
				}
			?>

			</table>

		</div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>



<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>