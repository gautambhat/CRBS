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
		$getCapacityQuery = mysql_query("select roomName, capacity from room where rid = {$_POST['roomId']}");
		while($getCapacity = mysql_fetch_array($getCapacityQuery))
		{
			$capacity = $getCapacity['capacity'];
			$roomName = $getCapacity['roomName'];
		}
?>
<!DOCTYPE html>
</html>
	<head>
		<title>Booking - ABC Conference Room Booking</title>
		<link rel="stylesheet" type="text/css" href="header.css">
		<link href='http://fonts.googleapis.com/css?family=Wire+One|Plaster' rel='stylesheet' type='text/css'>
		
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script>
			$(document).ready(function(){
				
				$('#button').click(function(){ 
					if(parseInt($('#vip').val(),10) > parseInt($('#people').val(),10)){
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
		<h3><?php echo "Conference on ".$_POST['dateP'].", From ".$_POST['fromP']."hrs To ".$_POST['toP']."hrs in ".$roomName.": ";?></h3>
		<form id="specsForm" action="bookingSummary.php" method="post" style="font:bold 18px monospace;margin:40px 40px 0 40px;">
		<h1>Conference Essentials</h1>
		NO. OF PARTICIPANTS:<br><input id="people" type="text" name="participants" placeholder="Number of Participants" min="0" max="<?php echo $capacity;?>" required style="font:16px monospace;padding:5px;width:300px;margin-bottom:10px;"><br>
		NO. OF VIPs:<br><input type="text" id="vip" name="vip" placeholder="Number of VIPs" required min="0" max="<?php echo $capacity;?>" style="font:16px monospace;padding:5px;width:300px;margin-bottom:10px;"><br>
		SECURITY OPTIONS:<br><textarea name="description" form="specsForm" maxlength="350" rows="4" cols="85"></textarea>
		<h1>Arrangement Options</h1>
			ARRANGEMENT:<label style="font:16px monospace;padding:5px;margin:10px;"><input required type="radio" name="Arrangement"  value = "Circle" >Circle</label>
            <label style="font:16px monospace;padding:5px;margin:10px;"><input type="radio" required name="Arrangement"  value = "Semi-Circle" >Semi-Circle</label>
            <label style="font:16px monospace;padding:5px;margin:10px;"><input type="radio" required name="Arrangement"  value = "Rows" >Rows</label>
		<br><br>
		NO. OF STAGES:<select id="fromP" name="stages" form="specsForm" placeholder="FROM" required style="font:16px monospace;padding:5px;margin:10px;">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
		</select><br>
		PODIUM REQUIRED:<select id="fromP" name="podium" form="specsForm" placeholder="FROM" required style="font:16px monospace;padding:5px;margin:10px;">
			<option value="1">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="4">4</option>
		</select><br>
		NO. OF MICROPHONES REQUIRED:<select id="fromP" name="mics" form="specsForm" placeholder="FROM" required style="font:16px monospace;padding:5px;margin:10px;">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
		</select><br>
		NO. OF PROJECTORS REQUIRED:<select id="fromP" name="projector" form="specsForm" placeholder="FROM" required style="font:16px monospace;padding:5px;margin:10px;">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
		</select>
		<h1>Refreshments (if any):</h1>
		<?php	if(($_POST['fromP']>=1300 && $_POST['fromP']<=1600) || ($_POST['toP']>=1100 && $_POST['toP']<=1600))
				echo '<label><input type="checkbox" name="refreshment[]"  value="Lunch">Lunch</label><br>';?>
		<?php
			if($_POST['fromP']<=1200 || $_POST['toP']<=1100)
				echo '<label><input type="checkbox" name="refreshment[]"  value="Breakfast">Breakfast</label><br>';?>
		<?php	if($_POST['fromP']>=1900 || $_POST['toP']>=1900)
				echo '<label><input type="checkbox" name="refreshment[]"  value="Dinner">Dinner</label><br>';
		?>
		<label><input type="checkbox" name="refreshment[]"  value="Usual">Usual Refreshments(Drinks, snacks etc.)</label><br>
		<br>
		<center><input id="button" type="Submit" title="Click to add to wishlist" value="PROCEED" style="cursor:pointer;font:18px monospace;margin-top:30px;padding:5px;border-color:#13c5ff;color:#13acd9;"></center><br>
		<input type="hidden" name="dateP" value="<?php echo $_POST['dateP'];?>">
		<input type="hidden" name="fromP" value="<?php echo $_POST['fromP'];?>">
		<input type="hidden" name="toP" value="<?php echo $_POST['toP'];?>">
		<input type="hidden" name="roomId" value="<?php echo $_POST['roomId'];?>">
		</form>
		
		</div></center>
	</body>
</html>