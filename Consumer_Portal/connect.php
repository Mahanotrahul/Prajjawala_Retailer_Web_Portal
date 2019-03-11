<?php session_start();
ob_start();
$host = "localhost";
$username = "u402156879_lpg1";
$password = "!prajjwala2k18";
$dbname = "u402156879_lpg1";

$con=mysqli_connect($host,$username,$password,$dbname);
if(mysqli_connect_errno())
{
	$db_connection_status =  "Error occured when connecting with database";
	$error_status = 1;
}
else
{
	$db_connection_status = "Connected";
	$error_code = 1;
	$_SESSION["Login-Key"] = "Vasitars";
	//print_r($_SESSION);

}
ob_end_flush();

?>
