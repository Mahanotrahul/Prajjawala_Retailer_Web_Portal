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
					$Insert_status = FALSE;
					$submit_status = -1;
					$cookie_name = $_COOKIE['LOGIN_USERNAME'];
					$query = "SELECT * FROM RETAILER WHERE binary LOGIN_USERNAME = '$cookie_name'";
					$result = mysqli_query($con,$query);
					$retrieve_result = (!$result || mysqli_num_rows($result) == 0)?header("Location:error.php"):mysqli_fetch_assoc($result);
					{ 
						
						
						$RETAILER_NAME = $retrieve_result["NAME"];
						$LOGIN_USERNAME = $retrieve_result['LOGIN_USERNAME'];
						
						$RETAILER_ID = $retrieve_result['RETAILER_ID'];
						$ORIGINAL_RETAILER_AADHAAR_NUMBER = $retrieve_result['AADHAAR_NUMBER'];
						$ORIGINAL_PASSWORD = $retrieve_result['LOGIN_PASSWORD'];
						$low_name = strtolower($RETAILER_NAME);
						$target_dir = "uploads/$username/profilepictures/";
						
					}
					
					
				$submit_error = "";
				$profile_picture_location = profile_picture_location($LOGIN_USERNAME);
	
	if(isset($_POST['SUBMIT']))
	{
		$CONSUMER_ID =mysqli_real_escape_string($con,$_POST['CONSUMER_ID']);
		$PHONE_NUMBER = mysqli_real_escape_string($con,$_POST['PHONE_NUMBER']);
		$TYPE_OF_COMPLAIN = mysqli_real_escape_string($con,$_POST['TYPE_OF_COMPLAIN']);
		$COMPLAINT_DESCRIPTION = mysqli_real_escape_string($con,$_POST['COMPLAINT_DESCRIPTION']);
		$RETAILER_AADHAAR_NUMBER = mysqli_real_escape_string($con,$_POST['RETAILER_AADHAAR_NUMBER']);
		$SUBMIT_PASSWORD = mysqli_real_escape_string($con,$_POST['SUBMIT_PASSWORD']);
		$date = date("Y-m-d");

		
			if(strlen($RETAILER_AADHAAR_NUMBER) != 12)
			{
				$submit_error = "Aadhaar Number is Incorrect!";
				$submit_status = 0;
			}
			else if(strlen($PHONE_NUMBER)!=10)
			{
				$submit_error = "Phone Number is not valid. Phone Number should have 10 digits";
				$submit_status = 0;
			}
			else if($ORIGINAL_RETAILER_AADHAAR_NUMBER != $RETAILER_AADHAAR_NUMBER)
			{
				$submit_error = "Aadhaar number not matchded. Try Again!";
				$submit_status = 0;
				
			}
			else if($ORIGINAL_PASSWORD != $SUBMIT_PASSWORD)
			{
				$submit_error = "Incorrect Password";
				$submit_status = 0;
			}
			
			else if(!consumer_verify_complaint($CONSUMER_ID,$PHONE_NUMBER,$RETAILER_ID,$con))
			{
				$submit_error = "Consumer details are wrong.";
				$submit_status = 0;
			}
			else
			{
				$insert_query="INSERT INTO CONSUMER_COMPLAINS(CONSUMER_ID,DATE_REGISTERED,TYPE_OF_COMPLAIN,COMPLAINT) VALUES('$CONSUMER_ID','$date','$TYPE_OF_COMPLAIN','$COMPLAINT_DESCRIPTION')";
				
			
				if(mysqli_query($con,$insert_query))
					{
						clearstatcache();
						$submit_error = "Complaint is succesfully registered.";
						$submit_status = 1;
							//from:
							$from = "admin@vasitars.com";
							//header
							$headers = "From:".$from;
							
							//subject
							$subject_mail = "LPG Complain".$CONSUMER_ID;
							
							// the message
							$msg = $COMPLAINT_DESCRIPTION;
							
							// use wordwrap() if lines are longer than 70 characters
							$msg = wordwrap($msg,70);
							
							// send email
							mail("rahul_mahanot@vasitars.com",$subject_mail,$msg,$headers);
							
												}
				else
				{
					$submit_error = "The Complaint was unable to register. Please contact the Support to know the problem";
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
	var name = "<?php echo "$RETAILER_NAME";?>";
	
	var submit_status = "<?php echo "$submit_status";?>";
	var customer_id = "<?php echo "$CUSTOMER_ID";?>";
	var phone_number = "<?php echo "$PHONE_NUMBER";?>";
	var complaint_description = "<?php echo "$COMPLAINT_DESCRIPTION"?>";
	var type_of_complain = "<?php echo "$TYPE_OF_COMPLAIN";?>";
	var retailer_aadhaar_number = "<?php echo "$RETAILER_AADHAAR_NUMBER";?>";
		
	</script>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo $logo_location;?>" type="image/ico" />

    <title> Prajjawala </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--Style-->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet">
    
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	

    
    
    
    
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
                	<h2><b>Register Complaint</b></h2>
                    <?php 
			
					echo "<font color=\"#996600\">$submit_error</font>";
				
					?>
        
                </div>
            </div>
        </div>
        
        <div class="container" style="margin-top:30px;">
        	
        
      <form id="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer Id <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="CONSUMER_ID" id="consumer_id" required class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer's Mobile Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="phone_number" name="PHONE_NUMBER" class="date-picker form-control col-md-7 col-xs-12" required type="number">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type of Complain <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="TYPE_OF_COMPLAIN" id="type_of_complain" class="form-control" required>
<option value="" disabled selected>--- Type of Complain --- </option>
<option value="TECHNICAL_MALFUNCTION">Technical Malfunction</option>
<option value="MECHANICAL_MALFUNCTION">Mechanical Malfunction</option>
</select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span><br><code>in less than 100 words</code>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="complaint" name="COMPLAINT_DESCRIPTION" class="form-control col-md-7 col-xs-12" type="text" maxlength="100" style="height:70px;" required>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Retailer Aadhaar Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="retailer_aadhaar_number" name="RETAILER_AADHAAR_NUMBER" class="form-control col-md-7 col-xs-12" type="number" required>
                        </div>
                      </div>
                      
                      
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="submit_password" name="SUBMIT_PASSWORD" class="form-control col-md-7 col-xs-12" type="password" required>
                        </div>
                      </div>
                    
                      
                      <hr>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary" type="reset" id="reset">Reset</button>
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
	  
  	document.getElementById("item_report_problem").className = "active";

	if(submit_status == 0)
	{
		document.getElementById("consumer_id").value = customer_id;
		document.getElementById("phone_number").value = phone_number;
		document.getElementById("type_of_complain").value = type_of_complain;
		document.getElementById("complaint_description").value = complaint_descrption;
		document.getElementById("retailer_aadhaar_number").value = retailer_aadhaar_number;
	}
	

	-->
  </script>
  
</html>
