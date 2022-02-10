<?php 
if(isset($_SESSION['email']) and $_SESSION['email']!="") 
{

}
else  {
	header("location:signIn.php?ms=1");
	// code...
	exit;
}
?>