// JavaScript Document

	var	title= "PRAJJWALA";
	var item1= " Home ";
	var item2= " Register New Customer";
	var	item3= " LPG Recharge";
	var	item4= " Gas Usage Enquiry";
	var item6= " Log Out";
	var item8= " Account Settings";
	var	item7= " Report Problem";
	var randomnumber = Math.random();
	


function createtemplate1(){
	
	
	document.writeln("<nav class=\"navbar navbar-inverse\" id=\"nav\" style=\"color:#666;\"  data-offset-top=\"0px\" style=\" border-radius:0px; background-color:#666;\"><div class=\"container-fluid page-nav-wrapper\" style=\"color:#666;\"><div class=\"navbar-header\" style=\"color:#666;\"><button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\"><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span></button><a class=\"navbar-brand\" class=\"active\" style=\"color:#fff\"><img class=\"img-responsive\" src=\"assets/images/Prajjwala_logo.png\" style=\"width:70px; margin-top:-10px; color:#fff; -webkit-user-select:none; height:50px; float:left;\" >"+ title + "</a></div><div class=\"collapse navbar-collapse\" id=\"myNavbar\"><ul class=\"nav navbar-nav\"><li  class=\"navlist\"><a href=\"Register_New_Customer.php\" style=\"color:#fff;\"><i class=\"glyphicon glyphicon-education\"></i>"+ item2 + "</a></li><li class=\"navlist\"><a href=\"#\" style=\"color:#fff;\" class=\" \">" + item3 + "</a></li><li class=\"navlist\"><a href=\"#\" style=\"color:#fff;\"><i class=\"glyphicon glyphicon-globe\"></i>" + item4 + "</a></li></ul>");
}
function createtemplate2(){
	document.writeln("<ul class=\"nav navbar-nav navbar-right\"><li class=\"navlist dropdown dropdown2\" id=\"span1\" ><a title=\"" + item6 + "\" href=\"home.php?r=" + randomnumber + "\" style=\"color:#fff;\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-delay=\"0\" data-close-others=\"false\"><span style=\"vertical-align:middle;\" >" + item5 + "</span><span class=\"caret\"></span></a><ul class=\"dropdown-menu dropdown-menu2\" role=\"presentation\"><li class=\"navlist-inner navlist2-inner\"><a href=\"#\" class=\"dropdown-menu2-item1\"><i class=\"glyphicon glyphicon-user\"></i> My Profile</a></li><li class=\"navlist-inner navlist2-inner\"><a href=\"#\" class=\"dropdown-menu2-item2\"><i class=\"glyphicon glyphicon-cog\"></i>" + item8 + "</a></li><li class=\"navlist-inner navlist2-inner\"><a href=\"logout.php?r=" + randomnumber + "\" class=\"dropdown-menu2-item3\"><i class=\"glyphicon glyphicon-log-out\"></i>" + item6 + "</a></li></ul></li><li class=\"navlist\" id=\"span2\"><a href=\"?r= " + randomnumber + "\" style=\"color:#fff;\"><span>" + item7 + "</span></a></li></ul></div></div></nav>");


}
function createtemplate()
{
	createtemplate1();
	createtemplate2();
}