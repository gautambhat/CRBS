<?php
	session_start();
	if(isset($_SESSION["Login"]))
		if($_SESSION["Login"] != "YES")
			header('Location: index.php');
	if(!isset($_SESSION["Login"])) 
		header('Location: index.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Rules - ABC Conference Room Booking</title>
		<link rel="stylesheet" type="text/css" href="header.css">
		<link href='http://fonts.googleapis.com/css?family=Wire+One|Plaster' rel='stylesheet' type='text/css'>
			
	</head>
	<style>
		a:visited, a:active, a:link{
		color:#13acd9;
		}
		a:hover{
		color:#13c5ff;}
		



html,
body {
   background:url('xls1.jpg') fixed;
   margin:0;
   padding:0;
   height:100%;
   
}
#container {
   min-height:100%;
    position:relative;
}
#body {
	padding:70px 10px 70px 10px;
	background:white;
	width:800px;

}


div.heading
{
min-width:100px;

color:#111;
padding:5px;
font-size:60px;
font-family:Wire One;}

ol li{
padding:10px;
font-size:18px;
font-family:Amethysta;
color:black;
padding-left:110px;}


	</style>
	<body>
	<div id="container">
		<?php require('header.php');?>
		<center><div id="body">
			<br><br><br>
			<br><div class="heading" align="left">RULES, TERMS & CONDITIONS</div><br><hr><br>
			<ol class="OL">
				<li style="padding-left:10px;" align="left">The conference room may be used only during normal operating hours of the University.</li>
				<br><hr color="#13acd9"><br>
				
				<li style="padding-left:10px;" align="left">Conference rooms may be booked no more than 10 days in advance of the requested date. Rooms will be held only 30 minutes past the reservation time.</li>
				<br><hr color="#13acd9"><br>
				
				<li style="padding-left:10px;" align="left">Reservations are made only through online booking system though users respective login ids and password.</li>
				<br><hr color="#13acd9"><br>
				
				<li style="padding-left:10px;" align="left">No fee is charged or solicited for programs and activities held in the conference room.</li>
				<br><hr color="#13acd9"><br>
				
				<li style="padding-left:10px;" align="left">Use of conference room may not disrupt normal operation of the university. Persons attending the meetings in the conference room are subject to all the rules and regulations of the University.</li>
				<br><hr color="#13acd9"><br>
				
				<li style="padding-left:10px;" align="left">The conference room must be left in a clean and orderly condition. Organizations or individuals holding meetings in the conference room assume all responsibility for damage to university materials and facilities during their meetings.</li>
				<br><hr color="#13acd9"><br>
				
				<li style="padding-left:10px;font-weight:bold;" align="left">No group or individual may affix or attach signs, banners, or flyers to any conference wall, ceiling, or any piece of university property.</li>
				<br><hr color="#13acd9"><br>
				
				<li id="cancelPol" style="padding-left:10px;font-weight:bold" align="left">Cancellation Policy :
					<ul style="font-weight:normal">
						<li style="padding-left:10px;" align="left">Request for cancellation of room at least 2 days prior to due date.</li>
						<li style="padding-left:10px;" align="left">To cancel the room please follow the <a href="profile.php">link</a>.</li>
						<li style="padding-left:10px;" align="left">To cancel the room please send an email to the <a href="contact.php">Admin help desk<a>.</li>
						<li style="padding-left:10px;" align="left">A confirmation will be sent to the client after the cancellation has been done.</li>
					</ul>
				</li>
				<br><br><br>				
			</ol>		
			<hr>
			
		
		
		
		
		</div></center>
		
	</div>
	</body>
</html>