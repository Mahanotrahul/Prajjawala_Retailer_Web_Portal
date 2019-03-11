<?php
ob_start();
session_start();
include("connect.php");
include("function.php");

function isChecked($mem_id)
{
	global $con;
	date_default_timezone_set("Asia/Kolkata");
	$date = date('d/m/Y');
	$time = date("H:i:sa");
	$query = mysqli_query($con, "SELECT * FROM attendance WHERE MEM_ID = '$mem_id' AND DATE = '$date'");
	$_SESSION['Checked'] = 0;
	if(mysqli_num_rows($query) > 0)
	{

		while($row = mysqli_fetch_assoc($query))
		{

			if($row['Status'] == 1)
			{
				$_SESSION['Checked'] = 1;
				$_SESSION['CheckInTime'] = $row['CheckInTime'];
				return " checked ";
			}

		}

	}


}

if(!logged_in())
{
	header("../login.php");
	echo  "<script type='text/javascript'>window.location = '../login.php';</script>";
}
else
{
	$query = mysqli_query($con, "SELECT * FROM member where EMAIL = '".$_SESSION['LOGIN_EMAIL']."'") ;
	$row = mysqli_fetch_assoc($query) ;

	if(!empty($row['EMAIL']))
	{

		 $_SESSION['fname']= $row['FNAME'];
		 $_SESSION['mobno']= $row['PHONE_NUMBER']  ;
		 $_SESSION['lname']= $row['LNAME'];
		 $_SESSION['mem_id']= $row['ID'];
		 $orig_password = $row['PASSWORD'];
		 $mem_id = $row['ID'];
		 date_default_timezone_set("Asia/Kolkata");
		 $date = date('d/m/Y');
		 $time = date("H:i:sa");




	}
	else
	{
		echo  "<script type='text/javascript'>alert('Sorry. Unable to process your request.');
				window.location = '../logout.php';</script>";
	}

}
ob_end_flush();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" href="<?php echo $vasitars_logo_location; ?>" type="image/x-icon">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="Vasitars">
    <meta name="description" content="Rejuvenating Pipelines">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Attendance | Vasitars</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <!-- Switchery -->
    <link href="css/switchery.min.css" rel="stylesheet">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<body>
	<?php
		include("top_nav_template.php");
		include("side_nav_template.php");
	?>



	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php" title="Dashboard">
					<em class="fa fa-home"></em>
			  </a></li>
				<li class="active">Attendance</li>
			</ol>
		</div><!--/.row-->

		<br>


			<?php

			include("connect.php");
			date_default_timezone_set("Asia/Kolkata");
			$date = date('d/m/Y');
			$time = date("H:i:sa");
			if(($_SERVER["REQUEST_METHOD"]== "POST") && (isset($_POST['Check_employee_details'])))
			{
				$value_date = date('Y-m-d', strtotime($_POST['Work_Check_date']));
				$_SESSION['value_date'] = $value_date;
				$find_mem = mysqli_query($con, "SELECT * FROM member WHERE ID = ".$_POST['employee_id']."");
				$mem = mysqli_fetch_assoc($find_mem);
				$_SESSION['employee_name'] = $mem['FNAME']." ".$mem['LNAME'];


			}
			else
			{
				$_SESSION['value_date'] = "";
				$_SESSION['employee_name'] = "";
			}

			echo '<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="panel panel-teal">

									<div class="panel-body">

												<div class="row">
													<div class="col-lg-3 col-md-3">
															<span style="font-size:16px; color:#9F6">Work Schedule</span>

													</div>
												</div><!-- row -->
												<form role="form" id="WorkCheckDateForm" action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post">
												<div class="row">

													<div class="col-lg-3 col-md-3">
														<label>Select Employee</label>
														<select class="form-control" name="employee_id" id="employee_id" required>
																<option value="" disabled selected> -- Select Employee Name -- </option>';

																$emp_details_query = mysqli_query($con, "SELECT * FROM member");
																while($row = mysqli_fetch_assoc($emp_details_query))
																{
																	echo '<option value="'.$row['ID'].'">'.$row['FNAME'].' '.$row['LNAME'].'</option>';
																	echo '';
																}

															echo '</select>
													</div>

													<div class="col-lg-5 col-md-5 text-right">
														<label>Select date</label>
													</div>
													<div class="col-lg-4 col-md-4 text-right" style="align:right;">
															<input style="width:100%; margin-right:10px; right:10px;" class="form-control" id="WorkCheckDate" type="date" value="'.$_SESSION['value_date'].'" max="'.date("Y-m-d").'"   name="Work_Check_date" formaction='.htmlspecialchars($_SERVER["PHP_SELF"]).'">
													</div>

												</div><!-- row -->


												<div class="row">
													<div class="col-lg-3 col-md-3">
														<br>
														<input type="submit" name="Check_employee_details" class="btn btn-success" id="submit" value="Check" placeholder="Check">
													</div>
												</div><!-- row -->
												</form>
											</div><!-- panel body -->
										</div><!-- panel teal -->
									</div><!-- col -->
								</div><!-- row -->';



				if(($_SERVER["REQUEST_METHOD"]== "POST") && (isset($_POST['Check_employee_details'])))
				{
					$date = date("d/m/Y", strtotime($_POST['Work_Check_date']));

					$d1 = new DateTime($value_date);
					$today = date("Y-m-d");

					$d2 = new DateTime($today);
					$diff = date_diff($d1, $d2);
					$date_diff = $diff->format("%a");

					$query = mysqli_query($con, "SELECT * FROM attendance WHERE MEM_ID = '".$_POST['employee_id']."' AND DATE = '$date'");



				if(mysqli_num_rows($query) > 0)
				{

						echo '<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="panel panel-teal">


												<div class="panel-body">
													<table  style="background:#1ebfae;" class="table  primary" cellspacing="0" border="1px "  bordercolor="#E7EDEE" >
													<div class="row">
															<div class="col-lg-6 col-md-6">
																<b>Employee name </b>: '.$_SESSION['employee_name'].'
															</div>

													</div>
													<br>

												  <thead>
													<tr>
													  <th style="text-align:center;  ">SI No</th>
																<th style="text-align:center;">Date</th>
																<th style="text-align:center;">Check In Time</th>
																<th style="text-align:center;">Check Out Time</th>
																<th style="text-align:center;">Session Time</th>

															</tr>
												  </thead>';

														$x = 1;
														while($row = mysqli_fetch_assoc($query))
														{

															echo '<tr style="text-align:center;">
															<td>'.$x.'</td>
															<td>'.$row['DATE'].'</td>';
															echo '<td>'.$row['CheckInTime'].'</td>';

															if($row['CheckOutTime'] == "00:00:00")
															{
																if(($date_diff != 0) && ($date_diff != "No_diff"))
																{
																	$t = date("H:i:s", strtotime("23:59:59"));;
																	$date2 = new DateTime($t);
																	echo '<td>'.$t.'</td>';

																}
																else
																{
																	date_default_timezone_set("Asia/Kolkata");
																	$t = date('H:i:s');
																	$date2 = new DateTime($t);
																	echo '<td> -- : -- : -- </td>';
																}

															}
															else
															{
																$date2 = new DateTime($row['CheckOutTime']);
																echo '<td>'.$row['CheckOutTime'].'</td>';
															}
															$date1 = new DateTime($row['CheckInTime']);
															$diff=date_diff($date1,$date2);
															$time_diff = $diff->format("%H hour %i minutes");
															if(mb_substr($time_diff, 0, 2) == "00")
															{
																$time_diff = $diff->format("%i minutes");
																echo '<td>'.$time_diff.'</td>';
															}
															else
															{
																	echo '<td>'.$time_diff.'</td>';
															}

															echo '</tr>';

															$x++;
														}

														echo '</table>
														</div>
													</div>
											</div>
										</div>';


					}
					else
					 {

						  echo 'No Data Found for this date.';
							echo '<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="panel panel-teal">

													<div class="panel-body">

													</div>
												</div>
										</div>
									</div>';
					 }
				 }
				 else
				 {
					 $_SESSION['value_date'] = "";
					 $_SESSION['employee_name'] = "";
				 }



			?>





		<div class="row">

			<div class="col-sm-12">
					<p class="back-link">&copy; Vasitars 2019</p>
			</div>
		</div>

	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
    <!-- Switchery -->
    <script src="js/switchery.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="js/custom.min.js"></script>




	<script>

//el = document.querySelectorAll(".close_modal");
//for(var i=0; i < el.length; i++)
//{
//	el[i].onclick = function(){
//		if(document.getElementById("checkbox").checked)
//		{
//			alert(document.getElementById("checkbox").checked);
//			document.getElementById("checkbox").click();
//		}
//	}
//}

//$('.close_modal').on('click', function(e){
//	//alert(document.getElementById("checkbox").checked);
//	if(document.getElementById("check_box").checked)
//	{
//		$('#check_box').removeAttr("checked");
//		document.getElementById('check_box').checked = 0;
//		document.getElementById("check_box").click();
//	}
//});
//

$('select option').filter(function() {
//may want to use $.trim in here
return $(this).text() == <?php echo '"'.$_SESSION['employee_name'].'"'; ?>;
}).prop('selected', true);

$('input[type="checkbox"]').on('change', function(e){
	var NewSession = <?php
						if(isset($_SESSION['NewCheckInSession']) && ($_SESSION['NewCheckInSession'] == 1))
						{
							echo 1;
						}
						else
						{
							echo 0;
						}
					 ?>;
  if(e.target.checked)
	{
				//alert(document.getElementById("check_box").checked);
				//$('#check_box').removeAttr("checked");
				document.getElementById('check_box').checked = false;
				//document.getElementById("check_box").click();
				if(NewSession == 1)
				{
					$('#NewSessionModal').modal();
				}
				else
				{
					$('#myCheckInModal').modal();
				}

	}
	else
	{
		document.getElementById('check_box').checked = true;
		$('#myCheckOutModal').modal();
	}
});
$('#employee_details').addClass("active");
	</script>
</body>
</html>
