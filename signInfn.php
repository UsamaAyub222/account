<?php
include('conn.php');
if (isset($_GET['submit'])) 
{
	$per_email = trim($_GET['email']);
	$per_pwd = (trim($_GET['password']));
	$query = "SELECT * FROM persons WHERE email='{$per_email}' and password='{$per_pwd}'";
	$result = mysqli_query($conn,$query) or die("Query Unsuccessfull.");
	if (mysqli_num_rows($result)>0) {
		$_SESSION['email'] = $per_email;
		$_SESSION['password'] = $per_pwd;
		
		header("Location: " .$config['base_url']."/home.php");
	}
	else
	{
		echo "Wrong Email or password";
	}
	
}
mysqli_close($conn);

?>