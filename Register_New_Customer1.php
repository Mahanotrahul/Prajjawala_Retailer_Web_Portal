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
					$query = "SELECT NAME, RETAILER_ID FROM RETAILER WHERE LOGIN_USERNAME = '$cookie_name'";
					$result = mysqli_query($con,$query);
					$retrieve_result = mysqli_fetch_assoc($result);
					{ 
						
						
						$NAME = $retrieve_result["NAME"];
						
						$low_name = strtolower($NAME);
						$target_dir = "uploads/$username/profilepictures/";
						
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
	var item5 = "&nbsp;<?php echo "$NAME";?>";
	var profilepic = "<?php echo "uploads/$username/profilepictures/$low_firstname.profilepic.1.jpg";?>";
		
</script>


<html>
<head>
<title><?php echo "$NAME | Prajjwala";?></title>
<meta name="viewport" charset="utf-8"  content="width=device-width, initial-scale=1" />
<link href="assets/images/Prajjwala_logo.png" role="link" rel="icon" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.css" rel="stylesheet">

  <script src="assets/js/logged-navtemplate.js?r=<?php echo rand(0000,9999);?>" type="text/javascript" language="javascript"> </script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
<script>
	var item5 = "&nbsp;<?php echo "$NAME ";?> ";
	
		
</script>

<style>
		.login_form_div{
			border:solid 1px #666;
		}
		.login_form{
			margin-left:00px;
			margin-right:20px;
		}
		.login_username{
			margin:20px;
			width:90%;
			height:5%;
			color:#666;
			border:solid 1px #000;
			padding:10px;
			-webkit-user-select:none;
		}
		.login_password{
			margin:20px;
			width:90%;
			height:5%;
			color:#666;
			border:solid 1px #000;
			padding:10px;
			-webkit-user-select:none;
		}
		.submit_login_form{
			width:35%;
			height:5%;
			padding-top:5px;
			padding-bottom:5px;
			margin-top:10px; 
			color:#000;
			border:solid 1px #666;
			transition-duration:1s;
		}
		.submit_login_form:hover{
				background:#999;
		}
</style>

</head>

<body>

<script>
createtemplate();
</script>

<div class="container">
	<div class="row">
    	<div class="col-lg-2 col-xs-1"></div>
        <div class="col-lg-4 col-xs-10">
        	<h2> Register New Customer</h2>
        </div>
        <div class="col-lg-6" col-xs-1></div>
	</div>
</div>

<section class="center-block">
<div class="container" style="margin-top:0px;">
<div class="row" style="">
	
    <div class="col-lg-4 col-sm-4 col-xs-1"></div>
        <div class="col-lg-4 col-sm-4 col-xs-10 login_form_div" id="login_form"  style="display:; background-color:#FFF">
            
            			<div class="text-center"  style="color:#F00; margin:20px;">
                        <br />
                       	<div style="text-align:left; margin-left:20px;"> </div><br />
                               
                                <div class="login_form">
                                    <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
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
     <div class=" col-lg-4 col-sm-4 col-xs-1" style="">
     
        </div>
</div>
</section>

</body>
<script src="BOOTSTRAP.js"></script>
<script>
$(document).ready(function() {
	
	setTimeout(function(){
		$('body').addClass('loaded');
	}, 3);
	
});</script>
<script type="text/javascript">
$(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
	$('#preloader').fadeOut('slow',function(){$(this).remove();});
});

});
</script>

</html>