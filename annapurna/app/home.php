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
    	<h3> Dashboard </h3>
    	</div>
			<?php
if(isset($_GET["campreg"])){
	if ( $_GET["campreg"] = "succ"){
	echo("<script>alert('Camp Registered succesfully');</script>");
}
else {
	echo("<script>alert('Try again later...');</script>");
}
}
			?>
  <a href="camp-register.php">
        <div class="col">
        <div class="col-lg-3" style="margin:10px;" >
<button type="button" class="btn" style="width: 200px; height: 200px;"> <span class="glyphicon glyphicon-home" style="font-size:70px;"></span><br/> <h3>Register a Camp<h3/></button>

        </div>
        </div>
 </a><a href="find-camp.php">
    <div class="col">
            <div class="col-lg-3" style="margin:10px;">
<button type="button" class="btn" style="width: 200px; height: 200px;"> <span class="	glyphicon glyphicon-search" style="font-size:70px;"></span><br/> <h3>Find a Camp<h3/></button>

        </div>
        </div>
			</a>

<div class="col">
        <div class="col-lg-3" style="margin:10px;">
<button type="button" class="btn" style="width: 200px; height: 200px;"> <span class="	glyphicon glyphicon-user" style="font-size:70px;"></span><br/> <h3>Be a Voulenteer<h3/></button>

        </div>
        </div>
<div class="col">
        <div class="col-lg-3" style="margin:10px;">
<button type="button" class="btn" style="width: 200px; height: 200px;"> <span class="glyphicon glyphicon-cutlery" style="font-size:70px;"></span><br/> <h3>Register as <br/>Food Source<h3/></button>

        </div>
        </div>

<div class="col">
        <div class="col-lg-3" style="margin:10px;">
<button type="button" class="btn" style="width: 200px; height: 200px;"> <span class="glyphicon glyphicon-cutlery" style="font-size:70px;"></span><br/> <h3>Find a<br/>Food Source<h3/></button>

        </div>
        </div>
<div class="col">
        <div class="col-lg-3 " style="margin:10px;">
<button type="button" class="btn" style="width: 200px; height: 200px;"> <span class="	glyphicon glyphicon-earphone" style="font-size:70px;"></span><br/> <h3>Contact Us<h3/></button>

        </div>
        </div>
<div class="col">
        <div class="col-lg-3 " style="margin:10px;">
<button type="button" class="btn" style="width: 200px; height: 200px;"> <span class="	glyphicon glyphicon-piggy-bank" style="font-size:70px;"></span><br/> <h3>Donate<h3/></button>

        </div>
        </div>

</div>
    </div>

    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>
