<?php
ob_start();
include("connect.php");
include("function.php");

$login_email_err = "";
$dob_err = "";

function gen_randomPassword() {
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
  $replysubject = "Password Changed | Employee Dashboard | prajjawala";

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

if(isset($_POST['submit']))
{
		 $error = 0;
		 $email = mysqli_real_escape_string($con, $_POST['email']);
     $dob = mysqli_real_escape_string($con, $_POST['dob']);
		 if(empty($email))
		 {
			$login_email_err = "Email Id is Required";
			$error = 1;
		 }
		 else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		 {
			 $_SESSION['login_email'] = $email;
			 $login_email_err="Invalid Email address. Please use Official prajjawala Email Id";
			 $error=1;
		 }
		 else
		 {
			 $_SESSION['login_email'] = $email;
		 }

    if(empty($dob))
    {
      $dob_err = "Date of Birth is Required";
      $error = 1;
    }
    else
    {
      $_SESSION['dob'] = $dob;
    }

		 /* Connection */

		if($error!=1)
		{

				$query = mysqli_query($con,"SELECT * FROM RETAILER where EMAIL = '$email' and DATE_OF_BIRTH = '$dob'");
				if(!$query)
				{
					$login_error = "Sorry. Unable to Process Request. Please contact the Support Service";
					echo  "<script type='text/javascript'>alert('Sorry. Unable to Process Request. Please contact the Support Service');
							window.location = 'login.php';</script>";
				}
				else if(mysqli_num_rows($query) == 0)
				{
          $query_test = mysqli_query($con,"SELECT * FROM RETAILER where EMAIL = '$email'");
          if(!$query_test)
          {
            $login_error = "Sorry. Unable to Process Request. Please contact the Support Service";
  					echo  "<script type='text/javascript'>alert('Sorry. Unable to Process Request. Please contact the Support Service');
  							window.location = 'login.php';</script>";
          }
          else if(mysqli_num_rows($query_test) == 0)
          {
            $login_error = "Email Id does not exist in our databse. Please verify the details";
  					echo  "<script type='text/javascript'>alert('Email Id does not exist in our databse. Please verify the details');</script>";
          }
          else
          {
            if(mysqli_num_rows($query_test) == 1)
            {
              $row = mysqli_fetch_assoc($query_test);
              password_update_attempt($email, $row['NAME']);
              $login_error = "Invalid Email Id or Date of Birth. Please verify the details";
    					echo  "<script type='text/javascript'>alert('Invalid Email Id or Date of Birth. Please verify the details');</script>";
            }
            else
            {
              $login_error = "Invalid Email Id or Date of Birth. Please verify the details";
    					echo  "<script type='text/javascript'>alert('Invalid Email Id or Date of Birth. Please verify the details');</script>";
            }
          }

				}
				else
				{
					if(mysqli_num_rows($query) == 1)
					{
							$row = mysqli_fetch_assoc($query);
							$pass = gen_randomPassword();
							$pass1 = $pass;
							$query = mysqli_query($con, "UPDATE RETAILER SET LOGIN_PASSWORD = '".$pass1."' WHERE RETAILER_ID = '".$row['RETAILER_ID']."' AND EMAIL = '".$email."'");
								if($query)
								{
									send_email($email, $row['NAME'], $pass);
									echo  "<script type='text/javascript'>alert('Password Changed. Please check your email for new password.');</script>";
                  header("login.php");
                  echo  "<script type='text/javascript'>window.location = 'login.php';</script>";
								}
								else
								{
                  password_update_attempt($email, $row['NAME']);
									echo  "<script type='text/javascript'>alert('Unable to Update Password. Try again.');</script>";
								}
					}
				}
			}
}

ob_end_flush();
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="Prajjawala">
    <meta name="description" content="Rejuvenating Pipelines">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Forgot Password | Prajjawala</title>

  <link href="<?php echo $logo_location;?>" role="link" rel="icon" />
  <!--<link href="" rel="shortcut icon" />-->
  <link href="/assets/css/style.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!--Style-->
      <link rel="stylesheet" href="assets/css/style.css">


  <script src="assets/js/navtemplate.js" type="text/javascript" language="javascript"> </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>

	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>-->
				<a class="navbar-brand" href="http://www.prajjawala.com/" target="_blank"><span style="font-family :'Lobster', cursive; text-transform:  capitalize; font-size : 0.85em;color:#fff;"><img src="<?php echo $logo_location;?>" width="100px;"></span></a>
				<ul class="nav navbar-top-links navbar-right">
					<li></li>
					<li></li>

					<li></li>
					<li></li>

	      </ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>



	<div class="col-sm-12 col-sm-offset-12 col-lg-12 col-lg-offset-0 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
			  </a></li>
				<li class="active">Change Password</li>
			</ol>
		</div><!--/.row-->
    </div>


    <div class="col-sm-12 col-sm-offset-12 col-lg-8 col-lg-offset-2 main">

        <div class="row">
        	<div class="col-lg-12">
            	<div class="panel panel-teal">
                	<div class="panel-body">

                        <div class="row" style="">
                        	<div class="col-lg-12" style="background:#0F3">
                                <ol class="breadcrumb" style="background:#0F9">

                                    <li class="active">Change Password
                                    </li>
                                </ol>
                            </div>
                        </div><!--/.row-->
                        <br><br>


                    	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                    	<div class="row">

                        	<div class="col-lg-6 col-md-6">
                            	<label class="label control-label">Your Email</label>
                                <input type="email" class="form-control" name="email"  placeholder="Official Email Id" required><span class="error">  <?php  echo $login_email_err?> </span>
                            </div>
                            <div class="col-lg-6 col-md-6">
                              	<label class="label control-label">Date of Birth</label>
                                  <input type="date" class="form-control" name="dob" placeholder="Your Date of Birth"  required><span class="error">  <?php  echo $dob_err?> </span>
                             </div>

                        </div>


                        <div class="row">
                        	<div class="col-lg-6 col-md-6">
														<br>
                            	<input type="submit" class="btn btn-success" id="submit" name="submit" value="Submit" placeholder="Log In">

                             </div>
                        </div><!-- row -->



												</form>
                     </div><!-- panel-body -->
                 </div><!-- panel -->
             </div><!-- col -->
        </div><!-- row -->







		<div class="col-sm-12">
				<p class="back-link">&copy Prajjawala <?php echo date("Y"); ?></p>
			</div>
		</div>

	</div>	<!--/.main-->


</body>
</html>
