<html>
<?php
if($_POST['username']!=NULL && $_POST['password']!=NULL)
{
$us = $_POST['username'];
$pa = $_POST['password'];


/*if(!$_POST['passsword']=='')
{
$pa = $_POST['passsword'];
}
*/


$host = "localhost";
$user = "root";
$pass = "RectumSempra";
$db = "test";
$r = mysql_connect($host, $user, $pass);

if (!$r)
{
echo "Could not connect to server</br>";
trigger_error(mysql_error(), E_USER_ERROR);
}

	mysql_select_db($db) or die(mysql_error());


//to avoid sql injection
$us=stripslashes($us);
$pa=stripslashes($pa);
$us=mysql_real_escape_string($us);
$pa=mysql_real_escape_string($pa);

	
$result=mysql_query("SELECT * FROM cred WHERE username='$us' AND password='$pa'") or die("Please enter the username correctly");
//if(mysql_num_rows($result)==1){
	
/*session_regenerate_id();
 $_SESSION['SESS_MEMBER_ID'] = $['member_id'];
	
	
header("location: welcome.php");

}*/

$count=mysql_fetch_array($result);
$temp = $count['password'];

if(strcmp($temp, $pa)==0){
session_start();
$_SESSION['id']=$count['username'];

header("location: welcome.php");
echo "flag";}

else {
echo "<div style=\"margin-left:auto; margin-right:auto; text-align:center;\"></br></br>Wrong Username or Password ! </div>";
}	
} 

else {
	echo "<div style=\"margin-left:auto; margin-right:auto; text-align:center;\"></br></br>Please enter username and password both !</div> ";
	}

?>
<div style="margin-left:auto; margin-right:auto; text-align:center;"><b><a href="rbs.php" >Back</a></b></div>

</html>