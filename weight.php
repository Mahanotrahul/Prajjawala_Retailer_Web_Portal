

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Uploading Data</title>

<script type="application/javascript">


function foo()
{
  var bar = getParam("weight");
  return bar;
}

function getParam ( sname )
{
  var params = location.search.substr(location.search.indexOf("?")+1);
  var sval = "";
  params = params.split("&");
    // split param and value into individual pieces
    for (var i=0; i<params.length; i++)
       {
         temp = params[i].split("=");
         if ( [temp[0]] == sname ) { sval = temp[1]; }
       }
  return sval;
}


document.cookie = "weight=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
document.cookie = "weight  =" +  foo();
</script>


</head>

<body>
<input type="number" placeholder="weight" value="" name="weight" class="weight" id="weight" />


</body>


<script>
var valueadder = document.getElementById("weight");
valueadder.value = foo();
</script>



<?php
ob_start();
$weight = $_REQUEST['weight'];

$con=mysqli_connect("localhost","u402156879_lpg","16EC01045_Vasi","u402156879_lpg");

if(mysqli_connect_errno())
{
	echo "Error occured when coonection with database";
}

else
{

		
		if(isset($_POST['submit']) || !isset($_POST['submit']) )
		{
			echo "Uploading Data";
			
			
			
			
		
			$query = "INSERT INTO sensors(weight) VALUES('$weight')";
			echo "Uploading Data-1";
			
			if(mysqli_query($con,$query))
			{
				clearstatcache();
				echo "Successfull";
			}
				
			
		}
}
ob_end_flush();

?>
</html>