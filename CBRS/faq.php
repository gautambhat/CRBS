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
		<title>Frequently Asked Questions - ABC Conference Room Booking</title>
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



.UL{
list-style:none;
}
.Q,.A{
font-size:18px;
padding:5px;
    text-indent: -1.76em;}
.Q:before{
color:#13acd9;
font:bold 18px serif;
 content: "Q. ";
    padding-right: 5px;}
	.A:before{
 content: "A. ";
 font:bold 18px serif;
 color:black;
    padding-right: 5px;}

	</style>
	<body>
	<div id="container">
		<?php require('header.php');?>
		<center><div id="body">
			<br><br><br>
			<br><div class="heading" align="left">FREQUENTLY ASKED QUESTIONS</div><br><hr><br>
			<ul class="UL" style="text-align:left;">
				<li class="Q" style="padding-left:10px;" align="left">What are the meeting facilities available for booking?</li>
				<li class="A" style="padding-left:10px;" align="left">There are a total of 3 meetings rooms, each with capacities of 100, 200 and 500 respectively. The system is flexible to accommodate required equipment requirement and room layout.</li>
				<br><hr color="#13acd9"><br>
				
				<li class="Q" style="padding-left:10px;" align="left">How do I make a booking?</li>
				<li class="A" style="padding-left:10px;" align="left">Please login to <a href="https://10.6.1.47/re">https://10.6.1.47/re</a> to make a booking. Please enter your login id and password and proceed to booking.</li>
				<br><hr color="#13acd9"><br>
				
				<li class="Q" style="padding-left:10px;" align="left">Is there anyone to help me with the equipment for my event?</li>
				<li class="A" style="padding-left:10px;" align="left">For all bookings, specialist will be present before the start of the event to set up the equipment as selected at the time of booking.</li>
				<br><hr color="#13acd9"><br>
				
				<li class="Q" style="padding-left:10px;" align="left">How do I know if my booking has been approved?</li>
				<li class="A" style="padding-left:10px;" align="left">A confirmation mail will be sent to your login id along with your booking details.</li>
				<br><hr color="#13acd9"><br>
				
				<li class="Q" style="padding-left:10px;" align="left">How far in advance may I reserve a room for a onetime event?</li>
				<li class="A" style="padding-left:10px;" align="left">Groups may reserve a Meeting Room up to one week in advance of the event.</li>
				<br><hr color="#13acd9"><br>
				
				<li class="Q" style="padding-left:10px;" align="left">What are the options for how the tables and chairs are arranged?</li>
				<li class="A" style="padding-left:10px;" align="left">There are standard setups for each room. Typically the standard set up must be used to allow more flexibility for other groups using the rooms during the same day. However, you can choose a desired room layout when you are making your room reservation.</li>
				<br><hr color="#13acd9"><br>
				
				<li class="Q" style="padding-left:10px;" align="left">What do I do in case I encounter any problem during my event?</li>
				<li class="A" style="padding-left:10px;" align="left">We aim to offer the best service available to everyone who enjoys and uses the venue. If, however, you do encounter a problem please <a href="contact.php">contact</a> Admin Help desk.</li>
				<br><hr color="#13acd9"><br>
				
				<li class="Q" style="padding-left:10px;" align="left">What if I need a room with capacity greater than 500?</li>
				<li class="A" style="padding-left:10px;" align="left">Due to lack of infrastructure the room availability is restricted.</li>
				<br><hr color="#13acd9"><br>
				
				<li class="Q" style="padding-left:10px;" align="left">What are other alternatives if the room is not available?</li>
				<li class="A" style="padding-left:10px;" align="left">The room might not be available due to prior bookings. Users are provided with a discussion page where they can freely discuss and check for availability if anybody is ready to swap the room.
				<br>You can also add the room to your wishlist. As and when the room is available, an alert (via email) will be sent and you can proceed to booking.</li>
				<br><hr color="#13acd9"><br>
				
				<li class="Q" style="padding-left:10px;" align="left">How can I cancel my room booking?</li>
				<li class="A" style="padding-left:10px;" align="left">For all cancellations please inform 3 days prior to the booked date so that the room will be made available to others. Make sure you read our <a href="rules.php#cancelPol" target="_blank">Cancellation Policy</a>.</li>
				<br><hr color="#13acd9"><br>
				
				<li class="Q" style="padding-left:10px;" align="left">Is there a facility for refreshments?</li>
				<li class="A" style="padding-left:10px;" align="left">Yes there is a facility. You can choose it as an option while booking your room.</li>
				<br><br><br>
			</ul>		
			<hr>
			
		
		
		
		
		</div></center>
		
	</div>
	</body>
</html>