<?php

echo '<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
  <div class="profile-sidebar">
    <div class="profile-userpic">
      <img src="'.profile_picture_location($_SESSION['consumer_id']).'" class="img-responsive" alt="">
    </div>
    <div class="profile-usertitle">
      <div class="profile-usertitle-name">'.$_SESSION["name"].'</div>
      <div class="profile-usertitle-status"><span  class="indicator label-success" ></span> <span id ="aidno"></span></div>



    </div>
    <div class="clear"></div>
  </div>
  <div class="divider"></div>

  <ul class="nav menu">
    <li id="dashboard"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
    <li id="profile"><a href="profile.php"><em class="fa fa-tags">&nbsp;</em> Profile</a></li>
    <li id="attendance"><a href="attendance.php"><em class="fa fa-users">&nbsp;</em> Attendance</a></li>
    <li id="change_password"><a href="changepass.php"><em class="fa fa-key">&nbsp;</em> Change Password</a></li>';
    //<li id="contact"><a href="contact.php"><em class="fa fa-phone">&nbsp;</em> Contact Us</a></li>
    echo '<li id="logout"><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
  </ul>
</div><!--/.sidebar-->';

?>
