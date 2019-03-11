<?php
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

	function gen_randomPassword()
  {
      $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $pass = array(); //remember to declare $pass as an array
      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
      for ($i = 0; $i < 8; $i++) {
          $n = rand(0, $alphaLength);
          $pass[] = $alphabet[$n];
      }
      return implode($pass); //turn the array into a string
  }


	$Submitted_Username = $_REQUEST['Username'];
	$Submitted_Password = $_REQUEST["Password"];

	if(login_details($Submitted_Username, $Submitted_Password, $con) == true)
	{
		$query = mysqli_query($con, "SELECT RETAILER_ID FROM RETAILER WHERE LOGIN_USERNAME = '$Submitted_Username'");
		$row = mysqli_fetch_assoc($query);
		$RETAILER_ID = $row['RETAILER_ID'];
		//echo "logged_in";

		$SUBMITTED_CONSUMER_NAME = mysqli_real_escape_string($con,$_REQUEST['SUBMIT_CONSUMER_NAME']);
		$SUBMITTED_CONSUMER_EMAIL = mysqli_real_escape_string($con,$_REQUEST['SUBMIT_CONSUMER_EMAIL']);
		$SUBMITTED_DATE_OF_BIRTH=mysqli_real_escape_string($con,$_REQUEST['SUBMIT_DATE_OF_BIRTH']);
		$SUBMITTED_PHONE_NUMBER = mysqli_real_escape_string($con,$_REQUEST['SUBMIT_PHONE_NUMBER']);
		$SUBMITTED_CONSUMER_AADHAAR_NUMBER = mysqli_real_escape_string($con,$_REQUEST['SUBMIT_CONSUMER_AADHAAR_NUMBER']);
		$SUBMITTED_CITY = mysqli_real_escape_string($con,$_REQUEST['SUBMIT_CITY']);
		$SUBMITTED_STATE = mysqli_real_escape_string($con,$_REQUEST['SUBMIT_STATE']);
		$SUBMITTED_COMPLETE_ADDRESS = mysqli_real_escape_string($con,$_REQUEST['SUBMIT_COMPLETE_ADDRESS']);
		$SUBMITTED_PIN = mysqli_real_escape_string($con,$_REQUEST['SUBMIT_PIN']);



			if(consumer_exists($SUBMITTED_PHONE_NUMBER,$SUBMITTED_CONSUMER_AADHAAR_NUMBER,$con))
			{
				$submit_error = "ERROR: The Customer is already Registered";
				$submit_status = 0;
				//echo "<script type='text/javascript'>alert('$submit_error');</script>";
				echo $submit_error;

			}
			else if(empty($SUBMITTED_CONSUMER_EMAIL))
			{
			 $submit_error = "Email Id is Required";
			 $submit_status = 0;
			 echo $submit_error;
			}
			else if(!filter_var($SUBMITTED_CONSUMER_EMAIL,FILTER_VALIDATE_EMAIL))
			{
				$submit_error ="Invalid Email address. Please use Official prajjawala Email Id";
				$submit_status = 0;
				//echo "<script type='text/javascript'>alert('$submit_error');</script>";
				echo $submit_error;

			}
			else if(strlen($SUBMITTED_PHONE_NUMBER)!=10)
			{
				$submit_error = "ERROR: Phone Number is not valid. Phone Number should have 10 digits";
				$submit_status = 0;
				//echo "<script type='text/javascript'>alert('$submit_error');</script>";
				echo $submit_error;

			}
			else if(strlen($SUBMITTED_PIN)!=6)
			{
				$submit_error = "ERROR: PIN Number is not valid";
				$submit_status = 0;
				//echo "<script type='text/javascript'>alert('$submit_error');</script>";
				echo $submit_error;

			}
			else if(strlen($SUBMITTED_CONSUMER_AADHAAR_NUMBER)!=12)
			{
				$submit_error = "ERROR: AADHAAR Number is not valid";
				$submit_status = 0;
				echo $submit_error;
			}
			else
			{
				$pass  = gen_randomPassword();
				//echo $pass;
				$username = strtolower(explode(" ", $SUBMITTED_CONSUMER_NAME)[0]);
				//echo $username;
				$insert_query="INSERT INTO CONSUMER(NAME,CONSUMER_EMAIL,RETAILER_ID,DATE_OF_BIRTH,PHONE_NUMBER,AADHAAR_NUMBER,CITY,STATE,COMPLETE_ADDRESS,PIN,CONSUMER_LOGIN_USERNAME, PASSWORD) VALUES('$SUBMITTED_CONSUMER_NAME','$SUBMITTED_CONSUMER_EMAIL','$RETAILER_ID','$SUBMITTED_DATE_OF_BIRTH','$SUBMITTED_PHONE_NUMBER','$SUBMITTED_CONSUMER_AADHAAR_NUMBER','$SUBMITTED_CITY','$SUBMITTED_STATE','$SUBMITTED_COMPLETE_ADDRESS','$SUBMITTED_PIN', '$username', '$pass')";
				if(mysqli_query($con,$insert_query))
				{
					//clearstatcache();
					$submit_error = "Consumer is succesfully registered.";
					echo $submit_error;
					$submit_status = 1;
				}
				else
				{
					$submit_error = "ERROR: The Consumer was unable to register. Please contact the Support to know the problem". $Insert_status;
					//echo "<script type='text/javascript'>alert('$submit_error');</script>";
					echo $submit_error;
					$submit_status = 0;


				}

			}


	}
	else {
		$submit_error = "Unabe to Process. Please Try again.";
		//echo "<script type='text/javascript'>alert('$submit_error');</script>";
		echo $submit_error;
		$submit_status = 0;
	}

}
ob_end_flush();
?>
