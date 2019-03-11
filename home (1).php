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
	var name = "&nbsp;<?php echo "$NAME ";?> ";
	
		
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
    
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="sidebar-template.js" type="text/javascript" language="javascript"></script>
    <script src="top_nav_template.js" type="text/javascript" language="javascript"></script>
  

    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body" style=" background-color:#066" >
      <div class="main_container"  style=" background-color:#066">
		<script type="text/javascript">
			createtemplate();
			top_nav_template();
			</script>

        
        <!-- page content -->
        <div class="right_col" role="main">
        <div class="container" style="">
        	<div class="row">
            	<div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-xs-12 text-center"><h2>Login Successful</h2></div>
                <div class="col-lg-3"></div>
             </div>
        </div>
        
        <div class="container" style="margin-top:250px;">
        	<div class="row">
            	<div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 col-xs-12 text-center"><h4>Welcome to your Dashboard</h4><h1><p><?php echo $NAME ?></h1></div>
                <div class="col-lg-3"></div>
             </div>
        </div>
        
      
        </div>
        
         <!-- footer content -->
        <footer>
          
          
        </footer>
        <!-- /footer content -->
        

    <!-- jQuery -->
    <script src="assets/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.min.js"></script>
	
  </body>
  	<script>
  <!--
  
  	var active = document.getElementById("item_home");
	active.className += " active";

	-->
  </script>
</html>
