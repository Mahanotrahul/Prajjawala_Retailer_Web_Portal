<?php session_start();
ob_start();
$host = "localhost";
$username = "u402156879_lpg1";
$password = "!prajjwala2k18";
$dbname = "u402156879_lpg1";

$con=mysqli_connect($host,$username,$password,$dbname);
if(mysqli_connect_errno())
{
	$db_connection_status =  "Error occured when coonection with database";
	$error_code = 0;
}
else
{
	$db_connection_status = "Connected";
	$error_code = 1;
	$_SESSION["Login-Key"] = "Prajjwala";
	//print_r($_SESSION);
	
}
ob_end_flush();

?>