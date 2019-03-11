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
	echo $db_connection_status;
}
else
{

	include("function.php");
	$db_connection_status = "Connected";
	$error_status = 0;
	//$_SESSION["Login-Key"] = "Prajjawala";
	//print_r($_SESSION);
	$Submitted_id = $_REQUEST['CONSUMER_ID'];




		$date = date("Y-m-d");
		$time = date("H:i:s");


		if($query = mysqli_query($con,"SELECT * FROM CONSUMER_REALTIME_GAS_USAGE WHERE CONSUMER_ID = '$Submitted_id'"))
		{
			//$row = mysqli_fetch_assoc($query);
			//echo mysqli_num_rows($row);

			while($row1 = mysqli_fetch_assoc($query))
			{
			    $items1[] = $row1;
			}

			$items = array_reverse($items1 ,true);
			$x = sizeof($items);

			for($i = $x - 6; $i<$x - 1; $i = $i + 1)
			{
				$data = "{'Gas_Left':'".$items[$i]['GAS_LEFT']."','Time':'".$items[$i]['TIME']."'} ";
				//echo $items[$i]['GAS_LEFT'];
				// $data.= $i;
				// $data.= ":{";
				// $data.= '"GAS_LEFT:"';
				// $data.= $items[$i]['GAS_LEFT'];
				// $data.= "}";
				echo $data;

			}


			//$Gas_left = array('Gas_Left' => $row['GAS_LEFT']);
			//echo($data);
	 	}
		else
		{
			$submit_error = "No Data Available";
			$submit_status = 0;
			$Gas_left = array('Gas_Left' => '0');
			echo(json_encode($Gas_left));
		}

}
ob_end_flush();

?>
