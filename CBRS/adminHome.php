<?php
	session_start();
	if(isset($_SESSION["Login"]))
		if($_SESSION["Login"] != "YES" || $_SESSION['type']!=0)
			header('Location: index.php');
	if(!isset($_SESSION["Login"])) 
		header('Location: index.php');
	require 'config.php';
	mysql_connect($configHostName,$configRootName,$configAccessPassword);
	mysql_select_db($configDatabaseName);
	if(isset($_GET['clearWishlist']) && $_GET['clearWishlist']=='YES')
		mysql_query("delete from wishlist where DATE(reqdate) <= DATE(NOW())") or die(mysql_error());
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ABC Conference Room Booking</title>
		<!<link rel="stylesheet" type="text/css" href="xls.css">
		<link href='http://fonts.googleapis.com/css?family=Plaster|' rel='stylesheet' type='text/css'>
	</head>
	<style>
	html,body{
margin:0;padding:0;font: 18px Cambria;
}

td,th{
	border-right:1px solid white;
	background:whitesmoke;
	padding:3px 4px 3px 4px;
	}

#ABCConf {
	font: 55px Plaster;
	width: 100%;
	min-width:18em;
	height: 80px;
	padding-top: 20px;
	z-index: 9999;
	position: fixed;
	background: rgba(0,0,0,0.65);
}

a:visited, a:active, a:link{
color:#13acd9;
text-decoration:none;
}
a:hover{
color:#13c5ff;}

h1{
	margin:1em;
	font:25px Cambria;}
ul{
	position:fixed;
	top:5em;
	right:.5em;}
li{
list-style-type:none;
background:#13c5ff;
padding:5px;
margin:2px;
display:block;
color:white;
font: small-caps 25px Calibri;}
li:hover{
background:#13acd9;
color:white;
cursor:pointer;}
a:hover{
	text-decoration:none;
	color:white;}
li a, li a:link, li a:visited{
color:whitesmoke;
text-decoration:none;}
#logout:hover{
background:red;
color:white;
cursor:pointer;
	}
	</style>
	
	<body>
		<div style="width:100%;min-width:60em;">
		<div id="ABCConf">
			<span style="padding-left:23px;"><span style="color:#13c5ff;">ABC</span>&nbsp;<span style="color:white">CONFERENCE ROOM BOOKING</span></span>
		</div>
		</div>
		
		<br><br><br><br>
		<h1>WELCOME, ADMIN!</h1>
		<ul>
			<a href="admin_Bookings.php"><li>View and Manage All Bookings</li></a>
			<a href="adminHome.php?clearWishlist=YES"><li>Clear Old Wishlist</li></a>
			<a href="cancelRequest.php"><li>View Cancellation Requests</li></a>
			<a href="logout.php"><li id="logout">Logout</li></a>
		</ul>
		<table border="0" style="margin:1em;" width="auto"><tr><th colspan="7" valign="center" style="font-size:30px;">RECENT BOOKINGS</th></tr>
		<tr><th>DATE</th><th>FROM</th><th>TO</th><th>BOOKED BY</th><th>ROOM</th></tr>
		<?php
			$getBookingQuery = mysql_query("SELECT bdate, startTime, endTime, username, roomName from booking, login, room where r_id = rid AND u_id = uid order by bdate, startTime LIMIT 0,10") or die(mysql_error());
			while($getBooking = mysql_fetch_array($getBookingQuery))
			{
				echo '<tr><td align="center" >'.$getBooking['bdate'].'</td><td style="width:5em;" align="center">'.$getBooking['startTime'].'hrs</td><td style="width:5em;" align="center">'.$getBooking['endTime'].'hrs</td><td align="center">'.$getBooking['username'].'</td><td align="center">'.$getBooking['roomName'].'</td></tr>';
			}
		?>
		</table>
		<?php
			echo '<table border="0" style="margin:1em;" width="auto"><tr><th colspan="7" valign="center" style="font-size:30px;">WISHLIST</th></tr>';
			$getRoomName = mysql_query("select distinct roomName from room order by rid") or die(mysql_error());
			$I = 1;
			while($RoomName=mysql_fetch_array($getRoomName))
			{
				$Room[$I] = $RoomName['roomName'];
				$I = $I + 1;
			}
			$i = 1;
			while($i<=3)
			{
				echo '<tr><td style="background:#13c5ff;color:whitesmoke;font:small-caps 23px Cambria;"colspan="7" align="center">'.$Room[$i].'</td></tr>';
				echo '<tr><th>RECORDED AT: </th><th>NAME: </th><th>DATE: </th><th>FROM: </th><th>TO: </th><th>CONTACT: </th><th>EMAIL: </th></tr>';				
				$getWishQuery = mysql_query("SELECT name, contact, email, wishdt, reqdate, reqfrom, reqto, roomName from wishlist, room where r_id=".$i." AND r_id=rid order by wishdt") or die(mysql_error());
				while($getWish = mysql_fetch_array($getWishQuery))
				{
					echo '<tr><td align="center" >'.$getWish['wishdt'].'</td><td align="center" >'.$getWish['name'].'</td><td align="center" >'.$getWish['reqdate'].'</td><td align="center" style="width:5em;">'.$getWish['reqfrom'].'hrs</td><td align="center" style="width:5em;">'.$getWish['reqto'].'hrs</td><td align="center" >'.$getWish['contact'].'</td><td align="center" >'.$getWish['email'].'</td></tr>';
				}
				
				$i = $i + 1;
			}
			echo '</table><br>';
		?>
		
		
	</body>
</html>