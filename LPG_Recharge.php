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
{                 	clearstatcache();
					$login_error;
					$Insert_status = FALSE;
					$submit_status = -1;
					$cookie_name = $_COOKIE['LOGIN_USERNAME'];
					$query = "SELECT * FROM RETAILER WHERE LOGIN_USERNAME = '$cookie_name'";
					$result = mysqli_query($con,$query);
					$retrieve_result = (!$result || mysqli_num_rows($result) == 0)?header("Location:error.php"):mysqli_fetch_assoc($result);
					$RETAILER_NAME = $retrieve_result['NAME'];
					$RETAILER_ID = $retrieve_result['RETAILER_ID'];
					$RETAILER_AADHAAR_NUMBER = $retrieve_result['AADHAAR_NUMBER'];
					$RETAILER_PASSWORD = $retrieve_result['LOGIN_PASSWORD'];
					$LOGIN_USERNAME = $retrieve_result['LOGIN_USERNAME'];
					$low_name = strtolower($RETAILER_ID);
					$target_dir = "uploads/$username/profilepictures/";
					
					$submit_error = "";
					$profile_picture_location = profile_picture_location($LOGIN_USERNAME);
	
	if(isset($_POST['RECHARGE']))
	{
		$SUBMITTED_CONSUMER_ID =mysqli_real_escape_string($con,$_POST['CONSUMER_ID']);
		$SUBMITTED_CONSUMER_PHONE_NUMBER = mysqli_real_escape_string($con,$_POST['CONSUMER_PHONE_NUMBER']);
		$SUBMITTED_RECHARGE_AMOUNT = mysqli_real_escape_string($con,$_POST['RECHARGE_AMOUNT']);
		$SUBMITTED_RETAILER_AADHAAR_NUMBER = mysqli_real_escape_string($con,$_POST['SUBMIT_RETAILER_AADHAAR_NUMBER']);
		$SUBMITTED_RETAILER_PASSWORD = mysqli_real_escape_string($con,$_POST['SUBMIT_RETAILER_PASSWORD']);

		
				
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
					clearstatcache();
					$submit_error = "Recharged for Rs. ".$SUBMITTED_RECHARGE_AMOUNT;
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

if ($err) {
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
	
	var submit_status = "<?php echo "$submit_status";?>";
	var consumer_id = "<?php echo "$CONSUMER_ID";?>";
	var consumer_phone_number  = "<?php echo "$CONSUMER_PHONE_NUMBER";?>";
	var retailer_aadhaar_number = "<?php echo "$RETAILER_AADHAAR_NUMBER";?>";
	var address = "<?php echo "$COMPLETE_ADDRESS";?>";
	var city = "<?php echo "$CITY";?>";
	var state = "<?php echo "$STATE";?>"
	var pin = "<?php echo "$PIN";?>";
		
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
                	<h2>Recharge LPG Cylinder</h2>
                    <?php 
			
					echo "<font color=\"#996600\">$submit_error</font>";
				
					?>
        
                </div>
               <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 text-right">
                	Pay Using&nbsp;&nbsp;
                	<img src="assets/images/Paytm_logo.png" width="50px;" height="25px;" style="cursor:pointer">
                    </div>
            </div>
        </div>
        
        <div class="container" style="margin-top:30px;">
        	
        
      <form id="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" data-parsley-validate class="form-horizontal form-label-left">

                      
                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer Id <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="consumer_id" name="CONSUMER_ID" class="form-control col-md-7 col-xs-12" value=" " required type="number">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer's Registered Mobile Number<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="consumer_phone_number" name="CONSUMER_PHONE_NUMBER" class="form-control col-md-7 col-xs-12" type="number" required >
                        </div>
                      </div>
                      
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Recharge Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="RECHARGE_AMOUNT" id="recharge_amount" class="form-control" required>
<option value="" disabled selected>--- Recharge Options --- </option>
<option value="10">Rs. 10</option>
<option value="50">Rs. 50</option>
<option value="200">Rs. 200</option>
<option value="250">Rs. 250</option>
<option value="500">Rs. 500</option>
</select>
                        </div>
                      </div>
                      

                      
                      
                      
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Your Aadhaar Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="submit_retailer_aadhaar_number" name="SUBMIT_RETAILER_AADHAAR_NUMBER" class="form-control col-md-7 col-xs-12" type="number" required>
                        </div>
                      </div>
                      
                      
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="submit_retailer_password" name="SUBMIT_RETAILER_PASSWORD" class="form-control col-md-7 col-xs-12" type="password" required>
                        </div>
                      </div>
                      
                      <hr>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="recharge" name="RECHARGE" class="btn btn-success"> Recharge </button>
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
  
  	var active = document.getElementById("item_lpg_recharge");
	active.className += " active";
	if(submit_status == 0)
	{
		
		document.getElementById("customer_name").value = customer_name;
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
