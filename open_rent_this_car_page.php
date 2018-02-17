<?php
$carID = $_GET['id'];
$img = $_GET['image'];
$model = $_GET['model'];
$details = $_GET['details'];
?>


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
?>


<!-- HTML-->

<!-- html/head/<body> -->
<?php include('navbar.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
    box-sizing: border-box;
}

/* Add a gray background color with some padding */
body {
    font-family: Arial;
    padding: 20px;
    background: #f1f1f1;
}

/* Header/Blog Title */
.header {
    padding: 30px;
    font-size: 40px;
    text-align: center;
    background: white;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {   
    float: left;
    width: 75%;
}

/* Right column */
.rightcolumn {
    float: left;
    width: 25%;
    padding-left: 20px;
}

/* Fake image */
.imgs {
    background-color: #aaa;
    width: 100%;
    padding: 20px;
}

/* Add a card effect for articles */
.card {
     background-color: white;
     padding: 20px;
     margin-top: 20px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Footer */
.footer {
    padding: 20px;
    text-align: center;
    background: #ddd;
    margin-top: 20px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media (max-width: 800px) {
    .leftcolumn, .rightcolumn {   
        width: 100%;
        padding: 0;
    }
}
</style>
</head>
<body>



<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h2><?php echo "$model"; ?></h2>
      <h5><?php echo "$details"; ?></h5>
      <div class="imgs">
        <center class="container">
        <img src="<?php echo "$img"; ?>" width="70%%">
        </center>
      </div>
      <p>Book this car now for only 69,- Euros/day!</p>
      <a href="#"><button type="button" class="btn btn-outline-secondary">Rent and pay</button></a>
    </div>
   
  </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>About Happycars</h2>
      <div class="imgs" style="height:86px;"></div>
      <p>Some text about Happycars</p>
    </div>
    <div class="card">
      <h3>Links or other items</h3>
      <div class="imgs"></div><br>
      <div class="imgs"></div><br>
    </div>
    <div class="card">
      <h3>Follow us</h3>
      <div class="imgs"></div><br>    
    </div>
    
  </div>
</div>
</body>
</html> 
 


<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>