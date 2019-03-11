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
					$query = "SELECT * FROM RETAILER WHERE binary LOGIN_USERNAME = '$cookie_name'";
					$result = mysqli_query($con,$query);
					$retrieve_result = (!$result || mysqli_num_rows($result) == 0)?header("Location:error.php"):mysqli_fetch_assoc($result);
					{

						$RETAILER_ID = $retrieve_result['RETAILER_ID'];
						$RETAILER_NAME = $retrieve_result["NAME"];
						$RETAILER_DATE_OF_BIRTH = $retrieve_result['DATE_OF_BIRTH'];
						$RETAILER_PHONE_NUMBER = $retrieve_result['PHONE_NUMBER'];
						$RETAILER_SHOP_ADDRESS = $retrieve_result['SHOP_ADDRESS'];
						$RETAILER_AADHAAR_NUMBER = $retrieve_result['AADHAAR_NUMBER'];
						$RETAILER_CITY = $retrieve_result['CITY'];
						$RETAILER_STATE = $retrieve_result['STATE'];
						$RETAILER_LICENSE_NUMBER = $retrieve_result['LICENSE_NUMBER'];
						$LOGIN_USERNAME = $retrieve_result['LOGIN_USERNAME'];
						$low_name = strtolower($RETAILER_NAME);
						$target_dir = "uploads/$username/profilepictures/";

					}
					$submit_error = "";
					$profile_picture_location = profile_picture_location($LOGIN_USERNAME);


	if(isset($_POST['UPDATE_PROFILE_PICTURE']))
	 {
			$target_dir = "profile/$LOGIN_USERNAME/";
			$file_name = $target_dir.strtolower($_FILES["SUBMITTED_PROFILE_PICTURE"]["name"]);
			$uploadOk = 1;
			$imagefiletype = pathinfo($file_name,PATHINFO_EXTENSION);
			$newfile_name = $target_dir.strtolower("profile_picture.$imagefiletype");


				if((filesize($_FILES["SUBMITTED_PROFILE_PICTURE"]["tmp_name"])/1024) > 1024)
				{
					$submit_error = "File is too big. Cannot be uploaded";
					echo filesize($_FILES["SUBMITTED_PROFILE_PICTURE"]["tmp_name"])/1024;
				}
				else
				{
					unlink($profile_picture_location);
					if(move_uploaded_file($_FILES["SUBMITTED_PROFILE_PICTURE"]["tmp_name"], $file_name))
					{
						$submit_error = "Profile Picture Updated successfully";
						$profile_picture_location = profile_picture_location($LOGIN_USERNAME);
					}
				}
	 }

	if(isset($_POST['SUBMIT']))
	{
		$SUBMITTED_RETAILER_NAME =check_input(mysqli_real_escape_string($con,$_POST['SUBMITTED_RETAILER_NAME']),$RETAILER_NAME);
		$SUBMITTED_DATE_OF_BIRTH = check_input(mysqli_real_escape_string($con,$_POST['SUBMITTED_DATE_OF_BIRTH']),$RETAILER_DATE_OF_BIRTH);
		$SUBMITTED_PHONE_NUMBER = check_input(mysqli_real_escape_string($con,$_POST['SUBMITTED_PHONE_NUMBER']),$RETAILER_PHONE_NUMBER);
		$SUBMITTED_SHOP_ADDRESS = check_input(mysqli_real_escape_string($con,$_POST['SUBMITTED_SHOP_ADDRESS']),$RETAILER_SHOP_ADDRESS);
		$SUBMITTED_CITY = check_input(mysqli_real_escape_string($con,$_POST['SUBMITTED_CITY']),$RETAILER_CITY);
		$SUBMITTED_STATE = check_input(mysqli_real_escape_string($con,$_POST['SUBMITTED_STATE']),$RETAILER_STATE);
		$SUBMITTED_LOGIN_USERNAME = check_input(mysqli_real_escape_string($con,$_POST['SUBMITTED_LOGIN_USERNAME']),$LOGIN_USERNAME);
		$date = date("Y-m-d");


			if((strlen($SUBMITTED_PHONE_NUMBER) != 0)&& strlen($SUBMITTED_PHONE_NUMBER) !=10)
			{
				$submit_error = "Phone Number is wrong!";
			}
			else
			{
				$insert_query="UPDATE RETAILER SET NAME = '$SUBMITTED_RETAILER_NAME',DATE_OF_BIRTH = '$SUBMITTED_DATE_OF_BIRTH',PHONE_NUMBER = '$SUBMITTED_PHONE_NUMBER' ,CITY = '$SUBMITTED_CITY',STATE = '$SUBMITTED_STATE',SHOP_ADDRESS = '$SUBMITTED_SHOP_ADDRESS',LOGIN_USERNAME = '$SUBMITTED_LOGIN_USERNAME' WHERE RETAILER_ID = '$RETAILER_ID'";


				if(mysqli_query($con,$insert_query))
					{
						clearstatcache();
						$submit_error = "Profile Details are successfully updated";
						$submit_status=1;
						$_SESSION['LOGIN_USERNAME']=$SUBMITTED_LOGIN_USERNAME;
						setcookie("LOGIN_USERNAME",$SUBMITTED_LOGIN_USERNAME,time()+3600,"/","");
						$_SESSION["LOGIN_SESSION"] = md5($SUBMITTED_LOGIN_USERNAME);
						rename("profile/$LOGIN_USERNAME","profile/$SUBMITTED_LOGIN_USERNAME");
						rename("profile/$SUBMITTED_LOGIN_USERNAME/$LOGIN_USERNAME.txt","profile/$SUBMITTED_LOGIN_USERNAME/$SUBMITTED_LOGIN_USERNAME.txt");
						header("Location:".$_SERVER['PHP_SELF']);
					}
				else
				{
					$submit_error = "Unable to update Profile. Contact Support or check your Internet Connection!";
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
    <!-- Dropzone.js -->
    <link href="assets/dropzone/css/dropzone.min.css" rel="stylesheet">

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
                	<h2>Update Profile</h2><small> Retailer Id: </small> <code><font color="#FF0000" size="+1" style="letter-spacing:1px;"><?php echo $RETAILER_ID;?></font></code>
                    <br>
                    <div id="show_error">
                    <?php

					echo "<font color=\"#996600\">$submit_error</font>";

					?>
                    </div>

                </div>
             </div>
         </div>
         <div class="row">
                <div class="col-lg-1 col-md-2 col-sm-1"></div>


         		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="update_profile_picture" enctype="multipart/form-data">
                          <br><br>
                          <label class="control-label">Update Profile Picture</label>
                          <img class="img-responsive img-thumbnail avatar-view" id="input_image" style="cursor:pointer; display:none" src="#">
                          <input id="SUBMITTED_PROFILE_PICTURE" type="file" name="SUBMITTED_PROFILE_PICTURE" onChange="$('#input_image').attr('src',window.URL.createObjectURL(this.files[0]));$('#input_image').attr('style','display:block');$('#reset_image').attr('style','display:block')" required>
                          <button type="reset" class="btn btn-primary" style="display:none;" id="reset_image" onClick="$('#input_image').attr('style','display:none');$('#reset_image').attr('style','display:none');">Remove Image</button>
                          <button class="btn btn-success" type="submit" name="UPDATE_PROFILE_PICTURE"  id="UPDATE_PROFILE_PICTURE"> Update Profile Picture </button>

                          <div id="file_error"></div>
                          </form>
                          <!--end of Current avatar-->
                       </div>
                	  </div>

             	</div>
          </div>


         <div class="container" style="margin-top:30px;">


      <form id="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" data-parsley-validate class="form-horizontal form-label-left" autocomplete="nope">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="SUBMITTED_RETAILER_NAME" id="retailer_name" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Date of Birth
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="date_of_birth" name="SUBMITTED_DATE_OF_BIRTH" class="date-picker form-control col-md-7 col-xs-12" placeholder="dd/mm/YYYY" type="date">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Phone Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" type="checkbox" id="check_phone_number" class="check_phone_number">
                          <input id="phone_number" name="SUBMITTED_PHONE_NUMBER" maxlength="10" min="10" class="form-control col-md-7 col-xs-12" type="number">
                          <div id="phone_number_details"></div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Aadhaar Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="aadhaar_number" name="SUBMITTED_AADHAAR_NUMBER" class="form-control col-md-7 col-xs-12" type="text" disabled>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Shop Address
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="address" name="SUBMITTED_SHOP_ADDRESS" class="form-control col-md-7 col-xs-12" type="text" style="height:70px;">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> City
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="city" name="SUBMITTED_CITY" class="form-control col-md-7 col-xs-12" type="text" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> State
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="SUBMITTED_STATE" id="state" class="form-control">
<option value="undefined" selected>----Select State----</option>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Login Username
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="login_username" name="SUBMITTED_LOGIN_USERNAME" class="form-control col-md-7 col-xs-12" type="text">
                          <div id="login_username_details"></div>
                        </div>
                      </div>

                      <hr>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" id="submit" name="SUBMIT" class="btn btn-success">Submit</button>
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
    <!-- Dropzone.js -->
    <script src="assets/dropzone/js/dropzone.min.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.min.js"></script>

  </body>
  	<script>
  <!--

	$('#login_username').keyup(function() {
		var login_username_value = $(this).val();
		if (login_username_value == "")
		{
			document.getElementById("login_username_details").innerHTML = "";
			document.getElementById("submit").disabled = false;
		}
		else if((login_username_value.length < 4) && (login_username_value.length >0))
		{
			document.getElementById("login_username_details").innerHTML = " Too weak Login Username";
			document.getElementById("submit").disabled = true;
		}
		else
		{

			if (window.XMLHttpRequest)
			{
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			}
			else
			{
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function()
			{
				if (this.readyState == 4 && this.status == 200)
				{
					var response = this.responseText;
					document.getElementById("login_username_details").innerHTML = response;
					if(response == "Available")
					{
						document.getElementById("submit").disabled = false;
					}
					else
					{
						document.getElementById("submit").disabled = true;
					}
				}
			}
			xmlhttp.open("GET","login_username_details.php?q="+login_username_value,true);
			xmlhttp.send();
		}

	});

	//binds to onchange event of your input field
	$('#SUBMITTED_PROFILE_PICTURE').bind('change', function() {
	document.getElementById("file_error").innerHTML = " ";
	var file_size = this.files[0].size;
	file_size = file_size/1024.00;
	  //this.files[0].size gets the size of your file.
	  if(file_size > 1024)
	  {
		  document.getElementById("UPDATE_PROFILE_PICTURE").disabled = true;
		  document.getElementById("file_error").innerHTML = "File Size too big";
	  }

	});
	$('#phone_number').keyup(function() {
		var value = $(this).val();
		if((value.length != 10)&&(value.length > 4))
		{
			document.getElementById("phone_number_details").innerHTML = "Phone Number should have 10 digits";
		}
		if(value.length == 10)
		{
			document.getElementById("phone_number_details").innerHTML = "";
		}
		else if((value.length !=10)&&(value.length <4))
		{
			document.getElementById("phone_number_details").innerHTML = "Phone Number should have 10 digits";
		}
	});
	$('#check_phone_number').bind('change', function() {
		var check_phone_number = document.getElementById("check_phone_number").checked;
		alert(check_phone_number);
		document.getElementById("phone_number").disabled = !check_phone_number;
	});
	$('#item_refresh').attr('href',window.location.href);
	$('#reset_image').click(function() {
		document.getElementById("UPDATE_PROFILE_PICTURE").disabled = false;
		document.getElementById('file_error').innerHTML = " ";
	});
	-->
  </script>
</html>
