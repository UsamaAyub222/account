<?php
include('conn.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>sign-in</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="jumbotron" style="background-color: white;">
	<?php 
	
	if(isset($_GET['ms']))
		{
			if($_GET['ms']==1)
			{
				echo "<h3 class='alert alert-danger'>Please login first.</h3>";
			}
		}


	 ?>

	<div class="container">
  <form action="signInfn.php" method="get">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button><a href="index.php" style="float: right;">Sign Up.</a>
  </form>
</div>

</body>
</html>

