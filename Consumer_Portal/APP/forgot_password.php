<?php
ob_start();

$host = "localhost";
$username = "u402156879_lpg1";
$password = "!prajjwala2k18";
$dbname = "u402156879_lpg1";

$con=mysqli_connect($host,$username,$password,$dbname);
if(mysqli_connect_errno())
{
	$db_connection_status =  "Error occured when connecting with database";
	$error_status = 1;
	echo $db_connection_status;
}
else
{

  include("function.php");

  $login_email_err = "";
  $dob_err = "";

  function gen_randomPassword()
  {
      $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $pass = array(); //remember to declare $pass as an array
      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
      for ($i = 0; $i < 8; $i++) {
          $n = rand(0, $alphaLength);
          $pass[] = $alphabet[$n];
      }
      return implode($pass); //turn the array into a string
  }

  function password_update_attempt($EMAIL, $NAME)
  {
  	$replyto = $EMAIL;
    $replysubject = "Password Update Attempt | Employee Dashboard | prajjawala";

  	// Set content-type header for sending HTML email
  	$headers = "MIME-Version: 1.0" . "\r\n";
  	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From:prajjawala <donotreply@prajjawala.com>'."\r\n";


  	 $replymessage = '
      <html>
      <head>
          <title>Invalid Password Update Attempt</title>
  	    <link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">

      </head>
      <body style="font-family:"Raleway"">';
  		$replymessage .= 'Hello there ';
  		$replymessage .= $NAME;
  		$replymessage .= ',<br><br>';
     $replymessage .= 'Someone tried to change your password but could not get through successfully. Please ignore this mail if it was you.';
     $replymessage .= '.<br><br>';
    	$replymessage .= 'Please update your password to a strong one and secure your account or report this issue to the admin. <b><i>';
  		$replymessage.= '</b></i><br><br>';
  	 	$replymessage .= "<br>Contact Rahul - 9583962928 for any related queries. <br>";
  		$replymessage .= "Regards <br>";
  		$replymessage .= "Admin <br>";
  		$replymessage .= "prajjawala <br>";
  	$replymessage .= '<br><i>This e-mail is automated, so please DO NOT reply</i>';
  	$replymessage .= '
      </body>
      </html>';


   mail($replyto, $replysubject, $replymessage, $headers);
  }

  function send_email($EMAIL, $NAME, $pass)
  {
  	$replyto = $EMAIL;
    $replysubject = "Password Changed | Prajjawala";

  	// Set content-type header for sending HTML email
  	$headers = "MIME-Version: 1.0" . "\r\n";
  	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From:prajjawala <donotreply@prajjawala.com>'."\r\n";


  	 $replymessage = '
      <html>
      <head>
          <title>Password Changed</title>
  	    <link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">

      </head>
      <body style="font-family:"Raleway"">';
  		$replymessage .= 'Hello there ';
  		$replymessage .= $NAME;
  		$replymessage .= ',<br><br>';
     $replymessage .= 'You have successfully changed your passsword.';
     $replymessage .= '.<br><br>';
    	$replymessage .= 'Your new password is <b><i>';
  		$replymessage.= $pass;
  		$replymessage.= '</b></i><br><br>';
  	 	$replymessage .= "<br>If you didn't change your password and find this activity suspicious, Please <a href='https://prajjawala.com/old/prajjawala/forgot_password.php'>click here</a> to change your password. Contact Rahul - 9583962928 for any related queries. <br>";

  		$replymessage .= "Regards <br>";
  		$replymessage .= "Admin <br>";
  		$replymessage .= "prajjawala <br>";
  	$replymessage .= 'This e-mail is automated, so please DO NOT reply';
  	$replymessage .= '
      </body>
      </html>';


   mail($replyto, $replysubject, $replymessage, $headers);
  }

       $error = 0;
  		 $email = mysqli_real_escape_string($con, $_REQUEST['email']);
       //$dob = mysqli_real_escape_string($con, $_REQUEST['dob']);
  		 if(empty($email))
  		 {
  			$login_error = "Email Id is Required";
  			$error = 1;
  		 }
  		 else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
  		 {
  			 $login_error="Invalid Email address. Please use Official Email Id";
  			 $error=1;
  		 }
  		 /* Connection */

  		if($error!=1)
  		{
            $query_test = mysqli_query($con,"SELECT * FROM CONSUMER where CONSUMER_EMAIL = '$email'");
            if(!$query_test)
            {
              $login_error = "Sorry. Unable to process request. Please contact the Support Service";
            }
            else if(mysqli_num_rows($query_test) == 0)
            {
              $login_error = "Email Id does not exist in our databse. Please verify the details";
            }
            else
            {
              $row = mysqli_fetch_assoc($query_test);
              $pass = gen_randomPassword();
              $pass1 = $pass;
              $query = mysqli_query($con, "UPDATE CONSUMER SET PASSWORD = '".$pass1."' WHERE CONSUMER_ID = '".$row['CONUSMER_ID']."' AND EMAIL = '".$email."'");
                if($query)
                {
                  send_email($email, $row['NAME'], $pass);
                  $login_error = "A mail has been sent with your new password. Please check your mail.";
                }
                else
                {
                  $login_error = "Unable to change the new password. Please try again.";
                }
            }

      }
	  echo $login_error;
    }

  ob_end_flush();
?>
