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
	var item5 = "&nbsp;<?php echo "$NAME ";?> ";
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


</head>

<body>

<script>
createtemplate();
</script>




</body>



</html>