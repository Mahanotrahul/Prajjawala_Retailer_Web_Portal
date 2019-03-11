<?php
ob_start();

include("connect.php");

include("function.php");

if(logged_in()==false)
{
	header("Location:login.php");
	exit();
}
else
{

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

					clearstatcache();
					$Insert_status = FALSE;
					$submit_status = -1;
					$cookie_name = $_COOKIE['LOGIN_USERNAME'];
					$query = "SELECT * FROM RETAILER WHERE binary LOGIN_USERNAME = '$cookie_name'";
					$result = mysqli_query($con,$query);
					$retrieve_result = (!$result || mysqli_num_rows($result) == 0)?header("Location:error.php"):mysqli_fetch_assoc($result);
					$RETAILER_NAME = $retrieve_result['NAME'];
					$RETAILER_ID = $retrieve_result['RETAILER_ID'];
					$LOGIN_USERNAME = $retrieve_result['LOGIN_USERNAME'];
					$low_name = strtolower($RETAILER_ID);
					$target_dir = "uploads/$username/profilepictures/";

					$submit_error = "";
					$profile_picture_location = profile_picture_location($LOGIN_USERNAME);

	if(isset($_POST['SUBMIT']))
	{
		$SUBMITTED_CONSUMER_NAME = mysqli_real_escape_string($con,$_POST['SUBMIT_CONSUMER_NAME']);
		$SUBMITTED_CONSUMER_EMAIL = mysqli_real_escape_string($con,$_POST['SUBMIT_CONSUMER_EMAIL']);
		$SUBMITTED_DATE_OF_BIRTH=mysqli_real_escape_string($con,$_POST['SUBMIT_DATE_OF_BIRTH']);
		$SUBMITTED_PHONE_NUMBER = mysqli_real_escape_string($con,$_POST['SUBMIT_PHONE_NUMBER']);
		$SUBMITTED_CONSUMER_AADHAAR_NUMBER = mysqli_real_escape_string($con,$_POST['SUBMIT_CONSUMER_AADHAAR_NUMBER']);
		$SUBMITTED_CITY = mysqli_real_escape_string($con,$_POST['SUBMIT_CITY']);
		$SUBMITTED_STATE = mysqli_real_escape_string($con,$_POST['SUBMIT_STATE']);
		$SUBMITTED_COMPLETE_ADDRESS = mysqli_real_escape_string($con,$_POST['SUBMIT_COMPLETE_ADDRESS']);
		$SUBMITTED_PIN = mysqli_real_escape_string($con,$_POST['SUBMIT_PIN']);



			if (consumer_exists($SUBMITTED_PHONE_NUMBER,$SUBMITTED_CONSUMER_AADHAAR_NUMBER,$con))
			{
				$submit_error = "ERROR: The Customer is already Registered";
				$submit_status = 0;
				echo "<script type='text/javascript'>alert('$submit_error');</script>";

			}
			else if(empty($SUBMITTED_CONSUMER_EMAIL))
			{
			 $submit_error = "Email Id is Required";
			 $submit_status = 0;
			}
			else if(!filter_var($SUBMITTED_CONSUMER_EMAIL,FILTER_VALIDATE_EMAIL))
			{
				$submit_error ="Invalid Email address. Please use Official prajjawala Email Id";
				$submit_status = 0;
				echo "<script type='text/javascript'>alert('$submit_error');</script>";

			}
			else if(strlen($SUBMITTED_PHONE_NUMBER)!=10)
			{
				$submit_error = "ERROR: Phone Number is not valid. Phone Number should have 10 digits";
				$submit_status = 0;
				echo "<script type='text/javascript'>alert('$submit_error');</script>";

			}
			else if(strlen($SUBMITTED_PIN)!=6)
			{
				$submit_error = "ERROR: PIN Number is not valid";
				$submit_status = 0;
				echo "<script type='text/javascript'>alert('$submit_error');</script>";

			}
			else if(strlen($SUBMITTED_CONSUMER_AADHAAR_NUMBER)!=12)
			{
				$submit_error = "ERROR: AADHAAR Number is not valid";
				$submit_status = 0;
				echo "<script type='text/javascript'>alert('$submit_error');</script>";

			}
			else if($SUBMITTED_STATE=="NOT_SELECTED")
			{
				$submit_error = "ERROR: STATE is not selected";
				$submit_status = 0;
				echo "<script type='text/javascript'>alert('$submit_error');</script>";

			}
			else
			{
				$pass  = gen_randomPassword();
				$username = strtolower(explode(" ", $SUBMITTED_CONSUMER_NAME)[0]);
				$insert_query="INSERT INTO CONSUMER(NAME,CONSUMER_EMAIL,RETAILER_ID,DATE_OF_BIRTH,PHONE_NUMBER,AADHAAR_NUMBER,CITY,STATE,COMPLETE_ADDRESS,PIN,CONSUMER_LOGIN_USERNAME, PASSWORD) VALUES('$SUBMITTED_CONSUMER_NAME','$SUBMITTED_CONSUMER_EMAIL','$RETAILER_ID','$SUBMITTED_DATE_OF_BIRTH','$SUBMITTED_PHONE_NUMBER','$SUBMITTED_CONSUMER_AADHAAR_NUMBER','$SUBMITTED_CITY','$SUBMITTED_STATE','$SUBMITTED_COMPLETE_ADDRESS','$SUBMITTED_PIN', '$username', '$pass')";


				if(mysqli_query($con,$insert_query))
				{
					clearstatcache();
					$submit_error = "Consumer is succesfully registered.";
					echo "<script type='text/javascript'>alert('$submit_error');</script>";
					$submit_status = 1;
				}
				else
				{
					$submit_error = "ERROR: The Customer was unable to register. Please contact the Support to know the problem". $Insert_status;
					echo "<script type='text/javascript'>alert('$submit_error');</script>";
					$submit_status = 0;


				}

			}


	}

}
ob_end_flush();
?>
<!--
//
//
//$dir = "/uploads/$username/profilepictures/";
//$pic_number = 1;		//number of profile pictures that already exist
//// Open a directory, and read its contents
//if (is_dir($dir)){
//  if ($dh = opendir($dir)){
//    while (($file = readdir($dh)) !== false){
//
//			$pic_number += 1;
//
//    }
//    closedir($dh);
//  }
//}
//$firstname1 = strtolower("$firstname");
//$file_dir = "uploads/$username/profilepictures/$firstname1.profilepic";
//					$imagefiletype = "jpg"; //pathinfo($file_dir.$pic_number,PATHINFO_EXTENSION);
//-->

<script>

	var retailer_name = "<?php echo "$RETAILER_NAME";?>";


	var submit_status = <?php echo $submit_status;?>;
	var consumer_name = "<?php echo "$SUBMITTED_CONSUMER_NAME";?>";
	var date_of_birth = "<?php echo "$SUBMITTED_DATE_OF_BIRTH";?>";
	var phone_number = "<?php echo "$SUBMITTED_PHONE_NUMBER";?>";
	var aadhaar_number = "<?php echo "$SUBMITTED_CONSUMER_AADHAAR_NUMBER";?>";
	var address = "<?php echo "$SUBMITTED_COMPLETE_ADDRESS";?>";
	var city = "<?php echo "$SUBMITTED_CITY";?>";
	var state = "<?php echo "$SUBMITTED_STATE";?>"
	var pin = "<?php echo "$SUBMITTED_PIN";?>";

</script>



<!DOCTYPE html>
<html lang="en">
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

	<link rel="icon" href="<?php echo $logo_location;?>" type="image/ico" />

    <title> Prajjawala </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--Style-->
    <link rel="stylesheet" href="assets/css/style.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet">

  </head>

  <body class="nav-md">
    <div class="container body" style=" background-color:#066" >
      <div class="main_container"  style=" background-color:#066">

        <?php
		include("side_nav-template.php");
		include("top_nav-template.php");
		?>

        <!-- page content -->
        <div class="right_col" role="main">

        <div class="container" style="margin-top:50px;">
        	<div class="row" style="margin-top:50px;">

                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 text-center">
                	<h2>Register a New Customer</h2>

                </div>
            </div>
        </div>

        <div class="container" style="margin-top:30px;">


      <form id="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="SUBMIT_CONSUMER_NAME" value=" " id="consumer_name" required class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

											<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="SUBMIT_CONSUMER_EMAIL" value=" " id="consumer_email" required class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="date_of_birth" name="SUBMIT_DATE_OF_BIRTH" class="date-picker form-control col-md-7 col-xs-12" placeholder="dd/mm/YYYY" required type="date">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="phone_number" name="SUBMIT_PHONE_NUMBER" class="form-control col-md-7 col-xs-12" type="number" required name="phone_number">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Aadhaar Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="aadhaar_number" name="SUBMIT_CONSUMER_AADHAAR_NUMBER" class="form-control col-md-7 col-xs-12" type="text" required name="aadhaar_number">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="address" name="SUBMIT_COMPLETE_ADDRESS" class="form-control col-md-7 col-xs-12" type="text" style="height:70px;" required name="address">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="city" name="SUBMIT_CITY" class="form-control col-md-7 col-xs-12" type="text" required name="city">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="SUBMIT_STATE" id="state" class="form-control" required>
<option value="" disabled selected>----Select State----</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Orissa">Orissa</option>
<option value="Pondicherry">Pondicherry</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Tripura">Tripura</option>
<option value="Uttaranchal">Uttaranchal</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="West Bengal">West Bengal</option>
</select>
                        </div>
                      </div>



                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">PIN <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pin" name="SUBMIT_PIN" class="form-control col-md-7 col-xs-12" type="number"  required name="pin">
                        </div>
                      </div>

                      <hr>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" name="SUBMIT" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>

             </div>
        </div>

         <!-- footer content -->
        <footer>


        </footer>
        <!-- /footer content -->


    <!-- jQuery -->
    <script src="assets/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.min.js"></script>

  </body>

  <script>
  <!--

  	var active = document.getElementById("item_new_customer");
	active.className += " active";
	document.getElementById("consumer_name").value = retailer_name;
	if(submit_status == 0)
	{

		document.getElementById("consumer_name").value = consumer_name;
		document.getElementById("date_of_birth").value = date_of_birth;
		document.getElementById("phone_number").value = phone_number;
		document.getElementById("aadhaar_number").value = aadhaar_number;
		document.getElementById("address").value = address;
		document.getElementById("city").value = city;
		document.getElementById("state").value = state;
		document.getElementById("pin").value = pin;
	}


	-->
  </script>

</html>
