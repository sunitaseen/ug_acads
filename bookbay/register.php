<?php
session_start();
if (!(isset($_SESSION['ldap_id']))){
	header("location: index.php");
}
require_once("functions.php");
if (isset($_POST['register']))
{
	//$username=$info[0]['uid'][0];
	$username= $_SESSION['ldap_id'];//$_POST['username'];
	//$_SESSION['ldap_id']= $username;
	
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$alt_email = $_POST['altemail'];
	$department = $_POST['department'];
	print_r($department);
	$year_of_study = $_POST['year'];
	$mobile = $_POST['mobile'];
	$hostel = $_POST['hostel'];
	$room = $_POST['room'];
	if (!(is_registered($username)))
	{
		register_user($username,$fullname,$department,$email,$alt_email,$year_of_study,$mobile,$hostel,$room);
	}
	else 
	{
		
	}
	
}

else{
$info = ldap_find_all('uid',$_SESSION['ldap_id']);
//print_r($info);
$fullname = $info[0]["cn"][0];
$username=$info[0]['uid'][0];
$dep = explode(",",$info[0]["dn"]);
$alldepartment = explode("=",$dep[2]);
$mydepartment=$alldepartment[1];
$alldepartments =  DepartmentFindAll();
$email=$info[0]["mail"][0];
$alternate_email=$info[0]['mailforwardingaddress'][0];
$year = explode('/',$info[0]["mailmessagestore"][0]);
$year_of_study=2012-$year[2];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/bootstrap.css">
<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
<title>bookBay</title>
<style>

.scroll{
            width:133px;
            height:61px;
            position:fixed;
            bottom:15px;
            left:150px;
            background:#fff url(scroll.png) no-repeat top left;
        }
 .header
        {
            width:600px;
            height:56px;
            position:absolute;
            top:0px;
            left:25%;
            background:#fff url(title.png) no-repeat top left;
        }
        a.back{
            width:256px;
            height:73px;
            position:fixed;
            bottom:15px;
            right:15px;
            background:#fff url(codrops_back.png) no-repeat top left;
        }
		
		
		ul#navigation {
    position: fixed;
    margin: 0px;
    padding: 0px;
    top: 10px;
    left: 0px;
    list-style: none;
    z-index:9999;
}
ul#navigation li {
    width: 100px;
}
ul#navigation li a {
    display: block;
    margin-left: -2px;
    width: 100px;
    height: 70px;    
    background-color:#CFCFCF;
    background-repeat:no-repeat;
    background-position:center center;
    border:1px solid #AFAFAF;
    -moz-border-radius:0px 10px 10px 0px;
    -webkit-border-bottom-right-radius: 10px;
    -webkit-border-top-right-radius: 10px;
    -khtml-border-bottom-right-radius: 10px;
    -khtml-border-top-right-radius: 10px;
    /*-moz-box-shadow: 0px 4px 3px #000;
    -webkit-box-shadow: 0px 4px 3px #000;
    */
    opacity: 0.6;
    filter:progid:DXImageTransform.Microsoft.Alpha(opacity=60);
}
ul#navigation .home a{
    background-image: url(img/home.png);
}
ul#navigation .add a      {
    background-image: url(img/add.png);
}
ul#navigation .search a      {
    background-image: url(img/search.png);
}
ul#navigation .contactus a      {
    background-image: url(img/contactus.png);
}
ul#navigation .logout a   {
    background-image: url(img/logout.png);
}





body{
	background-image:url(img/back.png);
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
	height:550px;
	width:75%;
	background-color:#FFF;
	margin:auto;
	padding:6%;
	font-size:36px;
	line-height:100px;
	
}
#footbar{
	height:230px;
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
.button{
font-size:36px;
line-height:50px;
}
</style>
</head>

<body>

<div class="container-fluid">
<div class="row-fuid" id="toppest">

</div>
<div class="row-fluid" id="topbar">
<div class="span11" id="outer">
<h1 id="logo"><a href="#"><img src="img/title1.png" /></a></h1>
</div>
</div>
<div id="main1" class="row-fluid">
<div id="main" class="span10">

	<form method="POST" action="register.php" >
		
Username : <input type="text" name="username" value='<?php echo $username;?>' disabled='true'/><br />
Name: <input type="text" name="fullname" value='<?php echo $fullname;?>' /><br />
EMail : <input type="text" name="email" value ='<?php echo $email;?>' /><br />
Alt EMail : <input type="text" name="altemail" value ='<?php echo $alternate_email;?>' /><br />
Year : <input type="text" name="year" value ='<?php echo $year_of_study;?>' /><br />
Hostel : <select name='hostel'>
<option value='H'>H1</option>
<option value='H'>H2</option>
<option value='H'>H3</option>
<option value='H'>H4</option>
<option value='H'>H5</option>
<option value='H'>H6</option>
<option value='H'>H7</option>
<option value='H'>H8</option>
<option value='H'>H9</option>
<option value='H'>H10</option>
<option value='H'>H11</option>
<option value='H'>H12</option>
<option value='H'>H13</option>
<option value='H'>H14</option>
<option value='H'>Tansa</option>

</select><br/>
Room <input type='text' name='room'/><br/>
Mobile <input type='text' name ="mobile">

Department : <select name="department">
<?php 

foreach ($alldepartments as $key=>$value){
	if ($value['value']!=$mydepartment){
		
	echo "<option value='" . $value['value']. "'>".$value['department']."</option>";
	}
	else {
		echo "<option value='" . $value['value']. "' selected='selected'>".$value['department']."</option>";}
	
		
}

?>

</select>

<input type="submit" class="button" name='register' value="Register" />
</form>
</div>

</div>

 <ul id="navigation">
            <li class="home"><a href="#" title="Home"></a></li>
            <li class="add"><a href="" title="Add"></a></li>
            <li class="search"><a href="" title="Search"></a></li>
            <li class="contactus"><a href="" title="Contact Us"></a></li>
            <li class="logout"><a href="" title="Log Out"></a></li>
        
        </ul>

       

      



<div class="row-fluid" id="footbar">
<div class="span5" id="about">
<h3>About bookBay</h3>
Buy and sell your old books online with bookBay. You can search the books according to semester as well acording to the Book Titles as well.
</div>
<div class="listing" id="links">
<ul id="list">
<li>
<a href="" title="">Home</a>
</li>

<li>
<a href="" title="" >Contact Us</a>
</li>

<li>
<a href="" title="" >Log Out</a>
</div>
</div>
<div class="row-fluid" id="footer">
<span class="span8" >
bookBay © 2012. All rights reserved
</span>
</div>
</div>


  <script type="text/javascript">
            $(function() {
                $('#navigation a').stop().animate({'marginLeft':'-85px'},1000);

                $('#navigation > li').hover(
                    function () {
                        $('a',$(this)).stop().animate({'marginLeft':'-2px'},200);
                    },
                    function () {
                        $('a',$(this)).stop().animate({'marginLeft':'-85px'},200);
                    }
                );
            });
        </script>
</body>




</html>
