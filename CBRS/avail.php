<?php
	session_start();
	if(isset($_SESSION["Login"]))
		if($_SESSION["Login"] != "YES")
			header('Location: index.php');
	if(!isset($_SESSION["Login"])) 
		header('Location: index.php');
	if(!(isset($_POST['dateP']) && isset($_POST['toP']) && isset($_POST['fromP'])))
		header('Location: start.php');
	require 'config.php';
	mysql_connect($configHostName,$configRootName,$configAccessPassword);
	mysql_select_db($configDatabaseName);
?>

<!DOCTYPE html>
</html>
	<head>
		<title>Available Rooms - ABC Conference Room Booking</title>
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
					if(!isValidDate($('#dateP').val()))
					{
						alert('Date in incorrect format! Please use the provided date picker.');
						return false;
					}
					});
				
			});
			function isValidDate(dateString) {
			  var regEx = /^\d{4}-\d{2}-\d{2}$/;
			  return dateString.match(regEx) != null;
			}
		</script>
	</head>
	<style>
		html,body{
margin:0;
padding:0 0 40px 0;
background:url('xls1.jpg');

}



a:visited, a:active, a:link{
color:#13acd9;
}
a:hover{
color:#13c5ff;}
h3{
font: 3em Wire One;
margin-left:20px;
text-shadow:0 0 1px #13c5ff;}
input:focus{
outline:#13c5ff solid 1px;}
textarea{resize:none;margin-left:20px;font-size:15px;}
textarea:focus{
outline:#13c5ff solid 2px;}
}
div.roomYes:hover{background:#13c5ff;}

	</style>
	<body>
	
		<?php require('header.php');?>
		<br><br><br>
		
		<center><form id="availForm" action="avail.php" method="post" style="margin-top:40px;">
		<input type="text" name="dateP" value="<?php echo $_POST['dateP'];?>"id="dateP" placeholder="DATE" required style="margin-right:40px;padding:5px;width:75px;">
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
		</select>
		<input id="button" type="submit" value="CHANGE" style="cursor:pointer;border-color:#13c5ff;color:#13acd9;padding:5px;margin:20px 0 10px 30px;">
		</form>
		<hr color="#13c5ff" width="450px"></center>
		<br>
		<!--<div style="text-align:center;"><span style="text-align:left;font:1.5em monospace;">Description about the conference:</span><br>
		<textarea required name="description" form="conferenceForm" maxlength="350" rows="4" cols="100"></textarea></div>-->
		<h3><?php echo "Availability of Conference Rooms on ".$_POST['dateP'].", From ".$_POST['fromP']."hrs To ".$_POST['toP']."hrs :";?></h3>
		<center><div id="rooms">
				<?php
					for($i=1;$i<=3;$i=$i+1)
					{
						$getRoomDetails = mysql_query('select * from room where rid='.$i.'') or die(mysql_error());
						while($roomDetails = mysql_fetch_array($getRoomDetails))
						{
							$capacity = $roomDetails['capacity'];
							$roomName = $roomDetails['roomName'];
							$location = $roomDetails['location'];
						}
						$checkAvailQuery = "select bid from booking where r_id=".$i." AND bdate='{$_POST['dateP']}' AND ((startTime >= '{$_POST['fromP']}' AND startTime <= '{$_POST['toP']}') OR (endTime >= '{$_POST['fromP']}' AND endTime <= '{$_POST['toP']}'))";
						$checkAvail = mysql_query($checkAvailQuery) or die(mysql_error());
						if(mysql_num_rows($checkAvail)==0)
						{
							echo '<label for="radio'.$i.'"><div align="left" class="roomYes" style="display:inline-block;margin:0 0.8em;padding:0.8em;cursor:pointer">
								<div style="font:3em Wire One;text-shadow:0 0 1px #13c5ff;">'.$roomName.'</div><br>
								<div style="font:bold 1.3em monospace;margin:2px;">LOCATION: '.$location.'</div>
								<div style="font:bold 1.3em monospace;margin:2px;">CAPACITY: '.$capacity.'</div><br>
								<img src="C'.$i.'.jpg" style="height:150px;width:250px;border-radius:2em;box-shadow:0 0 10px 5px #13c5ff;margin:3px;"><br>
								<span style="color:green;">AVAILABLE</span>
								&nbsp;SELECT<input id="radio'.$i.'" type="radio" name="roomId" value="'.$i.'" required form="conferenceForm">
								</div></label>';
						}
						else
						{
							echo '<div align="left" class="roomNo" style="color:grey;display:inline-block;margin:0 0.8em;padding:0.8em;">
								<div style="font:3em Wire One;text-shadow:0 0 1px #ffeeee;">'.$roomName.'</div><br>
								<div style="font:bold 1.3em monospace;margin:2px;">LOCATION: '.$location.'</div>
								<div style="font:bold 1.3em monospace;margin:2px;">CAPACITY: '.$capacity.'</div><br>
								<img src="C'.$i.'.jpg" style="height:150px;width:250px;border-radius:2em;box-shadow:0 0 10px 5px grey;margin:3px;"><br>
								<span style="font-style:italic;color:red;">NOT AVAILABLE</span><br>
								<a href="wishlist.php?roomId='.$i.'" style="font:bold italic 1.5em monospace;position:absolute;border-color:#13c5ff;color:#13acd9;padding:5px;">ADD TO WISHLIST</a>
								</div>';
						}
					}
				?>	
		</div></center><br>
		<form id="conferenceForm" method="post" action="bookingSpecs.php">
		<input type="hidden" name="dateP" value="<?php echo $_POST['dateP'];?>">
		<input type="hidden" name="fromP" value="<?php echo $_POST['fromP'];?>">
		<input type="hidden" name="toP" value="<?php echo $_POST['toP'];?>">
		<center><input type="submit" value="PROCEED" style="cursor:pointer;border-color:#13c5ff;color:#13acd9;padding:5px;margin:30px;font-size:1.1em;"></center>
		</form>
		<hr color="#13c5ff" width="450px">
		
	</body>
</html>