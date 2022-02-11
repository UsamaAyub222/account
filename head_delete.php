<?php
include('conn.php');
include("login_check.php");

if (isset($_GET['delete'])) 
{
	$id = $_GET['delete'];
	$query2 = "SELECT * FROM ledgers WHERE account='{$id}'";
	$result = mysqli_query($conn,$query2);
	if (mysqli_num_rows($result)>0) {
		$ar1 = array("msg"=>"Already Assign to the account.");
		echo json_encode($ar1);
		mysqli_close($conn);
		exit;
	}
	else{
		$query1 = "DELETE FROM heads WHERE h_id='{$id}'";
		$result = mysqli_query($conn,$query1);
		
		$ar1 = array("msg"=>"Delete Head successfully.");
		echo json_encode($ar1);
		mysqli_close($conn);
		exit;		
	}
}
else
{
	mysqli_close($conn);
	exit;
}
?>