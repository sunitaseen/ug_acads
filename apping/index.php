<?php
session_start();
if (isset($_SESSION['ldap_id'])){
	$username = $_SESSION['ldap_id'];
}
else {
	$username='';
}
require_once("dbconnect.php");
if(isset($_GET['er']))
{
	if($_GET['er'] == "loginfailed" ) { $error= "Login Failed" ;}
	if($_GET['er'] == "wrong" ) { $error= "Invalid Roll no. or password" ;}
	if($_GET['er'] == "complete" ) { $error= "Voted! " ;}
	
}
if(isset($_GET['logout'])){
	
	session_destroy();
}
//$link = mysql_connect($dbhost, $dbuser, $dbpasswd) or die ("Not able to connect" . mysql_error());
//mysql_select_db($dbname, $link) or die ("Query for database failed : " . mysql_error());
//$time = date("Y-m-d H:i:s");
//echo $time - 30;
//$query = "SELECT * from users number_of_books_donated > 0 and last_donated_at";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/bootstrap.css">

<script type="text/javascript" src="js/jquery-1.3.2.js"></script>

<title>Apping Database | UG Academics</title>
<style>




body{
	background-image:url(img/a.jpg);
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 13px;
  line-height: 18px;
  color: #333333;
  background-color: #ffffff;
}

#outer{
	
	
	

	overflow:hidden;
	
	padding-left:5%;
}
#toppest{
	height:9px;
	background-image:url(img/1.jpg);
	margin:-10px;
	width:100%
}
#topbar{
	padding:2%;
	background-image:url(img/2.png);
	margin-top:9px;
	margin-left:-10px;
	margin-right:-10px;
	width:100%;
}
#main1{
	padding:6%;
	align:center;
	
}
#main{
	height:200px;
	width:60%;
	background-color:#FFF;
	margin:auto;
	align:centre;
	background-image:url(img/back.png);
	overflow:hidden;
	
	
}
#footbar{
	height:180px;
	background-color:#FFF;
	padding-left:5%;
	padding-top:20px;
	padding-bottom:20px;
	padding-right:20px;
	margin:-10px;
	width:100%;
}
#footer{
	height:30px;
	background-image:url(img/4.png);
	margin:-10px;
	padding-top:20px;
	padding-bottom:20px;
	padding-right:20px;
	padding-left:5%;
	width:100%;
	color:#fff;
}
#about{
	font:Georgia, "Times New Roman", Times, serif;
	font-size:16px;
	
	width:40%;
	float:left;
}
#list{
	list-style-type:none;
	font-size:24px;

}
#links{
	width:40%;
	float:right;
}
.listing ul li{
	line-height:2;
}
#login{
	color:#FFF;
	padding:5%;
	width:25%;
	float:left;
	overflow:hidden;
}
#login_about{
	color:#FFF;
	width:50%;
	float:right;
	padding:5%;
	font-size:18px;
	overflow:hidden;
}

</style>
</head>

<body>

<div class="container-fluid">
<div class="row-fuid" id="toppest">

</div>
<div class="row-fluid" id="topbar">
<div class="span11" id="outer">
<!--<h1 id="logo"><a href="#"><img src="img/title1.png" /></a></h1>-->
</div>
</div>
<div id="main1" class="row-fluid">
<div id="main">
<div id="login">
<h3>Login</h3>
<form method="POST" action="login.php">
<input type="text" name="username" placeholder="LDAP ID"/><br />
<input type="password" name="password"  placeholder="Password"/><br />
<?php echo $error?><br/>
<input type="submit" class="button" value="Login" />
</form>
</div>
<div id="login_about">
Login with your LDAP ID
</div>

</div>
</div>



       

      



<div class="row-fluid" id="footbar">
<div class="span5" id="about">

</div>
<div class="listing" id="links">
<a href="http://gymkhana.iitb.ac.in/~ugacademics/"><img src="img/logo.jpg"><span id="qwer">  IIT Bombay UG Academics</span></a>
</div>
</div>
<div class="row-fluid" id="footer">
<span class="span8" >
UG Academic Web Team © 2012. All rights reserved
</span>
</div>
</div>


  
</body>




</html>
