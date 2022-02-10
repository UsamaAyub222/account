<?php
include('conn.php');
include("login_check.php");


function refid($id)
{
	global $conn;
	$cr_acct = "SELECT * FROM ledgers JOIN accounts ON ledgers.account=accounts.ac_id WHERE ledgers.led_id='{$id}'";
	$get_acct = mysqli_query($conn, $cr_acct);
	$acct_row = mysqli_fetch_assoc($get_acct);
	return $acct_row['ac_name'];
}

?>

<thead class="table-primary">
	<tr>
		<th>ID</th>
		<th>Date</th>
		<th>Narration</th>
		<th>Credit Acct.</th>
		<th>Debit Acct.</th>
		<th>Debit</th>
		<th>Credit</th>
		<th>Balance</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
	<?php
	$cond = '';
	if (isset($_GET['s_account']) and $_GET['s_account'] != "") {
		$cond .= " and ledgers.account='" . $_GET['s_account'] . "'";
	} elseif (isset($_GET['s_account']) and $_GET['s_account'] != "" and isset($_GET['f_date']) and $_GET['f_date'] != "" and isset($_GET['to_date']) and $_GET['to_date'] != "") {
		$cond .= " and ledgers.account='" . $_GET['s_account'] . "' and ledgers.led_date BETWEEN '" . $_GET['f_date'] . "' AND '" . $_GET['to_date'] . "'";
	} elseif (isset($_GET['f_date']) and $_GET['f_date'] != "" and isset($_GET['to_date']) and $_GET['to_date'] != "") {
		$cond .= " and ledgers.led_date BETWEEN '" . $_GET['f_date'] . "' AND '" . $_GET['to_date'] . "'";
	} else {
		$cond .= " and ledgers.led_date=CURDATE()";
	}

	//WHERE 1 = empty;
	$query = "SELECT * FROM ledgers JOIN accounts ON ledgers.account=accounts.ac_id WHERE 1 " . $cond . "ORDER BY ledgers.led_date DESC";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {

	?>
			<tr>
				<td><?php echo $row['led_id']; ?></td>
				<td><?php echo $row['led_date']; ?></td>
				<td><?php echo $row['description']; ?></td>
				<td>
					<?php
					echo refid($row['ref_entry']);
					?>
				</td>
				<td><strong><?php echo $row['ac_name']; ?></strong></td>
				<td><?php if ($row['type'] == 'D') {
						echo number_format($row['amount']);
					} ?></td>
				<td><?php if ($row['type'] == 'C') {
						echo number_format($row['amount']);
					} ?></td>
				<td>
					<?php
					$id = $row['account'];
					$balance_query = "SELECT * FROM accounts WHERE ac_id='{$id}' AND flag=true";
					$balance = mysqli_query($conn, $balance_query);
					if (mysqli_num_rows($balance) > 0) {
						

						$q1 = "SELECT SUM(amount) as credit FROM ledgers WHERE type='C' and account='{$id}'";
						$q2 = "SELECT SUM(amount) as debit FROM ledgers WHERE type='D' and account='{$id}'";
						$cr = mysqli_query($conn, $q1);
						$dr = mysqli_query($conn, $q2);

						$r1 = mysqli_fetch_assoc($cr);
						$v1 = isset($r1['credit']) ? $r1['credit'] : 0;

						$r2 = mysqli_fetch_assoc($dr);
						$v2 = isset($r2['debit']) ? $r2['debit'] : 0;

						$balance = $v2 - $v1;
						echo $balance;
					}

					?>
				</td>
				<td>
				<a class="iframe detailid btn btn-info" href="transaction_detail.php?id=<?php echo $row['account'] ?>" title="Transaction Detatil">View</a>
					<?php
					if ($row['ac_type'] == 'Detail') { ?>
						<a class="iframe detailid btn btn-info" href="ledger_detail.php?id=<?php echo $row['led_id'] ?>" title="Account Detatil">Details</a>
					<?php } ?>
				</td>
			</tr>
	<?php

		}
	} else {
		echo "0 results";
	}
	mysqli_close($conn);

	?>
</tbody>

<script type="text/javascript" src="js/jquery-ui.js"></script>
<link rel="stylesheet" href="css/colorbox.css">
<script src="js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".group1").colorbox({rel:'group1'});
		$(".group2").colorbox({rel:'group2', transition:"fade"});
		$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
		$(".group4").colorbox({rel:'group4', slideshow:true});
		$(".ajax").colorbox();
		$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
		$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
		$(".iframe").colorbox({iframe:true, width:"90%", height:"80%"});
		$(".inline").colorbox({inline:true, width:"50%"});
		$(".callbacks").colorbox({
			onOpen:function(){ alert('onOpen: colorbox is about to open'); },
			onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
			onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
			onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
			onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
		});

		$('.non-retina').colorbox({rel:'group5', transition:'none'})
		$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
		
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
		$(".detailid").tooltip();
	});
</script>