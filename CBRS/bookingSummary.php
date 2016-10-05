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
		$getCapacityQuery = mysql_query("select roomName from room where rid = {$_POST['roomId']}");
		while($getCapacity = mysql_fetch_array($getCapacityQuery))
			$roomName = $getCapacity['roomName'];
?>
<!DOCTYPE html>
</html>
	<head>
		<title>Booking - ABC Conference Room Booking</title>
		<link rel="stylesheet" type="text/css" href="header.css">
		<link href='http://fonts.googleapis.com/css?family=Wire+One|Plaster' rel='stylesheet' type='text/css'>
		
		
		<script>
			$(document).ready(function(){
				
				$('#button').click(function(){ 
					if(parseInt($('#vip').val(),10) >= parseInt($('#people').val(),10)){
						alert("You have selected more VIPs than the total number of participants!");
						return false;
					}
					if((parseInt($('#vip').val(),10) > <?php echo $capacity;?>)||(parseInt($('#people').val(),10) > <?php echo $capacity;?>)){
						alert("Conference hall cannot accomodate so many people!");
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
		<!--<div style="overflow:hidden;height:400px;width:700px;box-shadow: 0 0 4em 0.1em #13c5ff; border-radius:3.2em;display:inline-block;margin-bottom:2.2em;"><img src="C1.jpg" name="slide" style="height:auto;width:800px;box-shadow:0 0 10px 10px white;"></div>
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
		
		<hr color="#13c5ff" width="350px">-->
		<h1>Booking Summary</h1>
		<form style="margin-left:3em;font:17px Cambria;"action="bookingConfirmed.php" method="post">
		ROOM:<?php echo $roomName;?><br>
		DATE:<?php echo $_POST['dateP'];?><br>
		FROM:<?php echo $_POST['fromP'];?>hrs<br>
		TO:<?php echo $_POST['toP'];?>hrs<br>
		<br>
		NO. OF PARTICIPANTS:<?php echo $_POST['participants'];?>
		<br>
		NO. OF VIPs: <?php echo $_POST['vip'];?>
		<br>
		SECURITY OPTIONS:<?php if(isset($_POST['description'])) echo $_POST['description']; else echo "None";?>
		<br>
		ARRANGEMENT: <?php echo $_POST['Arrangement']; ?>
		<br>
		NO. OF STAGES: <?php echo $_POST['stages']; ?>
		<br>
		PODIA REQUIRED: <?php echo $_POST['podium']; ?>
		<br>
		MICROPHONES REQUIRED: <?php echo $_POST['mics']; ?>
		</br>
		PROJECTORS REQUIRED: <?php echo $_POST['projector']; ?>
		<br>
		REFRESHMENTS:
		<?php if(isset($_POST['refreshment'])) 
				{
					$refresh = $_POST['refreshment'];
					$refreshments = "";
					foreach($refresh as $i)
						$refreshments = $refreshments.$i." | ";
					echo $refreshments;
				}
				else echo "None";
		?>				
		
		<input type="hidden" name="dateP" value="<?php echo $_POST['dateP'];?>">
		<input type="hidden" name="fromP" value="<?php echo $_POST['fromP'];?>">
		<input type="hidden" name="toP" value="<?php echo $_POST['toP'];?>">
		<input type="hidden" name="participants" value="<?php echo $_POST['participants'];?>">
		<input type="hidden" name="vip" value="<?php echo $_POST['vip'];?>">
		<input type="hidden" name="securityOptions" value="<?php if(isset($_POST['description'])) echo $_POST['description']; else echo "None";?>">
		<input type="hidden" name="arrangement" value="<?php echo $_POST['Arrangement']; ?>">
		<input type="hidden" name="stages" value="<?php echo $_POST['stages']; ?>">
		<input type="hidden" name="podium" value="<?php echo $_POST['podium']; ?>">
		<input type="hidden" name="mics" value="<?php echo $_POST['mics'];?>">
		<input type="hidden" name="projectors" value="<?php echo $_POST['projector'];?>">
		<input type="hidden" name="refreshments" value="<?php if(isset($_POST['refreshment'])) { $refresh = $_POST['refreshment'];
					$refreshments = "";
					foreach($refresh as $i)
						$refreshments = $refreshments + $i + " ";
					echo $refreshments;
				}
				else echo "None";
		?>">
		<br>
		<input type="hidden" name="roomId" value="<?php echo $_POST['roomId'];?>">
		<center><input type="submit" value="CONFIRM"><!--<input type="button" value="GO BACK">--></center>
		</form>
		
		</div></center>
	</body>
</html>