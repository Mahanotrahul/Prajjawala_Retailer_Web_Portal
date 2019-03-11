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
					$Insert_status = FALSE;
					$submit_status = -1;
					$cookie_name = $_COOKIE['LOGIN_USERNAME'];
					$query = "SELECT * FROM RETAILER WHERE binary LOGIN_USERNAME = '$cookie_name'";
					$result = mysqli_query($con,$query);
					$retrieve_result = (!$result || mysqli_num_rows($result) == 0)?header("Location:error.php"):mysqli_fetch_assoc($result);
					{ 
						
						
						$RETAILER_NAME = $retrieve_result["NAME"];
						$RETAILER_ID = $retrieve_result['RETAILER_ID'];
						$ORIGINAL_RETAILER_AADHAAR_NUMBER = $retrieve_result['AADHAAR_NUMBER'];
						$ORIGINAL_PASSWORD = $retrieve_result['LOGIN_PASSWORD'];
						$LOGIN_USERNAME  = $retrieve_result['LOGIN_USERNAME'];
						$low_name = strtolower($RETAILER_NAME);
						$target_dir = "uploads/$username/profilepictures/";
						
					}
					
					
				$submit_error = "";
				$profile_picture_location = profile_picture_location($LOGIN_USERNAME);
	
	if(isset($_POST['SUBMIT']))
	{
		$CONSUMER_ID =mysqli_real_escape_string($con,$_POST['CONSUMER_ID']);
		$RETAILER_AADHAAR_NUMBER = mysqli_real_escape_string($con,$_POST['RETAILER_AADHAAR_NUMBER']);
		$SUBMIT_PASSWORD = mysqli_real_escape_string($con,$_POST['SUBMIT_PASSWORD']);
		$date = date("Y-m-d");

		
			if(strlen($RETAILER_AADHAAR_NUMBER) != 12)
			{
				$submit_error = "Aadhaar Number is Incorrect!";
				$submit_status = 0;
			}
			else if($ORIGINAL_RETAILER_AADHAAR_NUMBER != $RETAILER_AADHAAR_NUMBER)
			{
				$submit_error = "Aadhaar number not matched. Try Again!";
				$submit_status = 0;
				
			}
			else if($ORIGINAL_PASSWORD != $SUBMIT_PASSWORD)
			{
				$submit_error = "Incorrect Password";
				$submit_status = 0;
			}
			
			else
			{
				$gas_usage_query="SELECT * FROM `CONSUMER_GAS_USAGE` WHERE binary CONSUMER_ID = '$CONSUMER_ID'";
				$enquiry_result = mysqli_query($con,$gas_usage_query);
				if(!$enquiry_result || mysqli_num_rows($enquiry_result) == 0)
				{
					clearstatcache();
					$submit_error = "Consumer Not found";
					$submit_status = 0;
				}
				else
				{
					clearstatcache();
					$retrieve_enquiry_result = mysqli_fetch_assoc($enquiry_result);
					$LAST_RECHARGE_DATE = $retrieve_enquiry_result['LAST_RECHARGE_DATE'];
					$LAST_RECHARGE_AMOUNT = $retrieve_enquiry_result['LAST_RECHARGE_AMOUNT'];
					$LAST_RECHARGE_GAS_EQUIVALENT = $retrieve_enquiry_result['LAST_RECHARGE_GAS_EQUIVALENT'];
					$CURRENT_LPG_LEFT = $retrieve_enquiry_result['CURRENT_LPG_LEFT'];
					$submit_status = 1;
				}
				
			}
			
		
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
	var name = "&nbsp;<?php echo "$RETAILER_NAME";?>";
	
	var submit_status = <?php echo "$submit_status";?>;
	var customer_id = "<?php echo "$CONSUMER_ID";?>";
	var retailer_aadhaar_number = "<?php echo "$RETAILER_AADHAAR_NUMBER";?>";
		
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
    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet">
    
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  

    
    
    
    
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
        
        <div class="container" style="margin-top:50px;">
        	<div class="row" style="margin-top:50px;">
            	
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 text-center">
                	<h2><b>Cosnumer Gas Enquiry</b></h2>
                    
                    <?php 
			
					echo "<font color=\"#996600\">$submit_error</font>";
				
					?>
        
                </div>
                
            </div>
        </div>
        
        <div class="container" class="enquiry_form" style="margin-top:30px;">
        	
        
      <form id="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer Id <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="CONSUMER_ID" id="consumer_id" required class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                  
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Retailer Aadhaar Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="retailer_aadhaar_number" name="RETAILER_AADHAAR_NUMBER" class="form-control col-md-7 col-xs-12" type="number" required>
                        </div>
                      </div>
                      
                      
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="submit_password" name="SUBMIT_PASSWORD" class="form-control col-md-7 col-xs-12" type="password" required>
                        </div>
                      </div>
                    
                      
                      <hr>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="SUBMIT" class="btn btn-success">Enquire Balance </button>
                        </div>
                      </div>

                    </form>
                    
             </div>
           
                 <?php 
				  if($submit_status == 1)
				  {
					  echo "<div class=\"col-md-12 col-sm-12 col-xs-12\">";
					  	echo "<div class=\"x_panel\">";
					  		echo "<div class=\"x_title\">";
					  			echo "<h2>Customer Gas Usage Enquiry</h2>";
					  				echo "<ul class=\"nav navbar-right panel_toolbox\">";
					  					echo "<li id=\"collapse-li\"><a class=\"collapse-link\" onClick=\"collapse_link();\"><i class=\"glyphicon glyphicon-menu-up\" id=\"collapse-i\"></i></a></li>
												<li id=\"close-li\"><a class=\"close-link\"><i class=\"glyphicon glyphicon-remove-circle\" id=\"close-i\"></i></a></li>
										   </ul>
														<div class=\"clearfix\"></div>
						   			</div>";
					  
					  echo "<div class=\"x_content\">
                 	<div class=\"table-responsive\">
                      <table class=\"table table-striped jambo_table\">
                        <thead>
                          <tr class=\"headings\">
                            
                            <th class=\"column-title\">Consumer Id</th>
                            <th class=\"column-title\">Last Recharge Date </th>
                            <th class=\"column-title\">Last Recharge Amount </th>
                            <th class=\"column-title\">Last Recharge Equivalent </th>
                            <th class=\"column-title\">Current Lpg Left </th>
                            
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <td class=\" \">$CONSUMER_ID</td>
                            <td class=\" \">$LAST_RECHARGE_DATE</td>
                            <td class=\" \">$LAST_RECHARGE_AMOUNT</td>
                            <td class=\" \">$LAST_RECHARGE_GAS_EQUIVALENT</td>
                            <td class=\" \">$CURRENT_LPG_LEFT</td>
                            
                          </tr>
						   
                        </tbody>
                      </table>
					   </div>
							</div></div>
						
                  </div>";
					  
				  }
				?>
          
        </div>
        
         <!-- footer content -->
        <footer>
          
          
        </footer>
        <!-- /footer content -->
        

    <!-- jQuery -->
    <script src="assets/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Datatables -->
    <script src="assets/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.min.js"></script>
	
  </body>
  
  <script>
  <!--
	 var collapse_link_click = 0;
  	document.getElementById("item_gas_usage_enquiry").className = "active";

	if(submit_status == 0)
	{
		document.getElementById("consumer_id").value = customer_id;
		document.getElementById("retailer_aadhaar_number").value = retailer_aadhaar_number;
	}
	else
	{
		document.getElementsByClassName("enquiry_form").display = "block";
	}
	
	function collapse_link() 
	{
		
		collapse_link_click++;
		if(collapse_link_click%2 != 0)
		{
			document.getElementById("collapse-i").style.transform = "rotate(180deg)";
		}
		else
		{
			document.getElementById("collapse-i").style.transform = "rotate(0deg)";
		}
	}
	

	-->
  </script>
  
</html>
