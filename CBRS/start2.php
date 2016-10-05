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
		<script>
			$(document).ready(function(){
				$('#dateP').datepicker({ minDate: +6, maxDate: +30, dateFormat: "yy-mm-dd", showAnim: "fadeIn"});
				
				$('#button').click(function(){ 
					if(parseInt($('#fromP').val(),10) >= parseInt($('#toP').val(),10)){
						alert("You cannot set a conference to end before it begins!");
						return false;
					}
					if(parseInt($('#fromP').val(),10)<800 || parseInt($('#fromP').val(),10)>2000 || parseInt($('#toP').val(),10)<900 || parseInt($('#toP').val(),10)>2100)
					{
						alert("Invalid time or date selected!! Please use the provided date and time pickers only.");
						return false;
					}
					});
				
			});
			var image1 = new Image();
			image1.src = "C1.jpg";
			var image2 = new Image();
			image2.src = "C2.jpg";
			var image3 = new Image();
			image3.src = "C3.jpg";
			var image4 = new Image();
			image4.src = "C4.jpg";
		</script>
	</head>
	<style>
		html,body{
margin:0;
padding:0 0 40px 0;
background:url('white.png');

}



a:visited, a:active, a:link{
color:#13acd9;
}
a:hover{
color:#13c5ff;}
h1{
margin:0.6em 0 0.4em 0;
font: 5em Wire One;
text-align:center;
text-shadow:0 0 2px #13c5ff;}
input:focus{
outline:#13c5ff solid 1px;}
	</style>
	<body>
		<?php require('header.php');?>
		<br><br><br><br><br><br><br>
		<div style="overflow:hidden;height:400px;width:700px;box-shadow: 0 0 4em 0.1em #13c5ff; border-radius:3.2em;display:inline-block;float:right;margin-right:4em;margin-top:1.2em;"><img src="C1.jpg" name="slide" style="height:auto;width:800px;box-shadow:0 0 10px 10px white;"></div>
		<script>
			var step = 1;
			function slideit()
			{
				document.images.slide.src=eval("image"+step+".src");
				if (step<4)
					step++;
				else
					step=1;
				//call function "slideit()" every 4.8 seconds
				setTimeout("slideit()",3500)
			}
			slideit();
		</script>
		<h1>Book A Conference!</h1>
		<hr color="#13c5ff" width="360px">
		<center><form id="availForm" action="avail.php" method="post" style="margin-top:40px;">
		<input type="text" name="dateP" id="dateP" placeholder="DATE" required style="margin-right:40px;padding:5px;width:75px;">
		<!--<input id="fromP" type="number" name="fromP" min="0800" max="2000" step="100" placeholder="FROM" required style="padding:5px;">hrs-->
		FROM:<select id="fromP" name="fromP" form="availForm" placeholder="FROM" required style="padding:5px;">
			<option value="800">0800hrs</option>
			<option value="900">0900hrs</option>
			<option value="1000">1000hrs</option>
			<option value="1100">1100hrs</option>
			<option value="1200">1200hrs</option>
			<option value="1300">1300hrs</option>
			<option value="1400">1400hrs</option>
			<option value="1500">1500hrs</option>
			<option value="1600">1600hrs</option>
			<option value="1700">1700hrs</option>
			<option value="1800">1800hrs</option>
			<option value="1900">1900hrs</option>
			<option value="2000">2000hrs</option>
		</select>
		<!--<input id="toP" type="number" name="toP" min="0900" max="2100" step="100" placeholder="TO" required style="padding:5px;">hrs<br>-->
		TO:<select id="toP" name="toP" form="availForm" placeholder="TO" required style="padding:5px;">
			<option value="900">0900hrs</option>
			<option value="1000">1000hrs</option>
			<option value="1100">1100hrs</option>
			<option value="1200">1200hrs</option>
			<option value="1300">1300hrs</option>
			<option value="1400">1400hrs</option>
			<option value="1500">1500hrs</option>
			<option value="1600">1600hrs</option>
			<option value="1700">1700hrs</option>
			<option value="1800">1800hrs</option>
			<option value="1900">1900hrs</option>
			<option value="2000">2000hrs</option>
			<option value="2100">2100hrs</option>
		</select><br>
		<input id="button" type="submit" value="PROCEED" style="cursor:pointer;border-color:#13c5ff;color:#13acd9;padding:5px;margin:30px;">
		</form></center>
	
	</body>
</html>