<?php
include('conn.php');
include("login_check.php");
$id = $_GET['id'];
$date = date("Y-m-d");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Details</title>
	<?php 
	include('head.php');
	?>
</head>
<body>
	<?php 
	
	$ac_name = "SELECT b.ac_name FROM ledgers_detail as a LEFT JOIN accounts as b ON a.account=b.ac_id WHERE ledger='{$id}'";
	$result1 = mysqli_query($conn,$ac_name);

	$get_name = mysqli_fetch_assoc($result1);
	?>
	<h3 style="text-align: center; padding: 10px;"><?php echo $get_name['ac_name'] ?> Account Detail.</h3>
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<table class="table table-hover">
				<thead class="table-primary">
					<tr>
						<th>Id</th>
						<th>Date</th>
						<th>Narration</th>
						<th>Ledger Id</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = "SELECT * FROM ledgers_detail WHERE ledger='{$id}'";
					$result = mysqli_query($conn,$query);
					if (mysqli_num_rows($result)>0) {
						while ($row = mysqli_fetch_assoc($result)) {

							?>
							<tr>
								<td><?php echo $row['d_id'];?></td>
								<td><?php echo $row['d_date'];?></td>
								<td><?php echo $row['d_description'];?></td>
								<td><?php echo $row['ledger']; ?></td>
								<td><?php echo $row['d_amount'];?></td>
								
							</tr>
							<?php
						}
					}
					else{
						echo "0 results";
					} 
					mysqli_close($conn);

					?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-1"></div>
	</div>

</body>
</html>