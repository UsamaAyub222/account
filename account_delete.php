<?php
include('conn.php');
include("login_check.php");

if (isset($_GET['delete'])) 
{
	$id = $_GET['delete'];

	$query2 = "SELECT * FROM ledgers WHERE account='{$id}'";
	$result = mysqli_query($conn,$query2);
	if (mysqli_num_rows($result)>0) {
		$age = array("msg"=>"Account already used in leadger.");

		echo json_encode($age);
		mysqli_close($conn);
		exit;
	}
	else
	{
		$query = "DELETE FROM accounts Where ac_id={$id}";
		mysqli_query($conn,$query);
		$age = array("msg"=>"Account successfully deleted.");
		echo json_encode($age);
		mysqli_close($conn);
		exit;
	}	
}
?>