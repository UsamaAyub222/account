<?php
include('conn.php');
include("login_check.php");

if ($_POST['name']!='') 
{
	$name = $_POST['name'];
	$id = $_POST['head_id'];

	$query1 = "SELECT * FROM heads WHERE h_name='{$name}' AND h_id<>'{$id}'";
	$result = mysqli_query($conn,$query1);
	if (mysqli_num_rows($result)>0) {
		$ar1 = array("msg"=>"Head Already exist.");
		echo json_encode($ar1);
		mysqli_close($conn);
		exit;	
	}
	else
	{
		$query2 = "UPDATE heads SET h_name='{$name}' WHERE h_id='{$id}'";
		mysqli_query($conn,$query2);
		$ar1 = array("msg"=>"Head updated successfully.");
		echo json_encode($ar1);
		mysqli_close($conn);
		exit;
	}
	
}
?>