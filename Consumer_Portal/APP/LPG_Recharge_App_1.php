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
	$Submitted_Username = $_REQUEST['Username'];
	$Submitted_Password = $_REQUEST["Password"];


	if(login_details($Submitted_Username, $Submitted_Password, $con) == true)
	{
		$query = "SELECT * FROM RETAILER WHERE LOGIN_USERNAME = '$Submitted_Username'";
		$result = mysqli_query($con,$query);
		$retrieve_result = mysqli_fetch_assoc($result);
		$RETAILER_NAME = $retrieve_result['NAME'];
		$RETAILER_ID = $retrieve_result['RETAILER_ID'];
		$RETAILER_AADHAAR_NUMBER = $retrieve_result['AADHAAR_NUMBER'];
		$RETAILER_PASSWORD = $retrieve_result['LOGIN_PASSWORD'];
		$LOGIN_USERNAME = $retrieve_result['LOGIN_USERNAME'];

		$SUBMITTED_CONSUMER_ID = $_REQUEST['CONSUMER_ID'];
		$SUBMITTED_CONSUMER_PHONE_NUMBER = $_REQUEST["CONSUMER_PHONE_NUMBER"];
		$SUBMITTED_RECHARGE_AMOUNT = $_REQUEST['RECHARGE_AMOUNT'];
		$SUBMITTED_RETAILER_AADHAAR_NUMBER = $_REQUEST["SUBMIT_RETAILER_AADHAAR_NUMBER"];
		$SUBMITTED_RETAILER_PASSWORD = $_REQUEST["RETAILER_PASSWORD"];



		if (!consumer_id_exists($SUBMITTED_CONSUMER_ID,$RETAILER_ID,$con))
		{
			$submit_error = "The Customer is not registered. Please check CONSUMER ID";
			$submit_status = 0;
		}
		else if(strlen($SUBMITTED_CONSUMER_PHONE_NUMBER)!=10)
		{
			$submit_error = "Phone Number is not valid. Phone Number should have 10 digits";
			$submit_status = 0;

		}
		else if(strlen($SUBMITTED_RETAILER_AADHAAR_NUMBER)!=12)
		{
			$submit_error = "AADHAAR Number is not valid";
			$submit_status = 0;

		}
		else if($SUBMITTED_RETAILER_AADHAAR_NUMBER != $RETAILER_AADHAAR_NUMBER)
		{
			$submit_error = "Aadhaar number did not match";
			$submit_status = 0;

		}
		else if($SUBMITTED_RETAILER_PASSWORD != $RETAILER_PASSWORD)
		{
			$submit_error = "Incorrect Password ";
			$submit_status = 0;

		}
		else
		{
			$date = date("Y-m-d");
			$time = date("H:i:s");
			$SUBMITTED_RECHARGE_GAS_EQUIVALENT = $SUBMITTED_RECHARGE_AMOUNT;
			$STATUS = 1;

			$insert_query="INSERT INTO CONSUMER_GAS_USAGE(CONSUMER_ID,RECHARGE_DATE,RECHARGE_TIME,RECHARGE_AMOUNT,RECHARGE_GAS_EQUIVALENT,STATUS) VALUES('$SUBMITTED_CONSUMER_ID','$date','$time','$SUBMITTED_RECHARGE_AMOUNT','$SUBMITTED_RECHARGE_GAS_EQUIVALENT','$STATUS')";

			if(mysqli_query($con,$insert_query))
			{

				$submit_error = "Recharged Succesfully for Rs. ".$SUBMITTED_RECHARGE_AMOUNT;
				$submit_status = 1;



				$URL = "http://168.87.87.213:8080/davc/m2m/HPE_IoT/9c65f9fffe218a69/DownlinkPayload";
				$SUBMITTED_RECHARGE_AMOUNT = $SUBMITTED_RECHARGE_GAS_EQUIVALENT;
				$encoded_recharge_amount = '{"Recharge_Gas_Equivalent":';
				$encoded_recharge_amount.= $SUBMITTED_RECHARGE_AMOUNT;
				$encoded_recharge_amount.= '}';
				$encoded_recharge_amount = base64_encode($encoded_recharge_amount);


				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_PORT => "8080",
				  CURLOPT_URL => $URL,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>  "{\r\n\r\n    \"m2m:cin\":\r\n\r\n    {\r\n\r\n      \"ty\":4,\r\n\r\n      \"cs\":300,\r\n\r\n      \"con\": \"{\\\"payload_dl\\\":{\\\"deveui\\\":\\\"9c65f9fffe218a69\\\",\\\"port\\\":2,\\\"confirmed\\\":false,\\\"data\\\":\\\"$encoded_recharge_amount\\\",\\\"on_busy\\\":\\\"fail\\\",\\\"tag\\\":\\\"9886151777dse\\\"}}\"\r\n\r\n    }\r\n\r\n} \r\n\r\n",
				  CURLOPT_HTTPHEADER => array(
				    "accept: application/vnd.onem2m-res+json;",
				    "authorization: Basic QzczNzczOTYwLWI5ZGZmMDlhOlRlc3RAMTIz",
				    "cache-control: no-cache",
				    "content-type: application/vnd.onem2m-res+json;ty=4;",
				    "postman-token: 7e0070e9-dcd2-3d18-a3a6-f8882c696edc",
				    "x-m2m-origin: C73773960-b9dff09a",
				    "x-m2m-ri: 9900001"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);


				if ($err)
				{

				  #echo "cURL Error #:" . $err;
				  $submit_error = "Unable to Recharge. Please Try again later";
				  $submit_status = 0;
				}
		 }
		else
		{

			$submit_error = "Unable to Recharge. Please Try again later";
			$submit_status = 0;


		}


	 }


		return $submit_error;
	}
	else
	{
		$LOGIN = 0;
		echo "[{Login_Successfull: '$LOGIN'}]";
	}

}
ob_end_flush();

?>
