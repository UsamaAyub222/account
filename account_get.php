<?php
include('conn.php');
include("login_check.php");
$query = "SELECT * FROM accounts";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$id = $row['ac_id'];
?>
		<tr id="ac_<?php echo $row['ac_id']; ?>">
			<td><?php echo $row['ac_id']; ?></td>
			<td><?php echo $row['ac_name']; ?></td>
			<td><?php echo $row['ac_type']; ?></td>
			<td>
				<?php
				$q1 = "SELECT SUM(amount) as credit FROM ledgers WHERE type='C' and account='{$id}'";
				$q2 = "SELECT SUM(amount) as debit FROM ledgers WHERE type='D' and account='{$id}'";
				$cr = mysqli_query($conn, $q1);
				$dr = mysqli_query($conn, $q2);

				$r1 = mysqli_fetch_assoc($cr);
				$v1 = isset($r1['credit']) ? $r1['credit'] : 0;

				$r2 = mysqli_fetch_assoc($dr);
				$v2 = isset($r2['debit']) ? $r2['debit'] : 0;

				echo number_format($v2 - $v1);
				?>

			</td>
			<td>
				<button class="btn btn-danger" onclick="delete_record(<?php echo $row['ac_id']; ?>)"> Delete</button>
			</td>
		</tr>
<?php
	}
} else {
	echo "0 results";
}
mysqli_close($conn);

?>