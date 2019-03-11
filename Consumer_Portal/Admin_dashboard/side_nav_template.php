<?php

include("connect.php");

$notif_query = mysqli_query($con, "SELECT * FROM notif WHERE MEM_ID = '".$_SESSION['mem_id']."' AND Viewed = '0'");
if(mysqli_num_rows($notif_query) >= 1)
{
  $notif_exists = 1;
}
else
{
  $notif_exists = 0;
}

echo '<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
  <div class="profile-sidebar">
    <div class="profile-userpic">
      <img src="'.profile_picture_location($_SESSION["mem_id"]).'" class="img-responsive" alt="">
    </div>
    <div class="profile-usertitle">
      <div class="profile-usertitle-name">'.$_SESSION["fname"].'</div>
      <div class="profile-usertitle-status"><span  class="indicator label-success" ></span> <span id ="aidno"></span></div>



    </div>
    <div class="clear"></div>
  </div>
  <div class="divider"></div>

  <ul class="nav menu">
    <li id="dashboard"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
    <li id="profile"><a href="profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
    <li id="notifications"><a href="notifications.php"><em class="fa fa-globe">&nbsp;</em> Notifications&nbsp;&nbsp;';
      if($notif_exists == 1)
      {
        echo '<span  class="indicator label-success" id="notif-icon"></span><b><code style="color:#dbecd4; background:#12a131; border:2px;">'.mysqli_num_rows($notif_query).'</code></b>';
      }
    echo '</a></li>
    <li id="attendance"><a href="attendance.php"><em class="fa fa-users">&nbsp;</em> Attendance</a></li>
    <li id="assign_incharge"><a href="assign_incharge.php"><em class="fa fa-users">&nbsp;</em> Assign Incharge</a></li>
    <li id="make_admin"><a href="make_admin.php"><em class="fa fa-user-plus">&nbsp;</em> Make Admin</a></li>
    <li id="request_leave"><a href="request_leave.php"><em class="fa fa-tag">&nbsp;</em> Request a Leave</a></li>
    <li id="employee_details"><a href="employee_details.php"><em class="fa fa-users">&nbsp;</em> Employee Details</a></li>
    <li id="change_password"><a href="changepass.php"><em class="fa fa-key">&nbsp;</em> Change Password</a></li>';
    //<li id="contact"><a href="contact.php"><em class="fa fa-phone">&nbsp;</em> Contact Us</a></li>
    echo '<li id="logout"><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
  </ul>
</div><!--/.sidebar-->';

?>
