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
						$RETAILER_NAME = $retrieve_result["NAME"];
						$LOGIN_USERNAME = $retrieve_result['LOGIN_USERNAME'];
						$low_name = strtolower($RETAILER_NAME);
					
					$submit_error = "";
					$profile_picture_location = profile_picture_location($LOGIN_USERNAME);
					
					
	if(isset($_POST['UPDATE_PROFILE_PICTURE']))
	 {
			$target_dir = "profile/$LOGIN_USERNAME/";
			$file_name = $target_dir.$_FILES["SUBMITTED_PROFILE_PICTURE"]["name"];
			echo $file_name;
			$uploadOk = 1;
			$imagefiletype = pathinfo($file_name,PATHINFO_EXTENSION);
			$newfile_name = $target_dir.strtolower("profile_picture.$imagefiletype");
			echo "<br>";
			echo $newfile_name;
			
				$check = getimagesize($_FILES["SUBMITTED_PROFILE_PICTURE"]["tmp_name"],$file_name);
				if($check !== false) 
				{
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} 
				else 
				{
					echo "File is not an image.";
					$uploadOk = 0;
				}
				
				unlink($profile_picture_location);
				if (move_uploaded_file($_FILES["SUBMITTED_PROFILE_PICTURE"]["tmp_name"], $newfile_name)) 
				{
					echo "The file ". basename( $_FILES["SUBMITTED_PROFILE_PICTURE"]["name"]). " has been uploaded.";
					header("Location:Update_Profile.php");
					exit();
				}
				else 
				{
					echo "Sorry, there was an error uploading your file.";
				}
	 }
}

ob_end_flush();	
?>