<?php
include('conn.php');
if (isset($_POST['submit'])) 
{
	$per_name = trim($_POST['name']);
	$per_email = trim($_POST['email']);
	$per_pwd = strval(trim($_POST['password']));
	if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $per_email)) {
		$query = "INSERT INTO persons(name,email,password) VALUES('{$per_name}','{$per_email}','{$per_pwd}')";
		mysqli_query($conn,$query) or die("Query Unsuccessfull.");
		header("Location: http://localhost/session/signIn.php");
	}
	else
	{
		echo "Inavali Email Format.....";
	}
}
mysqli_close($conn);

?>