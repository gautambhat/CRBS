<?php
	session_start();
	if(isset($_SESSION["Login"]))
		if($_SESSION["Login"] != "YES")
			header('Location: index.php');
	if(!isset($_SESSION["Login"])) 
		header('Location: index.php');
	if(!(isset($_POST['dateP']) && isset($_POST['toP']) && isset($_POST['fromP']) && isset($_POST['roomId'])))
		header('Location: start.php');
	
	require 'config.php';
	mysql_connect($configHostName,$configRootName,$configAccessPassword);
	mysql_select_db($configDatabaseName);
?>

<!DOCTYPE html>
</html>
	<head>
		<title> - ABC Conference Room Booking</title>
		<link rel="stylesheet" type="text/css" href="header.css">
		<link href='http://fonts.googleapis.com/css?family=Wire+One|Plaster' rel='stylesheet' type='text/css'>
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
		</script>
	</head>
	<style>
		html,body{
margin:0;
padding:0 0 40px 0;
background:url('white.png');

}

h1{
font: 2em Wire One;
margin-left:20px;
text-shadow:0 0 2px #13c5ff;}

a:visited, a:active, a:link{
color:#13acd9;
}
a:hover{
color:#13c5ff;}

input:focus,#confSel:focus{
outline:#13c5ff solid 1px;}


	</style>
	<body>
		<?php require('header.php');?>
		<br><br><br><br><br>
		<h1>Add To Wishlist</h1>
		<form id="wishForm" action="addToWishlist.php" method="post" style="font:bold 20px monospace;margin:40px 40px 0 40px;">
		NAME :<br><input type="text" name="name" placeholder="NAME" required style="font:18px monospace;padding:5px;width:300px;margin-bottom:10px;"><br>
		E-MAIL :<br><input type="email" name="email" placeholder="E-MAIL" required style="font:18px monospace;padding:5px;width:300px;margin-bottom:10px;"><br>
		CONTACT NUMBER :<br><input type="text" name="contactNumber" placeholder="CONTACT NUMBER" required style="font:18px monospace;padding:5px;width:300px;margin-bottom:10px;"><br>
		CONFERENCE ROOM:<select id="confSel" name="roomId" form="wishForm" required style="font:18px monospace;padding:5px;margin-right:20px;margin:10px;">
							<?php 
								if(isset($_GET['roomId']))
								{
									$r = $_GET['roomId'];
									switch($r)
									{
										case 2: echo '<option value="1">A</option><option selected="selected" value="2">B</option><option value="3">C</option>';
										break;
										case 3: echo '<option value="1">A</option><option value="2">B</option><option selected="selected" value="3">C</option>';
										break;
										default: echo '<option selected="selected" value="1">A</option><option value="2">B</option><option value="3">C</option>';
									}
								}
								else echo '<option value="1">A</option><option value="2">B</option><option value="3">C</option>';
							?>
						</select>
		DATE:<input type="text" name="dateP" id="dateP" placeholder="DATE" required style="font:18px monospace;margin-right:20px;padding:5px;margin:10px;">
		<!--<input id="fromP" type="number" name="fromP" min="0800" max="2000" step="100" placeholder="FROM" required style="padding:5px;">hrs-->
		FROM:<select id="fromP" name="fromP" form="wishForm" placeholder="FROM" required style="font:18px monospace;padding:5px;margin:10px;">
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
		TO:<select id="toP" name="toP" form="wishForm" placeholder="TO" required style="font:18px monospace;padding:5px;margin:10px;">
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
		<input type="Submit" title="Click to add to wishlist" value="SUBMIT" style="cursor:pointer;font:18px monospace;margin-top:30px;padding:5px;border-color:#13c5ff;color:#13acd9;"><br>
		<div style="margin-top:20px;">(Confirmation Mail Will Be Sent)</div>
		</form>
		
	</body>
</html>