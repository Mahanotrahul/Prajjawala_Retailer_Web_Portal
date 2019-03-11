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
					$query = "SELECT * FROM RETAILER WHERE binary LOGIN_USERNAME = '$cookie_name'";
					$result = mysqli_query($con,$query);
					$retrieve_result = (!$result || mysqli_num_rows($result) == 0)?header("Location:error.php"):mysqli_fetch_assoc($result);
					{

						$RETAILER_ID = $retrieve_result['RETAILER_ID'];
						$RETAILER_NAME = $retrieve_result["NAME"];
						$RETAILER_DATE_OF_BIRTH = $retrieve_result['DATE_OF_BIRTH'];
						$RETAILER_PHONE_NUMBER = $retrieve_result['PHONE_NUMBER'];
						$RETAILER_SHOP_ADDRESS = $retrieve_result['SHOP_ADDRESS'];
						$RETAILER_AADHAAR_NUMBER = $retrieve_result['AADHAAR_NUMBER'];
						$RETAILER_CITY = $retrieve_result['CITY'];
						$RETAILER_STATE = $retrieve_result['STATE'];
						$RETAILER_LICENSE_NUMBER = $retrieve_result['LICENSE_NUMBER'];
						$LOGIN_USERNAME = $retrieve_result['LOGIN_USERNAME'];
						$low_name = strtolower($RETAILER_NAME);
						$target_dir = "uploads/$username/profilepictures/";

					}
					$submit_error = "";
					$profile_picture_location = profile_picture_location($LOGIN_USERNAME);

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
	var name = "&nbsp;<?php echo "$RETAILER_NAME";?>";

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

    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body" style=" background-color:#066" >
      <div class="main_container"  style=" background-color:#066">

		<?php
		include("side_nav-template.php");
		include("top_nav-template.php");
		?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Profile </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                      <li style="margin-right:20px;"><a  href="Update_Password.php "class="btn-success"><i class="glyphicon glyphicon-edit"></i> Change Password</a>
                      </li>
                      &nbsp;&nbsp;
                      <li><a  href="Update_Profile.php "class="btn-success"><i class="glyphicon glyphicon-edit"></i> Edit Profile </a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="<?php echo $profile_picture_location; ?>" alt="Avatar" title="Change Profile Picture">
                        </div>
                      </div>
                      <h3><?php echo $RETAILER_NAME;?></h3>
                    </div>


                    <div class="col-md-4 col-sm-3 col-xs-12">

                      <ul class="list-unstyled user_data">
                      <big>
                        <li><i class="glyphicon glyphicon-map-marker user-profile-icon"></i><?php echo " $RETAILER_SHOP_ADDRESS".", $RETAILER_CITY".", $RETAILER_STATE"; ?>
                        </li>

                        <li>
                          <i class="glyphicon glyphicon-user user-profile-icon"></i> Retailer ID: <code><font color="#FF0000" size="+1" style="letter-spacing:1px;"><?php echo $RETAILER_ID;?></code></font>
                        </li>

                        <li>
                        	<label>Date of Birth:</label> &nbsp; <?php echo $RETAILER_DATE_OF_BIRTH; ?>
                        </li>
                        <li>
                        	<label>Phone Number:</label> &nbsp; <?php echo $RETAILER_PHONE_NUMBER; ?>
                        </li>
                        <li>
                        	<label>License Number:</label> &nbsp; <?php echo $RETAILER_LICENSE_NUMBER; ?>
                        </li>
                        <li>
                        	<label>Aadhaar Number:</label> &nbsp; <?php echo $RETAILER_AADHAAR_NUMBER; ?>
                        </li>

                      </ul>


                      <br />
                    </div>




                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


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

  	var active = document.getElementById("item_profile");
	active.className += " active";

	-->
  </script>
</html>
