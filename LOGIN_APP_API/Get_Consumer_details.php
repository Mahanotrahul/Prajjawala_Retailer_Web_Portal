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
	if(login_details($Submitted_Username, $Submitted_Password, $con) == true)
	{
		$query = mysqli_query($con, "SELECT * FROM RETAILER WHERE LOGIN_USERNAME = '$Submitted_Username'");
		$row = mysqli_fetch_assoc($query);
		$RETAILER_ID = $row['RETAILER_ID'];
		$query = mysqli_query($con, "SELECT * FROM CONSUMER WHERE RETAILER_ID = '$RETAILER_ID'");
		$row = mysqli_fetch_assoc($query);


		for($i = 0; $i<mysqli_num_rows($query); $i = $i + 1)
		{
			$consumer_wt_query = mysqli_query($con,"SELECT GAS_LEFT FROM CONSUMER_REALTIME_GAS_USAGE WHERE CONSUMER_ID = '".$row['CONSUMER_ID']."'");
			while($row1 = mysqli_fetch_assoc($consumer_wt_query))
			{
			    $items[] = $row1;
			}
			$items = array_reverse($items ,true);

			$data = "{'CONSUMER_ID':'".$row['CONSUMER_ID']."','NAME':'".$row['NAME']."','Gas_Left':'".$items[sizeof($items) - 1]['GAS_LEFT']."'} ";
			echo $data;
		}
	}
	else
	{
		echo 'Unable to Fetch any data at this moment.';
	}


}
ob_end_flush();

?>
