<?php
if(!isset($_SESSION)){
	session_start();	
}


$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "test";


// Create connection and check connection
$conn = mysqli_connect($serverName, $userName, $password, $dbName) or die("Connection Failed");

$config['base_url'] = "http://localhost/session";

?>