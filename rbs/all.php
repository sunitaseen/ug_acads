<?php
session_start();
if(!session_is_registered('id')){
header("location:login.php");
}
?>

<html>
<head>
<style type="text/css">

body{
	
	background-color:rgb(186,171,106);
	
	}

table{border:none;
   color:rgb(59,82,124);
	border-color:rgb(59,82,124);}

tr{border:solid;

	border-color:rgb(59,82,124);}
	
td{border:solid;
padding:5px;
	border-color:rgb(59,82,124);}
</style>
</head>
<body>

<?php

session_start();
$userid=$_SESSION['id'];

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





$datenow=date('d');
$mnthnow=date('m');
$yrnow=date('Y');
$todayid=(10000*$yrnow)+(100*$mnthnow)+$datenow;
$nowid=(100*$yrnow)+$mnthnow;

$result3=mysql_query("SELECT * FROM adminbookings ORDER BY mydate");
echo "<a href=\"welcome.php\" style=\"text-decoration:underline; cursor:pointer; color:#000000;\"><b><i>Back</i></b></a></br>";
echo "<table id=\"mybookings\" style=\"text-align:right; float:left;\">";
echo "<tr><td><b>Event</b></td><td><b>Venue</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>Duration</b></td><td><b>Registeration done by</b></td></tr>";
while($details=mysql_fetch_array($result3)) {
	if($details['mydate']<$todayid) {
		continue;
		}
		
	else {
	$p=$details['mydate'];
	$p1=$p % 100;
	$temp=($p-$p1)/100 ;
	$p2=$temp % 100;
	$p3=($temp-$p2)/100;
	$t=$details['time'];
	$t2=$t % 100;
	$t1=($t-$t2)/100;		
	$d=$details['duration'];
	$d2=$d % 100;
	$d1=($d-$d2)/100;	
	$z=$details['userid'];
	$result5=mysql_query("SELECT * FROM cred WHERE username='$z' ");
	$result6=mysql_fetch_array($result5);
	$clubnm=$result6['club'];
	echo "<tr><td>".$details['eventname']."</td><td>".$details['room']."</td><td>".$p1."-".$p2."-".$p3."."."</td><td>".$t1.":".$t2."</td><td>".$d1." Hours ".$d2." Minutes</td><td>".$clubnm."</td></tr>";
	}
	}
echo "</table>";


?>

</body>
</html>