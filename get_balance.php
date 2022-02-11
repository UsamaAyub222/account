<?php 
include("conn.php");
$id = $_GET['balanceid'];
$q1 = "SELECT SUM(amount) as credit FROM ledgers WHERE type='C' and account='{$id}'";
$q2 = "SELECT SUM(amount) as debit FROM ledgers WHERE type='D' and account='{$id}'";
$cr = mysqli_query($conn,$q1);
$dr = mysqli_query($conn,$q2);

$r1 = mysqli_fetch_assoc($cr);
$v1= isset($r1['credit'])?$r1['credit']: 0;

$r2 = mysqli_fetch_assoc($dr);
$v2= isset($r2['debit'])?$r2['debit']: 0;

$balance= $v2-$v1;
echo $balance;
mysqli_close($conn);
exit;
?>
