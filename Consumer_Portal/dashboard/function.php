<?php

$prajjawala_logo_location = "images/prajjawala_logo_smallsize.png";
$prajjawala_big_logo_location = "images/prajjawala_logo_smallsize.png";

function profile_picture_location($consumer_id)
{
	$dir = "profile/user.png";
	return $dir;
	// Open a directory, and read its contents
	if (is_dir($dir))
	{
	  if ($dh = opendir($dir))
	  {
			while (($file = readdir($dh)) !== false)
			{
				$file_name = $file;
			  $filetype = pathinfo($file,PATHINFO_EXTENSION);
				$filename = pathinfo($file, PATHINFO_FILENAME);
				if($filename != $consumer_id)
				{
					continue;
				}
			  if(($filetype == "png")||($filetype == "jpg")||($filetype == "jpeg")||($filetype == "JPG"))
			  {
				  $image_file_type = $filetype;
				  $profile_picture_location = "profile/$file_name";
				  return $profile_picture_location;

			  }

			}
			closedir($dh);
			copy("images/user.png","user.png");
			$profile_picture_location = "user.png";
			return $profile_picture_location;

	  }
	}

}



function user_exists($email, $pan, $phone_number, $con)
{
	$result = mysqli_query($con,"SELECT * FROM member WHERE EMAIL='$email' OR PHONE_NUMBER = '$phone_number' OR PAN_NUMBER = '$pan'");
	if(!$result || (mysqli_num_rows($result) == 0))
	{
		return false;
	}
	else
	{
		return true;
	}

}

function logged_in()
{
	if(isset($_SESSION) &&(isset($_SESSION['LOGIN_SESSION'])) && (isset($_COOKIE['LOGIN_EMAIL'])))
	{
		if($_SESSION['LOGIN_SESSION'] == md5($_COOKIE['LOGIN_EMAIL']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

?>
