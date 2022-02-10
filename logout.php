<?php
include('conn.php');

unset($_SESSION["email"]);
unset($_SESSION["password"]);
session_destroy();
header("Location: " .$config['base_url']."/signIn.php");

?>