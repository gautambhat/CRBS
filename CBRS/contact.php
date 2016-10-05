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
		<title>Contact Us - ABC Conference Room Booking</title>
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
			<br>
			<br><br><br><div class="heading" align="left">CONTACT US</div><br><hr><br>
			<p style="padding-left:10px" align="left">Our meeting facilities provide an ideal set-up supporting a range of conference room facilities perfect meetings, in person meetings/interviews or official gatherings. Equipped with advanced communications infrastructure, CBS packages provide an ideal solution for your meeting and conferencing needs. Whether you're meeting with fellow mates, giving a presentation or catching up with colleagues, we have a flexible meeting space to suit.</p>
			<br><br>
			<p style="padding-left:10px;font-size:23px;" align="left">ADDRESS : Shiv Nadar University, UP-203207</p>
			<p style="padding-left:10px;font-size:23px;" align="left">E-MAIL : cbs.admin@snu.edu.in</p>			
			<br><br><hr><br><br>
			
		
		
		
		
		</div></center>
		
	</div>
	</body>
</html>