// JavaScript Document

	var	title= "Prajjwala";
	var item1= "Home";
	var item2= "Register New Customer";
	var	item3= "LPG Recharge ";
	var	item4= "Usage Enquiry";
	var item5= "Report Problem";
	var	item6= " Log In";
	var randomnumber = Math.random();
	


function createtemplate1(){
	
	
	document.writeln("<nav class=\"navbar navbar-inverse\" id=\"nav\" style=\" border-radius:0px;\"><div class=\"container-fluid\"><div class=\"navbar-header\"><button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\"><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span></button><a class=\"navbar-brand\" class=\"active\" style=\"color:#fff\"><img class=\"img-responsive\" src=\"assets/images/Prajjwala_logo.png\" style=\"width:40px; height:30px;  -webkit-user-select:none; float:left;\" >"+ title + "</a></div><div class=\"collapse navbar-collapse\" id=\"myNavbar\"><ul class=\"nav navbar-nav\"><li class=\"navlist\" id=\"home\" ><a href=\"index.php?r=" + randomnumber + "\" class=\"ahome\" id=\"a-home\"  style=\"color:#fff\"><i class=\"glyphicon glyphicon-home\"></i>"+ item1 + "</a></li><li class=\"navlist dropdown dropdown1\"><a class=\"dropdown-toggle\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-delay=\"0\" data-close-others=\"false\" href=\"#\" style=\"color:#fff;\"><i class=\"glyphicon glyphicon-education\"></i>"+ item2 + "<span class=\"caret\"></span></a><ul class=\"dropdown-menu dropdown-menu1\" role=\"presentation\"><li class=\"navlist-inner navlist1-inner\" id=\"li_dropdown-menu1-item1\"><a href=\"astronomy.php\" class=\" dropdown-menu1-item1 \" >Astronomy</a></li><li class=\"navlist-inner navlist1-inner\" id=\"li_dropdown-menu1-item2\"><a href=\"#\" class=\"dropdown-menu1-item2\" >Stars</a></li><li class=\"navlist-inner navlist1-inner\" id=\"li_dropdown-menu1-item3\"><a href=\"#\" class=\"dropdown-menu1-item3\">Galaxies</a></li></ul></li><li class=\"navlist\"><a href=\"#\" style=\"color:#fff;\" class=\" \">" + item3 + "</a></li><li class=\"navlist\"><a href=\"#\" style=\"color:#fff;\"><i class=\"glyphicon glyphicon-globe\"></i>" + item4 + "</a></li></ul>");
}
function createtemplate2(){
	document.writeln("<ul class=\"nav navbar-nav navbar-right\" ><li class=\"navlist\" id=\"span1\"><a href=\"sign-up.php?t= " + randomnumber + "\" style=\"color:#fff;\"><i class=\"glyphicon glyphicon-user\"></i><span>" + item5 + "</span></a></li><li class=\"navlist\" id=\"span2\"><a href=\"login.php?v=" + randomnumber + "\" style=\"color:#fff;\"><i class=\"glyphicon glyphicon-log-in\"></i><span>" + item6 + "</span></a></li></ul></div></div></nav>");


}
function createtemplate()
{
	createtemplate1();
	createtemplate2();
}