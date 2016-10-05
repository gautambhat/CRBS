<?php
	session_start();
	if(isset($_SESSION["Login"]))
		if($_SESSION["Login"] != "YES")
			header('Location: index.php');
	if(!isset($_SESSION["Login"]))
		header('Location: index.php');
	require 'config.php';
	mysql_connect($configHostName,$configRootName,$configAccessPassword);
	mysql_select_db($configDatabaseName);
?>

<!DOCTYPE html>
</html>
	<head>
		<title>Welcome - ABC Conference Room Booking</title>
		<link rel="stylesheet" type="text/css" href="header.css">
		<link href='http://fonts.googleapis.com/css?family=Wire+One|Plaster' rel='stylesheet' type='text/css'>
		
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	</head>
	<style>
		html,body{
margin:0;
padding:0;
background:url('xls1.jpg') fixed;
font: 18px Cambria;
}

#container{
	width:60em;
	background:white;
	text-align:left;
	
}
a:visited, a:active, a:link{
color:#13acd9;
}
a:hover{
color:#13c5ff;}
h1{
	margin:1em;
	font:25px Cambria;}
font: 5em Wire One;
text-align:center;
text-shadow:0 0 2px #13c5ff;}
input:focus{
outline:#13c5ff solid 1px;}

td,th{
	border-right:1px solid white;
	background:whitesmoke;
	padding:3px 4px 3px 4px;
	}
	</style>
	<body>
		<?php require('header.php');?>
		<center><div id="container"><br><br><br><br><br>
		
		<?php
		
			if(isset($_GET['removeWishlist']))
			{
				$checkGenuine = mysql_query("select distinct u_id from wishlist where wid={$_GET['removeWishlist']} and u_id={$_SESSION['uid']}")or die(mysql_error());
				if(mysql_num_rows($checkGenuine)==1)
				{
					mysql_query("delete from wishlist where wid={$_GET['removeWishlist']}");
					echo "<h4>Successfully removed from wishlist.</h4>";
				}
				else echo "<h4>Could not remove from wishlist.</h4>";
			}
			if(isset($_GET['cancelBooking']))
			{
				$checkGenuine = mysql_query("select distinct bdate from booking where bid={$_GET['cancelBooking']} and u_id={$_SESSION['uid']}")or die(mysql_error());
				if(mysql_num_rows($checkGenuine)==1)
				{
					while($getDate = mysql_fetch_array($checkGenuine))
						$date = date_create($getDate['bdate']);
					$nowQuery = mysql_query("select DATE(NOW()) from dual;")or die(mysql_error());
					while($nowDate = mysql_fetch_array($nowQuery))
						$NOW = date_create($nowDate['DATE(NOW())']);
					
					$diff = date_diff($date,$NOW);
					//echo $diff->format('%a');
					if( $diff->format('%a') >= 7 )
					{
						
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
					else
					{
						$checkSentQuery = mysql_query("select b_id from cancel_request where b_id={$_GET['cancelBooking']}")or die(mysql_error());
						if(mysql_num_rows($checkSentQuery)>0)
							echo "<h4>Cancel request already sent to administrator.</h4>";
						else
						{
							mysql_query("insert into cancel_request values({$_GET['cancelBooking']})")or die(mysql_error());
							echo "<h4>Cancel request has been sent to administrator.</h4>";
						}
					}
							
				}
				else echo "<h4>Could not cancel booking.</h4>";
			}
		
		
		
		
		?>
		
		
		<h1>User : <?php echo $_SESSION['username'];?></h1>
		
		<table border="0" style="margin:1em;" width="auto"><tr><th colspan="4" valign="center" style="font-size:30px;">MY BOOKINGS</th></tr>
		
		<?php
			$getBookingQuery = mysql_query("SELECT distinct bid, bdate, startTime, endTime, roomName from booking, login, room where r_id = rid AND u_id = {$_SESSION['uid']} order by bdate, startTime") or die(mysql_error());
			if(mysql_num_rows($getBookingQuery) > 0)
				echo '<tr><th>DATE</th><th>FROM</th><th>TO</th><th>ROOM</th></tr>';
			else echo '<tr><td colspan="4">No bookings made.</td></tr>';
			while($getBooking = mysql_fetch_array($getBookingQuery))
			{
				echo '<tr><td align="center" >'.$getBooking['bdate'].'</td><td style="width:5em;" align="center">'.$getBooking['startTime'].'hrs</td><td style="width:5em;" align="center">'.$getBooking['endTime'].'hrs</td><td align="center">'.$getBooking['roomName'].'</td><td align="center"><a class="cancelButton" title="Click here to cancel this booking" href="profile.php?cancelBooking='.$getBooking['bid'].'" onclick="return confirm('."'Are you sure you want to cancel this booking?'".')">Cancel?</a></td></tr>';
			}
		?>
		</table>
		<?php
				echo '<table border="0" style="margin:1em;" width="auto"><tr><th colspan="5" valign="center" style="font-size:30px;">MY WISHLIST</th></tr>';
							
				$getWishQuery = mysql_query("SELECT distinct wid, wishdt, reqdate, reqfrom, reqto, roomName from wishlist, room where u_id={$_SESSION['uid']} AND r_id=rid order by wishdt") or die(mysql_error());
				if(mysql_num_rows($getWishQuery) > 0)
					echo '<tr><th>RECORDED AT: </th><th>ROOM: </th><th>DATE: </th><th>FROM: </th><th>TO: </th></tr>';	
				else echo '<tr><td colspan="5">Wishlist Empty.</td></tr>';
				while($getWish = mysql_fetch_array($getWishQuery))
				{
					echo '<tr><td align="center" >'.$getWish['wishdt'].'</td><td align="center" >'.$getWish['roomName'].'</td><td align="center" >'.$getWish['reqdate'].'</td><td align="center" style="width:5em;">'.$getWish['reqfrom'].'hrs</td><td align="center" style="width:5em;">'.$getWish['reqto'].'hrs</td><td align="center" style="width:5em;"><a class="removeButton" title="Click here to remove from wishlist" href="profile.php?removeWishlist='.$getWish['wid'].'" onclick="return confirm('."'Are you sure you want to remove this from wishlist?'".')">Remove?</a></td></tr>';
				}
				
			
			echo '</table><br>';
		?>
		
		</div></center>		
	</body>
</html>