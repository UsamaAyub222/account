<?php
include('conn.php');
include("login_check.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fetch Data From DataBase</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script>
		$(document).ready(function (){
			

		});
	</script>
	
</head>
<body class="container-fluid" style="background-color: white;">
		
	<nav class="navbar navbar-expand-lg bg-primary navbar-dark">


		<!-- Links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="home.php">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="accounts.php">Account</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="heads.php">Head</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="ledgers.php">Day-Book</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="h_report.php">Head-Report</a>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="logout.php"> Logout <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
		
	</nav>	
</body>
</html>