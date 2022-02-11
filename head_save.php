<?php
include('conn.php');
include("login_check.php");

if ($_POST['name']!='') 
{
	$name = $_POST['name'];

	$query1 = "SELECT * FROM heads WHERE h_name='{$name}'";
	$result = mysqli_query($conn,$query1);
	if (mysqli_num_rows($result)>0) {
		$ar1 = array("msg"=>"Already exist.");
		echo json_encode($ar1);
		mysqli_close($conn);
		exit;	
	}
	else
	{
		$query2 = "INSERT INTO heads(h_name) VALUES('{$name}')";
		mysqli_query($conn,$query2);
		$ar1 = array("msg"=>"Successfully added.");
		echo json_encode($ar1);
		mysqli_close($conn);
		exit;
	}
	
}
else
{
	$ar1 = array("msg"=>"Enter name of Heads.");
	echo json_encode($ar1);
	mysqli_close($conn);
	exit;
}
?>