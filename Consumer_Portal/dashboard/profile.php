<?php
ob_start();
session_start();
include("connect.php");
include("function.php");

if(!logged_in())
{
	header("../login.php");
	echo  "<script type='text/javascript'>window.location = '../login.php';</script>";
}
else
{
	$query = mysqli_query($con, "SELECT * FROM CONSUMER where CONSUMER_EMAIL = '".$_SESSION['LOGIN_EMAIL']."'") ;
	$retrieve_result = mysqli_fetch_assoc($query) ;


	if(!empty($retrieve_result['CONSUMER_EMAIL']))
	{

			$_SESSION['name']= $retrieve_result['NAME'];
			$_SESSION['mobno']= $retrieve_result['PHONE_NUMBER'];
			$consumer_id = $retrieve_result['CONSUMER_ID'];

			$NAME = $retrieve_result["NAME"];
			$CONSUMER_ID = $retrieve_result['CONSUMER_ID'];
			$EMAIL = $retrieve_result['CONSUMER_EMAIL'];
			$DOB = $retrieve_result['DATE_OF_BIRTH'];
			$PHONE_NUMBER = $retrieve_result['PHONE_NUMBER'];
			$AADHAAR_NUMBER = $retrieve_result['AADHAAR_NUMBER'];
			$CITY = $retrieve_result['CITY'];
			$STATE = $retrieve_result['STATE'];
			$COMPLETE_ADDRESS = $retrieve_result['COMPLETE_ADDRESS'];
			$RETAILER_ID = $retrieve_result['RETAILER_ID'];
			$PIN = $retrieve_result['PIN'];
			$CONSUMER_LOGIN_USERNAME = $retrieve_result['CONSUMER_LOGIN_USERNAME'];

		 $profile_picture_location = profile_picture_location($consumer_id);
		 //$_SESSION['college']= $row['college']  ;

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
	<title>Consumer Profile | Vasitars</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
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
				<li><a href="index.php">
					<em class="fa fa-home"></em>
			  </a></li>
				<li class="active">Profile</li>
			</ol>
		</div><!--/.row-->

		<br>
		<div class="row">
			<div class="col-lg-12">
				<form role="form" action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="panel panel-teal">

						<div class="panel-body">

							<div class="row">
								<div class="col-md-4">
									<img src="<?php echo profile_picture_location($_SESSION['consumer_id']) ?>" class="img-responsive thumbnail" alt="" style="height:200px; width:200px; margin-left:20px;">
								</div>
								<div class="col-md-8">
									<label> Name : </label>
									<?php echo $_SESSION['name'] ?>
									<br><br>

									<label> Phone Number : </label>
									<?php echo $_SESSION['mobno']; ?>
									<br><br>

									<label> Consumer Id : </label>
									<?php echo $CONSUMER_ID; ?>
<br><br>


									<label> Date of Birth : </label>
									<?php echo $DOB; ?>
									<br><br>


									<label> Aadhaar Number : </label>
									<?php echo $AADHAAR_NUMBER; ?>
									<br><br>


									<label> CITY : </label>
									<?php echo $CITY; ?>
									<br><br>


									<label>STATE : </label>
									<?php echo $STATE; ?>
									<br><br>


									<label> RETAILER ID : </label>
									<?php echo $RETAILER_ID; ?>
									<br><br>


									<label> User Name : </label>
									<?php echo $CONSUMER_LOGIN_USERNAME; ?>
									<br><br>


							</div><!-- row -->
						</div><!-- panel-body -->
					</div><!-- panel-teal -->
					</form>

				</div><!-- col-lg-12 -->
		</div><!--/.row-->



		<div class="row">

			<div class="col-sm-12">
					<p class="back-link">© Vasitars 2019</p>
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
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};

$('#profile').addClass("active");
	</script>

</body>
</html>
