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
	echo $error_code;
}
else
{
	include("function.php");
	$db_connection_status = "Connected";
	$error_status = 0;
	//$_SESSION["Login-Key"] = "Prajjawala";
	//print_r($_SESSION);

	$Submitted_Username = $_REQUEST['Username'];
	$Submitted_Password = $_REQUEST["Password"];
	if(consumer_login_details($Submitted_Username, $Submitted_Password, $con) == true)
	{
		$RECEIVED = get_consumer_details($Submitted_Username, $Submitted_Password, $con);
		$LOGIN = 1;
		$CONS_DETAILS = array('Login_Successfull' => $LOGIN);
		$FINAL_DATA = array_merge($CONS_DETAILS, $RECEIVED);
		echo(json_encode($FINAL_DATA));
	}
	else{
		$LOGIN = 0;
		echo '{"Login_Successfull": '.$LOGIN.'}';
	}


}
ob_end_flush();

?>
