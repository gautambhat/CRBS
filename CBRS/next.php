<?php
	
	require("config.php");
	mysql_connect($configHostName,$configRootName,$configAccessPassword);
	mysql_select_db($configDatabaseName);
	if(!(isset($_POST['username']) && isset($_POST['password'])))
		header('Location: index.php');
	$userCheck = mysql_query("select uid,username,password,type from login where username='".$_POST['username']."' and password='".$_POST['password']."'");
	if(mysql_num_rows($userCheck)!=1)
		echo "Failed to authenticate. Try again <a href='index.php'>here<a>.";
	else if(mysql_num_rows($userCheck)==1)
	{
		while($auth = mysql_fetch_array($userCheck))
			{
				$password = $auth['password'];
				$username = $auth['username'];
				$typeTemp = $auth['type'];
				$uid = $auth['uid'];
			}
		if(strcmp($password,$_POST['password'])!=0)
			echo "Failed to authenticate. Try again <a href='index.php'>here<a>.";
		else if(strcmp($password,$_POST['password'])==0)
		{
			session_start();
			$_SESSION["Login"] = "YES";
			$_SESSION["username"] = $username;
			$_SESSION["uid"] = $uid;
			$_SESSION["type"] = $typeTemp;
			if($typeTemp == 0)
			{
					$type = 'Admin';
					header('Location: adminHome.php');					
			}
			else if($typeTemp == 1)
			{
				$type = 'Student';
				header('Location: start.php');
			}
			else if($typeTemp == 2)
			{
				$type = 'Faculty';
				header('Location: start.php');
			}
			//echo "Welcome, ".$username."!<br>User Type : ".$type;
			
			//die();
		}
	}
?>