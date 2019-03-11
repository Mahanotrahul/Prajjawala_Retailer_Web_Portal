// JavaScript Document

// JavaScript Document

	var	title= "PRAJJAWALA";
	var item_home= " Home ";
	var item_new_customer= " Register New Customer";
	var	item_lpg_recharge= " LPG Recharge";
	var	item_gas_usage_enquiry= " Gas Usage Enquiry";
	var item_log_out= " Log Out";
	var welcome = " Welcome";
	var randomnumber = Math.random();
	


function createtemplate1(){
	document.writeln("<div class=\"col-md-3 left_col\" style=\"background-color:#066\"><div class=\"left_col scroll-view\" style=\"background-color:#066\"><div class=\"navbar nav_title\" style=\"border: 0; background-color:#066\"><a href=\"index.html\" class=\"site_title\" ><img src=\"assets/images/Prajjwala_logo.png\" width=\"70px\" height=\"70px;\" style=\"margin-left:-20px;\"><span>"+ title + "</span></a></div><div class=\"clearfix\"></div><!-- menu profile quick info --><div class=\"profile clearfix\"><div class=\"profile_pic\"><img src=\"" + item_profile_picture_location + "\" alt=\"...\" class=\"img-circle profile_img\"></div><div class=\"profile_info\"><span>" + welcome + "</span><h2>" + name + "</h2></div></div><!-- /menu profile quick info --><br /><!-- sidebar menu --><div id=\"sidebar-menu\" class=\"main_menu_side hidden-print main_menu\"><div class=\"menu_section\"><ul class=\"nav side-menu\"><li id=\"item_home\" class=\"item_home\"><a href=\"home.php\"><i class=\"glyphicon glyphicon-home\"></i>"+ item_home + "</a></li><li id=\"item_new_customer\" class=\"item_new_customer\"><a href=\"Register_New_Customer.php\"><i class=\"glyphicon glyphicon-edit\"></i>" + item_new_customer + "</a></li><li clas=\"item_lpg_recharge\"><a><i class=\"glyphicon glyphicon-credit-card\"></i>" + item_lpg_recharge + "</a></li><li class=\"item_gas_usage_enquiry\" id=\"item_gas_usage_enquiry\"><a href=\"Customer_Usage_Enquiry.php\"><i class=\"glyphicon glyphicon-calendar\"></i>" + item_gas_usage_enquiry + "</a></li></ul></div></div><!-- /sidebar menu --><!-- /menu footer buttons --><div class=\"sidebar-footer hidden-small\" style=\" background-color:#066\"><a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Settings\"><span class=\"glyphicon glyphicon-cog\" aria-hidden=\"true\"></span></a><a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Refresh\"><span class=\"glyphicon glyphicon-refresh\" aria-hidden=\"true\"></span></a><a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Search\"><span class=\"glyphicon glyphicon-search\" aria-hidden=\"true\"></span></a><a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Logout\" href=\"logout.php\"><span class=\"glyphicon glyphicon-off\" aria-hidden=\"true\"></span></a></div><!-- /menu footer buttons --></div></div>");
}

function createtemplate()
{
	createtemplate1();
}