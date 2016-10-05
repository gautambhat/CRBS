<?php 
	session_start();
	if(isset($_SESSION["Login"]) && isset($_SESSION["username"]) && isset($_SESSION["uid"]) && isset($_SESSION["type"]))
		if($_SESSION["Login"] == "YES")
		{
			if($_SESSION["type"]==0)
				header('Location: adminHome.php');
			else header('Location: start.php');
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ABC Conference Room Booking</title>
		<!<link rel="stylesheet" type="text/css" href="xls.css">
		<link href='http://fonts.googleapis.com/css?family=Plaster' rel='stylesheet' type='text/css'>
		<script>
			var image1 = new Image();
			image1.src = "C1.jpg";
			var image2 = new Image();
			image2.src = "C2.jpg";
			var image3 = new Image();
			image3.src = "C3.jpg";
		</script>
	</head>
	<style>
	html,body{
margin:0;padding:0;color:white;
}


#ABCConf {
	font: 55px Plaster;
	width: 100%;
	min-width:18em;
	height: 80px;
	padding-top: 20px;
	z-index: 9999;
	position: absolute;
	background: rgba(0,0,0,0.65);
}

a:visited, a:active, a:link{
color:#13acd9;
}
a:hover{
color:#13c5ff;}
	</style>
	
	<body>
		<div id="ABCConf">
			<span style="padding-left:23px;"><span style="color:#13c5ff;">ABC</span>&nbsp;<span style="color:white">CONFERENCE ROOM BOOKING</span></span>
		</div>
			
			
		<img src="C1.jpg" name="slide" style="position:absolute;height:100%;width:100%;min-width:62em;">
		<script>
			var step = 1;
			function slideit()
			{
				document.images.slide.src=eval("image"+step+".src");
				if (step<3)
					step++;
				else
					step=1;
				//call function "slideit()" every 4.8 seconds
				setTimeout("slideit()",4000)
			}
			slideit();
		</script>
		<div id="login" style="width:310px;height:165px;border-top-right-radius:200px;background:rgba(0,0,0,0.65);position:absolute;z-index:9999;bottom:0;left:0;">
			<form action="next.php" method="post">
				<input type="text" required autofocus placeholder="SNU Net ID" name="username" style="border-radius: 10px;
padding: 5px;
margin-left: 20px;
border-color: #13c5ff;
outline: none;
font: bold 15px monospace;
margin-top: 30px;">
				<br>
				<input type="password" required placeholder="Password" name="password" style="padding: 5px;
border-radius: 10px;
margin-left: 20px;
border-color: #13c5ff;
outline: none;
font: bold 15px monospace;
margin-top: 15px;
">
				<br>
				<input type="submit" value="LOGIN" style="
    cursor:pointer;
	border-color:#13c5ff;
	color:#13acd9;
	border-radius:10px;
	font: bold 15px monospace;
	width:auto;
	padding: 5px;
    margin-left: 20px;
    margin-top: 10px;
">
<a href="working.html" style="margin-left:18px;">Forgot Password?</a>
			</form>	
		</div>
	</body>
</html>