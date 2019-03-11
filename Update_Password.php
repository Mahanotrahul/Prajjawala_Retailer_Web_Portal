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
					$query = "SELECT * FROM RETAILER WHERE LOGIN_USERNAME = '$cookie_name'";
					$result = mysqli_query($con,$query);
					$retrieve_result = (!$result || mysqli_num_rows($result) == 0)?header("Location:error.php"):mysqli_fetch_assoc($result);
					{ 
						
						$RETAILER_ID = $retrieve_result['RETAILER_ID'];
						$RETAILER_NAME = $retrieve_result["NAME"];
						$LOGIN_USERNAME = $retrieve_result['LOGIN_USERNAME'];
						$RETAILER_LOGIN_PASSWORD = $retrieve_result['LOGIN_PASSWORD'];
						$low_name = strtolower($RETAILER_NAME);
						$target_dir = "uploads/$username/profilepictures/";
						
					}
					$submit_error = "";
					$profile_picture_location = profile_picture_location($LOGIN_USERNAME);
					
	if(isset($_POST['SUBMIT']))
	{
		$SUBMITTED_ORIGINAL_LOGIN_PASSWORD =mysqli_real_escape_string($con,$_POST['SUBMITTED_ORIGINAL_LOGIN_PASSWORD']);
		$SUBMITTED_NEW_LOGIN_PASSWORD =mysqli_real_escape_string($con,$_POST['SUBMITTED_NEW_LOGIN_PASSWORD']);
		$SUBMITTED_CONFIRM_LOGIN_PASSWORD =mysqli_real_escape_string($con,$_POST['SUBMITTED_CONFIRM_LOGIN_PASSWORD']);
		
		
		$date = date("Y-m-d");

		
			if($SUBMITTED_ORIGINAL_LOGIN_PASSWORD != $RETAILER_LOGIN_PASSWORD)
			{
				$submit_error = "Current Password is not correct";
				$submit_status = 0;
			}
			else if($SUBMITTED_NEW_LOGIN_PASSWORD != $SUBMITTED_CONFIRM_LOGIN_PASSWORD)
			{
				$submit_error = "New and Confirm Passwords donot match";
				$submit_status = 0;
			}
			else if(strlen($SUBMITTED_NEW_LOGIN_PASSWORD) < 7)
			{
				$submit_error = "Password is too weak. Use a different and strong Password";
				$submit_status = 0;
			}
			else
			{
				$insert_query="UPDATE RETAILER SET LOGIN_PASSWORD = '$SUBMITTED_NEW_LOGIN_PASSWORD' WHERE RETAILER_ID = '$RETAILER_ID'";
				
			
				if(mysqli_query($con,$insert_query))
					{
						clearstatcache();
						$submit_error = "Password Updated successfully";
						$submit_status=1;
												}
				else
				{
					$submit_error = "Unable to update Password. Contact Support or check your Internet Connection!";
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
	var name = "&nbsp;<?php echo "$RETAILER_NAME";?>";
		
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
    <!-- bootstrap-progressbar -->
    <link href="assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    
	
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
      </div>

        
<!-- page content -->
        <div class="right_col" role="main">
          <div class="container" style="margin-top:50px;">
        	<div class="row" style="margin-top:50px;">
            	
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 text-center">
                	<h2>Update Profile</h2><small> Retailer Id: </small> <code><font color="#FF0000" size="+1" style="letter-spacing:1px;"><?php echo $RETAILER_ID;?></code></font>
                    <br>
                                         <?php 
			
					echo "<font color=\"#996600\">$submit_error</font>";
				
					?>
        
                </div>
            </div>
        </div>
        
        <div class="container" style="margin-top:30px;">
        	
        
      <form id="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" data-parsley-validate class="form-horizontal form-label-left">

                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Current Login Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="orginal_login_password" name="SUBMITTED_ORIGINAL_LOGIN_PASSWORD" class="form-control col-md-7 col-xs-12" type="password" required>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> New Login Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                          <input id="new_login_password" name="SUBMITTED_NEW_LOGIN_PASSWORD" value="" class="form-control col-md-7 col-xs-12" type="text" required>
                          
                            <div id="new_login_password_details"></div>
                            <div class="progress" id="new_password_progress" style="width:100%; margin-bottom:0px; margin-top:40px;">
                        		<span class="progress-bar progress-bar-striped" role="progressbar" id="password_progress_bar"></span>
                         	</div>
                              
                        </div>
                      </div>
                      
                        
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Confirm Login Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="confirm_login_password" name="SUBMITTED_CONFIRM_LOGIN_PASSWORD" class="form-control col-md-7 col-xs-12" type="text" required>
                         <div id="confirm_login_password_progress" class="input_details"></div>
                         </div>
                      </div>
                      
                      <hr>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary" type="reset" onClick="reset_all();">Reset</button>
                          
                          <button type="button" id="submit" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg"> Change Password</button>

                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Update Pasword</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure, You want to change your Password</p>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-dark" data-dismiss="modal">Close</button>
                          <button type="submit" name="SUBMIT" class="btn btn-success" id="submit" style="margin-top:10px;">Change Password</button>
                        </div>

                      </div>
                    </div>
                  </div>

                          
                        </div>
                      </div>

                    </form>
                    
             </div>
        </div>
        <!-- /page content -->

        
         <!-- footer content -->
        <footer>
          
          
        </footer>
        <!-- /footer content -->
        
    

    <!-- jQuery -->
    <script src="assets/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="assets/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.min.js"></script>
	
  </body>
  <script>
  <!-- 
  function reset_all()
  {
	  document.getElementById("new_password_progress").style.display = "none";
	  document.getElementById("new_login_password_details").style.display = "none";
  }
  var password_progress = document.getElementById("new_login_password").value;
  var allow_submit = -1;
  var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
  document.getElementById("new_password_progress").style.display = "none";
	$('#new_login_password').keyup(function() {
		var value = $(this).val();
		var special_char = format.test(value)?1:0;
		var confirm_password_value = $('#confirm_login_password').val();
		var password_progress_bar_width = ((((100/16)*(value.length)))<100)?((100*(value.length))/16):100;
		document.getElementById("password_progress_bar").style.width = password_progress_bar_width + "%";
		if(value.length == 0)
		{
			document.getElementById("submit").disabled = true;
			document.getElementById("new_password_progress").style.display = "none";
			allow_submit = 0;
			document.getElementById("new_login_password_details").style.display = "none";
		}
		else if((value.length < 5)&& (value.length > 0))
		{
			document.getElementById("submit").disabled = true;
			document.getElementById("new_password_progress").style.display = "none";
			allow_submit = 0;
			document.getElementById("new_login_password_details").style.display = "block";
			document.getElementById("new_login_password_details").innerHTML = "Password should contain atleast 7 characters and 1 special character";
			
		}
		else if((value.length < 7)&&(value.length > 4))
		{
			document.getElementById("submit").disabled = true;
			document.getElementById("new_password_progress").style.display = "block";
			document.getElementById("password_progress_bar").innerHTML = "Too weak";
			allow_submit = 0;
			document.getElementById("new_login_password_details").innerHTML = " ";
		}
		else if((value.length > 6)&&(value.length < 10))
		{
			document.getElementById("new_login_password_details").innerHTML = " ";
			if(special_char != 1)
			{
				document.getElementById("password_progress_bar").innerHTML = "Still not strong!";
				allow_submit = 0;
				document.getElementById("submit").disabled = true;		
			}
			else
			{
				document.getElementById("password_progress_bar").innerHTML = "Strong!";
				allow_submit = 1;
				if((value == confirm_password_value) && (allow_submit == 1))
				{
					document.getElementById("submit").disabled = false;
				}
				else
				{
					document.getElementById("submit").disabled = true;
				}
			}
		}
		
		else if((value.length > 9) && (value.length <13))
		{
			document.getElementById("new_login_password_details").innerHTML = " ";
			if(special_char != 1)
			{
				document.getElementById("password_progress_bar").innerHTML = "A Special Character needed";
				document.getElementById("submit").disabled = true;
				allow_submit = 0;
			}
			else
			{
				document.getElementById("password_progress_bar").innerHTML = "Strong!";
				allow_submit = 1;
				if((value == confirm_password_value) && (allow_submit == 1))
				{
					document.getElementById("submit").disabled = false;
				}
				else
				{
					document.getElementById("submit").disabled = true;
				}
			}		
		}
		else
		{
			document.getElementById("new_login_password_details").innerHTML = " ";
			if(special_char != 1)
			{
				document.getElementById("password_progress_bar").innerHTML = "A Special Character needed";
				document.getElementById("submit").disabled = true;
				allow_submit = 0;
			}
			else
			{
				document.getElementById("password_progress_bar").innerHTML = "Very Strong!";
				allow_submit = 1;
				if((value == confirm_password_value) && (allow_submit == 1))
				{
					document.getElementById("submit").disabled = false;
				}
				else
				{
					document.getElementById("submit").disabled = true;
				}
			}		
		}
		if(value.length >5)
		{
			document.getElementById("new_password_progress").style.display = " ";
		}
		
	});
	
	

	$('#confirm_login_password').keyup(function() {
		document.getElementById("new_login_password_details").innerHTML = " ";
		if((allow_submit == 1)|| (allow_submit == -1))
		{
			document.getElementById("new_password_progress").style.display = "none";
		}
		else if(allow_submit == 0)
		{
			document.getElementById("new_password_progress").style.display = "block";
		}
		var value = $(this).val();
		var new_password_value = $('#new_login_password').val();
		if((value == new_password_value)&&(allow_submit == 1))
		{
			document.getElementById("submit").disabled = false;
		}
		else
		{
			document.getElementById("submit").disabled = true;
		}
		
	});

	-->
  </script>
</html>
