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
					
					$cookie_name = $_COOKIE['LOGIN_USERNAME'];
					$query = "SELECT NAME, RETAILER_ID FROM RETAILER WHERE LOGIN_USERNAME = '$cookie_name'";
					$result = mysqli_query($con,$query);
					$retrieve_result = mysqli_fetch_assoc($result);
					{ 
						
						
						$NAME = $retrieve_result["NAME"];
						$RETAILER_ID = $retrieve_result['RETAILER_ID'];
						$low_name = strtolower($NAME);
						$target_dir = "uploads/$username/profilepictures/";
						
					}
					
			$submit_error = "";
	
	if(isset($_POST['SUBMIT']))
	{
		$NAME =mysqli_real_escape_string($con,$_POST['NAME']);
		$DATE_OF_BIRTH=mysqli_real_escape_string($con,$_POST['DATE_OF_BIRTH']);
		$PHONE_NUMBER = mysqli_real_escape_string($con,$_POST['PHONE_NUMBER']);
		$AADHAAR_NUMBER = mysqli_real_escape_string($con,$_POST['AADHAAR_NUMBER']);
		$CITY = mysqli_real_escape_string($con,$_POST['CITY']);
		$STATE = mysqli_real_escape_string($con,$_POST['STATE']);
		$COMPLETE_ADDRESS = mysqli_real_escape_string($con,$_POST['COMPLETE_ADDRESS']);
		$PIN = mysqli_real_escape_string($con,$_POST['PIN']);
		
		
		
		
				
			if (customer_exists($NAME,$DATE_OF_BIRTH,$PHONE_NUMBER,$con))
			{
				$submit_error = "The Customer is already Registered";
			}
			else if(strlen($PHONE_NUMBER)!=10)
			{
				$submit_error = "Phone Number is not valid. Phone Number should have 10 digits";
			}
			else if(strlen($PIN)!=6)
			{
				$submit_error = "PIN Number is not valid";	
			}
			else if(strlen($AADHAAR_NUMBER)!=12)
			{
				$submit_error = "AADHAAR Number is not valid";	
			}
			else
			{
				$insert_query="INSERT INTO CONSUMER(NAME,DATE_OF_BIRTH,PHONE_NUMBER,AADHAAR_NUMBER,CITY,STATE,COMPLETE_ADDRESS,PIN) VALUES('$NAME','$DATE_OF_BIRTH','$PHONE_NUMBER','$AADHAAR_NUMBER','$CITY','$STATE','$COMPLETE_ADDRESS','PIN')";
				
				if(mysqli_query($con,$insertQuery1));
					{
						clearstatcache();
						$submit_error = "Customer is succesfully registered";
						
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
	var name = "&nbsp;<?php echo "$NAME ";?> ";
	
		
</script>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title> Prajjwala </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="sidebar-template.js" type="text/javascript" language="javascript"></script>
    <script src="top_nav_template.js" type="text/javascript" language="javascript"></script>
  

    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body" style=" background-color:#066" >
      <div class="main_container"  style=" background-color:#066">
		<script type="text/javascript">
			createtemplate();
			top_nav_template();
			</script>

        
        <!-- page content -->
        <div class="right_col" role="main">
        
        <div class="container" style="margin-top:170px;">
        	
        
      <form id="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="NAME" id="name" required class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="DATE_OF_BIRTH" class="date-picker form-control col-md-7 col-xs-12" placeholder="dd/mm/YYYY" required type="date">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="phone_number" name="PHONE_NUMBER" class="form-control col-md-7 col-xs-12" type="number" required name="phone_number">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Aadhaar Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="aadhaar_number" name="AADHAAR_NUMBER" class="form-control col-md-7 col-xs-12" type="text" required name="aadhaar_number">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="address" name="COMPLETE_ADDRESS" class="form-control col-md-7 col-xs-12" type="text" style="height:70px" required name="address">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="city" name="CITY" class="form-control col-md-7 col-xs-12" type="text" required name="city">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="state" name="STATE" class="form-control">
<option value="">------------Select State------------</option>
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
                          <input id="pin" name="PIN" class="form-control col-md-7 col-xs-12" type="number"  required name="pin">
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
	

	-->
  </script>
  
</html>
