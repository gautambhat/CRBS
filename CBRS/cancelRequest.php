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
	a:visited, a:active, a:link{
color:#13acd9;
text-decoration:none;
}
a:hover{
color:#13c5ff;}
	</style>
	
	<body>
		<div style="width:100%;min-width:60em;">
		<div id="ABCConf">
			<span style="padding-left:23px;"><span style="color:#13c5ff;">ABC</span>&nbsp;<span style="color:white">CONFERENCE ROOM BOOKING</span></span>
		</div>
		</div>
		
		<br><br><br><br><br>
		<?php 
		if(isset($_GET['cancelBooking']) && isset($_GET['userId']))
			{
				$checkGenuine = mysql_query("select distinct bdate from booking where bid={$_GET['cancelBooking']} and u_id={$_GET['userId']}")or die(mysql_error());
				if(mysql_num_rows($checkGenuine)==1)
				{
					//echo $diff->format('%a');
					
					$findNextQuery = mysql_query("select bdate, startTime, endTime from booking where bid={$_GET['cancelBooking']}")or die(mysql_error());
						while($findNext = mysql_fetch_array($findNextQuery))
						{
							$DATE = $findNext['bdate'];
							$START = $findNext['startTime'];
							$END = $findNext['endTime'];
						}
						
						mysql_query("delete from booking where bid={$_GET['cancelBooking']}")or die(mysql_error());
						mysql_query("delete from booking_spec where b_id={$_GET['cancelBooking']}")or die(mysql_error());
						
						$getWishlistDetails = mysql_query("select wid,u_id,reqdate,reqfrom,reqto,r_id from wishlist where reqdate='".$DATE."' AND ((reqfrom >= ".$START." AND reqfrom <= ".$END.") OR (reqto >= ".$START." AND reqto <= ".$END.")) order by wishdt LIMIT 0,1");
						if(mysql_num_rows($getWishlistDetails)==1)
						{
							while($wishdetails = mysql_fetch_array($getWishlistDetails))
							{
								$wid1 = $wishdetails['wid'];
								$uid1 = $wishdetails['u_id'];
								$reqdate1 = $wishdetails['reqdate'];
								$reqfrom1 = $wishdetails['reqfrom'];
								$reqto1 = $wishdetails['reqto'];
								$rid1 = $wishdetails['r_id'];	
							}
							mysql_query("insert into booking(r_id,u_id,bdate,startTime,endTime) values(".$rid1.",".$uid1.",'".$reqdate1."',".$reqfrom1.",".$reqto1.")")or die(mysql_error());
							mysql_query("delete from wishlist where wid =".$wid1."")or die(mysql_error());
						}
						echo "<h4>Successfully cancelled booking.</h4>";
					
							
				}
				else echo "<h4>Could not cancel booking.</h4>";
			}
		?>
		<ul>
			<a href="adminHome.php"><li>Admin Home</li></a>
			<a href="adminHome.php?clearWishlist=YES"><li>Clear Old Wishlist</li></a>
			<a href="admin_Bookings.php"><li>View And Manage All Bookings</li></a>
			<a href="logout.php"><li id="logout">Logout</li></a>
		</ul>
		<table border="0" style="margin:1em;" width="auto"><tr><th colspan="5" valign="center" style="font-size:30px;">ALL BOOKINGS</th></tr>
		<tr><th>ROOM</th><th>DATE</th><th>FROM</th><th>TO</th><th>BOOKED BY</th></tr>
		<?php
			$getCancelQuery = mysql_query("select distinct bid, u_id, bdate, startTime, endTime, roomName, username from booking, login, room where rid=r_id and uid=u_id and bid in(select b_id from cancel_request)") or die(mysql_error());
			if(mysql_num_rows($getCancelQuery)==0)
			echo '<tr><td colspan="5">No Requests Available.</td></tr>';
			while($getCancel = mysql_fetch_array($getCancelQuery))
			{
				echo '<tr><td align="center">'.$getCancel['roomName'].'</td><td align="center">'.$getCancel['bdate'].'</td><td style="width:5em;" align="center">'.$getCancel['startTime'].'hrs</td><td align="center">'.$getCancel['endTime'].'hrs</td><td align="center">'.$getCancel['username'].'</td><td align="center"><a class="cancelButton" title="Click here to cancel this booking" href="cancelRequest.php?cancelBooking='.$getCancel['bid'].'&userId='.$getCancel['u_id'].'" onclick="return confirm('."'Are you sure you want to cancel this booking?'".')">Cancel?</a></td></tr>';
			}
		?>
		</table>
		
		
	</body>
</html>