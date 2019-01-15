<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
}
// select loggedin users detail
$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
$term = trim($_POST['term']);
$term= strtolower($term);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbtest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($term)){
  if (!empty($term)){
$sql = "SELECT cpname, cpcontact, mapurl,adminname,admincontact,estimate,address,cpcity,regby FROM camp_register WHERE cpcity='$term'";
$result = $conn->query($sql);
if ($result->num_rows == 0){
    echo  "<script>alert('No Camp found')</script>";
}

$conn->close();
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">Annapurna</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            </ul>
          <ul class="nav navbar-nav navbar-right">

            <li class="dropdown">
              <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<div id="wrapper">

	<div class="container">

    	<div class="page-header">
    	<h3> Find a Camp </h3>
    	</div>
      <div class="container">
  	<div class="row">
          <div class="col-md-6">
      		<h2>Search for camps!</h2>
              <div id="custom-search-input">
                  <div class="input-group col-md-12">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                      <span class="input-group-btn">
                      <input type="text" name="term" class="form-control input-lg" placeholder="Enter name of city or region" />

                          <button class="btn" style="height: 45px;" type="submit">
                            Search
                          </button>
                      </span>
                  </div></form>
              </div>
          </div>
  	</div>
  </div><br/><br/><br/>
  <table class="table">
  <thead
    <tr>
      <th scope="col">Camp Name</th>
      <th scope="col">Camp Contact</th>
      <th scope="col">Maps URL</th>
      <th scope="col">Camp Admin Name</th>
      <th scope="col">Camp Admin Contact</th>
        <th scope="col">Estimate</th>
          <th scope="col">Address</th>
    </tr>
  </thead>
  <tbody>
  <?php
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo  "<tr>  <th scope='row'>".$row['cpname']."</th>  <td>".$row['cpcontact']."</td><td><a href='".$row['mapurl']."' traget='_blank'>View on maps!</a><td>".$row['adminname']."</td><td>".$row['admincontact']."</td><td>".$row['estimate']."</td><td>".$row['address']."</td> </tr>";
          }
      }
      ?>

  </tbody>
</table>
      	</div>
      </div>

    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>
