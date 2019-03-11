<?php ob_start();

include("connect.php");
include("function.php");
$randomnumber = rand(0000,9999);
if(logged_in()==TRUE){
	header("Location:home.php");
	exit();
}

$login_error = "";

if(isset($_POST['LOGIN']))
{
	$SUBMITTED_LOGIN_USERNAME =$_POST['LOGIN_USERNAME'];
	$SUBMITTED_LOGIN_PASSWORD=$_POST['LOGIN_PASSWORD'];


	if($SUBMITTED_LOGIN_USERNAME==' ')
	{
		$login_error="Enter your Username";
	}
	else if($SUBMITTED_LOGIN_USERNAME==' ')
	{
		$login_error="Enter your Password";
	}
	else
	{

		if (login_username_exists($SUBMITTED_LOGIN_USERNAME,$con))
		{
			$result = mysqli_query($con,"SELECT * FROM RETAILER WHERE LOGIN_USERNAME='$SUBMITTED_LOGIN_USERNAME'");
			if(!$result)
			{
				$login_error = "Sorry. Unable to Process Request. Please contact the Support Service";
			}
			else if( mysqli_num_rows($result) == 0)
			{
				$login_error = "LOGIN_USERNAME does not exist in our DATABASE";
			}
			else
			{
					$retrieve_result = mysqli_fetch_assoc($result);
					$NAME = $retrieve_result["NAME"];
					$LOGIN_USERNAME = $retrieve_result['LOGIN_USERNAME'];
					$password = $retrieve_result["LOGIN_PASSWORD"];
				if(strcmp($SUBMITTED_LOGIN_PASSWORD,$password) == 0)
				{
					$login_error="Password is CORRECT";
					$_SESSION['LOGIN_USERNAME']=$LOGIN_USERNAME;
					setcookie("LOGIN_USERNAME",$LOGIN_USERNAME,time()+3600,"/","");
					$_SESSION["LOGIN_SESSION"] = md5($LOGIN_USERNAME);
					$login_error="Logged In";


						//Save Login Details in txt file
					$dir = "profile/$LOGIN_USERNAME/";
					// Open a directory, and read its contents
					if (!is_dir($dir))
					{
						mkdir("profile/$LOGIN_USERNAME");
					}
					$file = fopen("profile/$LOGIN_USERNAME/$LOGIN_USERNAME.txt","a") or die("Unable to open file");
					$Client_ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
					$PublicIP = $Client_ip;
					 $json  = file_get_contents("https://freegeoip.net/json/$PublicIP");
					 $json  =  json_decode($json ,true);
					 $client_time_zone =  $json['time_zone'];
					print_r($json);
					date_default_timezone_set($client_time_zone);
					$Login_text = "\nLogin_Date: ";
					fwrite($file,$Login_text);
					$Login_Date = date(" l , d/m/Y ");
					fwrite($file,$Login_Date);
					$Login_Time = date("H:i:sa ,");
					fwrite($file,", ".$Login_Time);
					//$Client_ip;
					fwrite($file,$Client_ip);
					fwrite($file,", " . $ua['bname']);
					fwrite($file,", " .$ua['bversion']);
					fwrite($file,", ".$ua['bplatform']);
					fclose($file);



					header("Location:home.php");
					exit();
				}
				else
				{
					$login_error="Incorrect Password";
				}

		}


		}
		else
		{
			$login_error = "LOGIN_USERNAME does not exist in our DATABASE";
		}
	}


}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prajjawala Retailers Login</title>
<meta name="viewport" charset="utf-8"  content="width=device-width, initial-scale=1" />
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
<body background="assets/images/background.png">

<div class="container" style="">
	<div class="row">
    	<div class="col-lg-6 col-sm-4  text-left">
        	<img src="" class="logo img-responsive" width="200px;" height="200px" style="text-align:left" />
        </div>

        <div class="col-lg-6 col-sm-4">

        </div>
    </div>
</div>


<section class="center-block">
<div class="container" style="margin-top:0px;">
<div class="row" style="">

    <div class="col-lg-4 col-sm-3 col-xs-2"></div>
        <div class="col-lg-4 col-sm-6 col-xs-8 login_form" id="login_form"  style="display:; background-color:#FFF">

            			<div class="text-center"  style="color:#F00; margin:20px;">
                        <br />
                       	<div style="text-align:left; margin-left:20px;">RETAILER LOGIN</div><br />


                            <div class="item active">
									<?php echo $login_error;?>

                                <div class="login_form">
                                    <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                        <input type="text" name="LOGIN_USERNAME" class="login_username" id="login_username" placeholder="Login Username"
                                        data-type="text" aria-required="required" required="required"  title=" " /><br />
                                        <input type="password" name="LOGIN_PASSWORD" class="login_password" id="login_password" placeholder="Password"
                                        data-type="password" aria-required="required" required="required" title=" " /><br />
                                        <input type="submit" class="text-center submit_login_form" id="submit_login_form" name="LOGIN"
                                          type="button" value="Log In"/>
                                     </form>
                                  </div>
                                  <br />

                             </div>
                        </div>

    	</div>


</div>
</div>
</section>

<section class="footer">
<div class="container">
	<div class="row footer">
    	<div class="col-lg-7 col-md-8 col-sm-6 col-xs-4">
        </div>

        <div class="col-lg-5 col-md-4 col-sm-6 col-xs-8 text-center">
        	<div style="color:#CCC"> <?php echo date("Y");?></div>
        </div>
     </div>
</div>
</section>

</body>

<script>
<!--

 	var classadd = document.getElementById("span2");
	classadd.className += " active";
	/*var pass = document.getElementById("password");
	var display = document.getElementById("form1");
	pass.oninput = display.ownerDocument.writeln("Hello");*/
	var op1 = 1;
	var signform1 = document.getElementById("form1");
	function opacity()
		{
			if(op1 >= 0)
			{
						op1 = op1 - 0.01;
						signform1.style.opacity = op1;
			}
			else
			{
				signform1.style.display += " none";
				var signform2 = document.getElementById("divform");
				signform2.style.visibility  = " visible " + signform2.style.display;
			}
		}
	function display()
	{

			var interval = setInterval(opacity,1);

	}


	-->
</script>
</html>
