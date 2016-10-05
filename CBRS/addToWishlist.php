<?php

	session_start();
	if(isset($_SESSION["Login"]))
		if($_SESSION["Login"] != "YES")
			header('Location: index.php');
	if(!isset($_SESSION["Login"])) 
		header('Location: index.php');
	if(!(isset($_POST['name']) && isset($_POST['contactNumber']) && isset($_POST['email']) && isset($_POST['roomId'])&& isset($_POST['dateP']) && isset($_POST['fromP']) && isset($_POST['toP'])))
		header('Location: wishlist.php');
	require 'config.php';
	mysql_connect($configHostName,$configRootName,$configAccessPassword);
	mysql_select_db($configDatabaseName);
	
	$prepStatement = "insert into wishlist(u_id, name, email, contact, r_id, reqdate, reqfrom, reqto) values({$_SESSION['uid']}, '{$_POST['name']}','{$_POST['email']}','{$_POST['contactNumber']}',{$_POST['roomId']},'{$_POST['dateP']}',{$_POST['fromP']},{$_POST['toP']})";
	mysql_query($prepStatement) or die(mysql_error());
	mysql_close();
	
	$message = "Greetings, ".$_POST['name']."! \r\nYour request has been added to the wishlist!\r\nDate:".$_POST['dateP']."\r\nFROM TIME:".$_POST['fromP']."hrs\r\nTO TIME:".$_POST['toP']."hrs";
		//echo "<p style='font-size:18px;'>".$message."</p>";
		//mail($emailId, "Fantasy Football Password", $message, "From: sports.committee@snu.edu.in");
	header('Location: start.php');
	
	
?>