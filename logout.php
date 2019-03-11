<?php ob_start();

   setcookie("LOGIN_USERNAME","",time()-86400*365*365,"/","");
  
   // remove all session variables
	session_unset(); 

	// destroy the session 
	session_destroy(); 
	
   header("Location:login.php");
ob_end_flush();
?>