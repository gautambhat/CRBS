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
		
		mysql_query("insert into booking (r_id,u_id,bdate,startTime,endTime) values({$_POST['roomId']},{$_SESSION['uid']},'{$_POST['dateP']}',{$_POST['fromP']},{$_POST['toP']})") or die(mysql_error());
		$getbidQuery = mysql_query("select bid from booking where r_id={$_POST['roomId']} && u_id={$_SESSION['uid']} && bdate='{$_POST['dateP']}' && startTime={$_POST['fromP']} && endTime={$_POST['toP']}")or die(mysql_error());
		while($getbid = mysql_fetch_array($getbidQuery))
			$bid = $getbid['bid'];
		mysql_query("insert into booking_spec (b_id,participants,vip,security,stage,projector,podium,mic,arrangement,food) values (".$bid.",{$_POST['participants']},{$_POST['vip']},'{$_POST['securityOptions']}',{$_POST['stages']},{$_POST['projectors']},{$_POST['podium']},{$_POST['mics']},'{$_POST['arrangement']}','{$_POST['refreshments']}')")or die(mysql_error());
?>
<!DOCTYPE html>
</html>
	<head>
		<title>Booking - ABC Conference Room Booking</title>
		<link rel="stylesheet" type="text/css" href="header.css">
		<link href='http://fonts.googleapis.com/css?family=Wire+One|Plaster' rel='stylesheet' type='text/css'>
		
		
		
	</head>
	<style>
		html,body{
margin:0;
padding:0;
background:url('xls1.jpg') fixed;

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
font: 3em Wire One;
text-align:center;
text-shadow:0 0 2px #13c5ff;}
input:focus{
outline:#13c5ff solid 2px;}
textarea{resize:none;font:16px monospace;padding:5px;width:600px;margin-bottom:10px;}
textarea:focus,select:focus{
outline:#13c5ff solid 2px;}
}
	</style>
	<body>
		<div id="ABCConf">
			<span style="padding-left:23px;color:#13c5ff;">ABC</span>
		</div>
		<div id="header">	
			<ul id="menu">
                <li><a href="start.php">Home</a></li>
                <li><a href="working.html">Gallery</a></li>
				<li><a href="working.html">Discussion</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="rules.php">Rules</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
				<li><a href="working.html">Profile</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		<center><div id="container"><br><br><br><br>
		
		<h1>Thank You!</h1>
		
		<p style="margin:1em;font:20px Cambria;">Your Booking Has Been Confirmed.</p>
		<p style="margin:1em;font:20px Cambria;">Return to Home Page <a href="start.php">here</a></p>
		
		
		</div></center>
	</body>
</html>