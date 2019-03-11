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
	$login_username = $_REQUEST['q'];
	$result = mysqli_query($con,"SELECT * FROM RETAILER WHERE binary LOGIN_USERNAME = '$login_username'");
	if(!$result || mysqli_num_rows($result) == 0)
	{
		echo "Available";
	}
	else if($cookie_name == $login_username)
	{
		echo " You are using this already";
	}
	else
	{
		echo $login_username."Not Available";
	}
}
ob_end_flush();
?>