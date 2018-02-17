
<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';

	if (!isset($_SESSION['user'])) {
		header("Location: index.php");
	} else if(isset($_SESSION['user'])!="") {
		header("Location: home.php");
	}
	if (isset($_GET['delete'])) {

		// select logged-in users detail
		$query = "SELECT * FROM user WHERE user_id=".$_SESSION['user'];
		$res = mysqli_query($conn, $query);
		$userRow = mysqli_fetch_assoc($res);
		$userEmail = $userRow['email'];

		unset($_SESSION['user']);
		session_unset();
		session_destroy();

		$queryDelete = "
			DELETE FROM `user` 
			WHERE `email` = '$userEmail'
			LIMIT 1
		";

		$deleteUser = mysqli_query($conn, $queryDelete);

		// exit;

		if ($deleteUser){		
			echo "deleted";

		} else {
			echo "error";
		}

		header("Location: index.php");
	}

	ob_end_flush();
?>