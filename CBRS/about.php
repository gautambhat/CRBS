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
		<title>About Us - ABC Conference Room Booking</title>
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

p{
font-size:18px;
font-family:Amethysta;
color:black;
padding-left:120px;}
.LI{
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
			<br><div class="heading" align="left">ABC CONFERENCE ROOM BOOKING</div><br><hr><br>
			<p style="padding-left:10px;" align="left">The CRBS is designed for conference room booking at Shiv Nadar University. The system comes as an easy to use application to book conference rooms out of the available conference rooms and to maintain reservations in the database.</p>

			<p style="padding-left:10px;" align="left">CRBS provides personalized tailor made comprehensive workspace solutions at Shiv Nadar University and we are always committed to exceeding our clients’ needs and expectations.</p>

			<p style="padding-left:10px;" align="left">We provide the highest quality of on-demand meeting facilities . We are dedicated to serve the interests of our university students, faculty and administration with the most customized and user-friendly conference room booking system.</p>
			
			<p style="padding-left:10px;" align="left">We will provide you with outstanding rooms, services and event management. While anyone may <em>request</em> space, the CRBS is a "faculty first" operation during the academic year and our primary focus is on student/faculty group space use.</p>
			
			<p style="padding-left:10px;" align="left">The signage of the system helps the user to visualize and to have a look and feel of the conference rooms. The system provides all the information, room layouts, catering and security options for effective scheduling of rooms.</p>
			
			<p style="padding-left:10px;" align="left">Our facilities include:</p>
			<ul style="text-align:left;">
			<li class="LI" style="padding-left:10px;" align="left">Meeting rooms fully equipped with superior audio, digital projectors, LCD screens, smart screens and complimentary stationery.</li>
			<li class="LI" style="padding-left:10px;" align="left">In-house white glove services for your guests</li>
			<li class="LI" style="padding-left:10px;" align="left">High-speed Internet with Wi-Fi connectivity</li>
			<li class="LI" style="padding-left:10px;" align="left">Total support from competent and committed administrative and technical staff</li>
			<li class="LI" style="padding-left:10px;" align="left">Catering and in-house hospitality service</li>
			</ul>
			<br><br><hr>
			
		
		
		
		
		</div></center>
		
	</div>
	</body>
</html>