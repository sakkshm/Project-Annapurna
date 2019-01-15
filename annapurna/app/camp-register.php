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

ob_start();
	session_start();
	include_once 'dbconnect.php';

	$error = false;

	if ( isset($_POST['btn-signup']) ) {

		// clean user inputs to prevent sql injections
		$name = trim($_POST['cpname']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);

                $address = trim($_POST['address']);
								  $cpcontact = trim($_POST['campcontact']);
									  $mapurl = trim($_POST['mapurl']);
 $adminname = trim($_POST['adminname']);
  $admincontact = trim($_POST['admincontact']);
	 $estimate = trim($_POST['estimatednumber']);
	 	 $cpcity = trim($_POST['cpcity']);

		if (empty($name)) {
			$error = true;
		}


		// if there's no error, continue to signup
		if( !$error ) {
$regby = $userRoW["userId"];
$cpcity = strtolower($cpcity);
			$query = "INSERT INTO camp_register(cpname,cpcontact,mapurl,adminname,admincontact,estimate,address,cpcity,regby) VALUES('$name','$cpcontact','$mapurl','$adminname','$admincontact','$estimate','$address','$cpcity','$regby')";
			$res = mysql_query($query);


			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered";
							header("Location:home.php?campreg=succ");
			echo "<script>alert('Camp registered Successfully');</script>";

			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";
					echo "<script>alert('Something went wrong, try again later...');</script>";
				die("Connection failed : " . mysql_error()."<a href='home.php'>Go back home!</a>");
			}

		}


	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register a Camp - <?php echo $userRow['userName']; ?></title>
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
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
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
    	<h3><span class="glyphicon glyphicon-home" style="font-size:20px;"></span> Register a Camp </h3>
    	</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <div class="form-group">
    <label for="CampName">Camp Name</label>
    <input name="cpname" type="Text" class="form-control" id="CampName" aria-describedby="CampName" placeholder="Enter Camp name">
  </div>
  <div class="form-group">
    <label for="Address">Address</label>
    <input name="address" type="Text" class="form-control" id="Address" placeholder="Enter Address">
  </div>
	<div class="form-group">
		<label for="city/region">City/Region</label>
		<input name="cpcity" type="Text" class="form-control" id="city/region" placeholder="Enter City or Region">
	</div>
<div class="form-group">
    <label for="campcontact">Camp Contact</label>
    <input name="campcontact" type="Text" class="form-control" id="campcontact" placeholder="Enter Camp Contact">
<small id="urlHelp" class="form-text text-muted">Enter a working phone number of the camp !</small>
</div>
  <div class="form-group">
    <label for="Googlemapsurl">Google Maps URL</label>
    <input name="mapurl" type="url" class="form-control" id="Googlemapsurl" placeholder="Enter Maps URL">
<small id="urlHelp" class="form-text text-muted">Locate Your camp on Google maps and share the URL with us, This must be accurate!</small>
</div>
<div class="form-group">
    <label for="adminname">Camp Administrator Name</label>
    <input name="adminname" type="Text" class="form-control" id="adminname" placeholder="Enter Camp Admin Name">
  </div>
<div class="form-group">
    <label for="admincontact">Camp Administrator Contact</label>
    <input name="admincontact" type="Text" class="form-control" id="admincontact" placeholder="Enter Camp Admin Contact">
<small id="urlHelp" class="form-text text-muted">Enter a working phone number of the camp admin!</small>
</div>
<div class="form-group">
    <label for="estimatednumber">Estimated number of needy's</label>
    <input name="estimatednumber" type="number" class="form-control" id="admincontact" placeholder="Enter Estimated number">
<small id="urlHelp" class="form-text text-muted">A rough estimate of the people coming for food</small>
</div>
  <button name="btn-signup" type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    </div>

    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>
