<?php
include('conn.php');
include("login_check.php");

if (isset($_POST['name'] ) && isset($_POST['type'])) 
{
	$name = $_POST['name'];
	$type = $_POST['type'];
	$date = date("Y-m-d");

	$query = "INSERT INTO accounts(ac_name,ac_type,ac_date) VALUES('{$name}','{$type}','{$date}')";
	mysqli_query($conn,$query);
	$ar1 = array("msg"=>"Add Account Successfully.");
	echo json_encode($ar1);
	//header("location:http://localhost/session/accounts.php");
	mysqli_close($conn);
	exit;
}
else
{
	$ar1 = array("msg"=>"Enter name or Select the type of Bank.");
	echo json_encode($ar1);
}

?>