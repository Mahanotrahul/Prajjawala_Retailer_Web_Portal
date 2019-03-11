<?php

$logo_location = "assets/images/Prajjawala_logo_smallsize.png";
date_default_timezone_set("Asia/Kolkata");



function profile_picture_location($LOGIN_USERNAME)
{
	$dir = "profile/$LOGIN_USERNAME/";
	// Open a directory, and read its contents
	if (is_dir($dir))
	{
	  if ($dh = opendir($dir))
	  {
		while (($file = readdir($dh)) !== false)
		{
			$file_name = $file;
		  $filetype = pathinfo($file,PATHINFO_EXTENSION);
		  if(($filetype == "png")||($filetype == "jpg")||($filetype == "jpeg")||($filetype == "JPG"))
		  {
			  $image_file_type = $filetype;
			  $profile_picture_location = "profile/$LOGIN_USERNAME/$file_name";
			  return $profile_picture_location;

		  }

		}
		closedir($dh);
		copy("assets/images/user.png","profile/$LOGIN_USERNAME/user.png");
		$profile_picture_location = "profile/$LOGIN_USERNAME/user.png";
		return $profile_picture_location;

	  }
	}
	else
	{
		mkdir("profile/$LOGIN_USERNAME");
	    copy("assets/images/user.png","profile/$LOGIN_USERNAME/user.png");
		$profile_picture_location = "profile/$LOGIN_USERNAME/user.png";
		return $profile_picture_location;
	}

}

function login_username_exists($LOGIN_USERNAME, $con)
{
$result = mysqli_query($con,"SELECT RETAILER_ID FROM RETAILER WHERE binary LOGIN_USERNAME='$LOGIN_USERNAME'");

	if (!$result || mysqli_num_rows($result) == 0)
	{
		return false;
	}
	else
	{
		return true;
	}

}

function consumer_exists($SUBMITTED_PHONE_NUMBER,$SUBMITTED_CONSUMER_AADHAAR_NUMBER, $con)
{
$result = mysqli_query($con,"SELECT * FROM CONSUMER WHERE binary PHONE_NUMBER='$SUBMITTED_PHONE_NUMBER' OR binary AADHAAR_NUMBER = '$SUBMITTED_CONSUMER_AADHAAR_NUMBER'");
	if(!$result || mysqli_num_rows($result) == 0)
	{
		return false;
	}
	else
	{
		return true;
	}

}

function consumer_id_exists($CONSUMER_ID,$RETAILER_ID, $con)
{
$result = mysqli_query($con,"SELECT * FROM CONSUMER WHERE binary CONSUMER_ID='$CONSUMER_ID' AND binary RETAILER_ID='$RETAILER_ID'");

	if(!$result || mysqli_num_rows($result) == 0)
	{
		return false;
	}
	else
	{
		return true;
	}

}

function consumer_verify_complaint($CONSUMER_ID,$PHONE_NUMBER,$RETAILER_ID, $con)
{

 $result = mysqli_query($con,"SELECT * FROM CONSUMER WHERE binary CONSUMER_ID='$CONSUMER_ID' AND binary PHONE_NUMBER='$PHONE_NUMBER' AND binary RETAILER_ID='$RETAILER_ID'");
	if(!$result || mysqli_num_rows($result) == 0)
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
	if(isset($_SESSION) &&(isset($_SESSION['LOGIN_SESSION'])) && (isset($_COOKIE['LOGIN_USERNAME'])))
	{
		if($_SESSION['LOGIN_SESSION'] == md5($_COOKIE['LOGIN_USERNAME']))
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

function check_input($submitted_input,$original_input)
{
	if((strlen($submitted_input) !=0)&& ($submitted_input != "undefined"))
	{
		return $submitted_input;
	}
	else
	{
		return $original_input;
	}
}

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/OPR/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'bname'      => $bname,
        'bversion'   => $version,
        'bplatform'  => $platform,
        'bpattern'    => $pattern
    );
}

// now try it
$ua=getBrowser();
$yourbrowser= "Your browser: " . $ua['bname'] . " " . $ua['bversion'] . " on " .$ua['bplatform'] . " reports: <br >" . $ua['userAgent'];
//print_r($yourbrowser);



?>
