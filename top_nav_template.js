// JavaScript Document

	var item_profile= " Profile ";
	var item_report_problem= " Report A Problem";
	var	item_settings= " Settings";
	var	item_logout= " Log Out";
	
	


function top_nav_template(){
	
	
	document.writeln("<!-- top navigation --><div class=\"top_nav\"><div class=\"nav_menu\"><nav><div class=\"nav toggle\"><a id=\"menu_toggle\"><i class=\"glyphicon glyphicon-list\"></i></a></div><ul class=\"nav navbar-nav navbar-right\"><li class=\"\"><a href=\"javascript:;\" class=\"user-profile dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\"><img src=\"" + item_profile_picture_location + "\" alt=\"...\" >" + name + "<span class=\"caret\"></span></a><ul class=\"dropdown-menu dropdown-usermenu pull-right\"><li class=\"item_top_nav\" id=\"item_profile\"><a href=\"profile.php\">" + item_profile + "</a></li><li class=\"item_top_nav\" id=\"item_settings\"><a href=\"javascript:;\"><span>" + item_settings + "</span></a></li><li class=\"item_top_nav\" id=\"item_report_problem\"><a href=\"Report_Problem.php\">" + item_report_problem + "</a></li><li><a href=\"logout.php\">" + item_logout + "<i class=\"glyphicon glyphicon-log-out alignright\"></i></a></li></ul></li></ul></nav></div></div><!-- /top navigation -->");
}