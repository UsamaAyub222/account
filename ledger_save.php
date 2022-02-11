<?php
include('conn.php');
include("login_check.php");
//print_r($_POST);
if (isset($_POST['amount'])) 
{

	$dr = $_POST['dr'];
	$cr = $_POST['cr'];
	$amount = $_POST['amount'];
	$h_id = $_POST['head_name'];
	$description = $_POST['description'];
	$date = date("Y-m-d");
	$timestamp = date("Y-m-d H:i:s");
	if ($cr!=$dr) {
		$d_query = "SELECT ac_type, amount as total, led_id , ref_entry FROM ledgers a LEFT JOIN accounts b ON a.account=b.ac_id WHERE b.ac_type='Detail' AND a.type='D' AND a.account='{$dr}' And led_date='{$date}'";
	#echo $d_query;
		$d_result = mysqli_query($conn,$d_query);
		$d_row = mysqli_fetch_assoc($d_result);

		

		if (mysqli_num_rows($d_result)>0) 
		{


		#print_r($d_row);

			$sum = $d_row['total'] + $amount;
			$d_id = $d_row['led_id'];
			$ref_entry = $d_row['ref_entry'];

			$check_cr = "SELECT account FROM ledgers WHERE led_id='{$ref_entry}'";
			$cr_result = mysqli_query($conn,$check_cr);
			$c_row = mysqli_fetch_assoc($cr_result);

			if($c_row['account']==$cr)
			{
				$d_update = "UPDATE ledgers SET amount='{$sum}' WHERE led_id='{$d_id}'";
				mysqli_query($conn,$d_update);

				$c_update = "UPDATE ledgers SET amount='{$sum}' WHERE led_id='{$ref_entry}'";
				mysqli_query($conn,$c_update);

				$d_insert = "INSERT INTO ledgers_detail(ledger,d_description,d_date,d_amount,account) VALUES ('{$d_id}','{$description}','{$timestamp}','{$amount}','{$dr}')";
				mysqli_query($conn,$d_insert);
				$ar1 = array("msg"=>"Detail Debit account successfully.");
				echo json_encode($ar1);
			//header("location:http://localhost/session/ledgers.php");
				mysqli_close($conn);
				exit;

			}
			else
			{
				$query1 = "INSERT INTO ledgers(account,amount,description,type,led_date,head) VALUES('{$cr}','{$amount}','{$description}','C','{$date}','{$h_id}')";
				mysqli_query($conn,$query1);
				$fst_id = mysqli_insert_id($conn);

				$query2 = "INSERT INTO ledgers(account,amount,description,type,ref_entry,led_date,head) VALUES('{$dr}','{$amount}','{$description}','D','{$fst_id}','{$date}','{$h_id}')";
				mysqli_query($conn,$query2);
				$snd_id = mysqli_insert_id($conn);

				$query3 = "UPDATE ledgers SET ref_entry='{$snd_id}' WHERE led_id='{$fst_id}'";
				mysqli_query($conn,$query3);

				$ac_type = "SELECT ac_type FROM ledgers JOIN accounts ON ledgers.account=accounts.ac_id WHERE ledgers.led_id='{$snd_id}'";
				$type = mysqli_query($conn,$ac_type);
				$ac_row = mysqli_fetch_assoc($type);

				if ($ac_row['ac_type']=='Detail') 
				{
					$d_insert = "INSERT INTO ledgers_detail(ledger,d_description,d_date,d_amount,account) VALUES ('{$snd_id}','{$description}','{$timestamp}','{$amount}','{$dr}')";
					mysqli_query($conn,$d_insert);
				}

			//header("location:http://localhost/session/ledgers.php");
				$ar2 = array("msg"=>"Add new credit account successfully.");
				echo json_encode($ar2);
				mysqli_close($conn);
				exit;
			}
		}

		else
		{

			$query1 = "INSERT INTO ledgers(account,amount,description,type,led_date,head) VALUES('{$cr}','{$amount}','{$description}','C','{$date}','{$h_id}')";
			mysqli_query($conn,$query1);
			$fst_id = mysqli_insert_id($conn);

			$query2 = "INSERT INTO ledgers(account,amount,description,type,ref_entry,led_date,head) VALUES('{$dr}','{$amount}','{$description}','D','{$fst_id}','{$date}','{$h_id}')";
			mysqli_query($conn,$query2);
			$snd_id = mysqli_insert_id($conn);

			$query3 = "UPDATE ledgers SET ref_entry='{$snd_id}' WHERE led_id='{$fst_id}'";
			mysqli_query($conn,$query3);

			$ac_type = "SELECT ac_type FROM ledgers JOIN accounts ON ledgers.account=accounts.ac_id WHERE ledgers.led_id='{$snd_id}'";
			$type = mysqli_query($conn,$ac_type);
			$ac_row = mysqli_fetch_assoc($type);

			if ($ac_row['ac_type']=='Detail') 
			{
				$d_insert = "INSERT INTO ledgers_detail(ledger,d_description,d_date,d_amount,account) VALUES ('{$snd_id}','{$description}','{$timestamp}','{$amount}','{$dr}')";
				mysqli_query($conn,$d_insert);
			}

		//header("location:http://localhost/session/ledgers.php");
			$ar3 = array("msg"=>"Add new account successfully.");
			echo json_encode($ar3);
			mysqli_close($conn);
			exit;	
		}
	}

	else
	{
		$ar4 = array("msg"=>"Credit Debit Account is same");
		echo json_encode($ar4);
	}

}

?>