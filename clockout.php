<?php 
session_start(); 
require_once('inc/header.php');
require_once('lib/command.php');
if(!isset($_SESSION['username'])){
	header('Location: index.php');
}
if(!isset($_SESSION['projectName'])){
	header('Location: clockIn.php');
}
if(isset($_POST['clockout'])){
	Command::clockOut($_SESSION['userID']);
}
?>
<body onload= "startTime(); ">




<h1 align="center">Time Tracking System</h1>

<h4 align="center">Current Time: </h4>
<p align="center" id="clock">00:00:00 </p>
<h4 align="center">Current Project: </h4>
<p align="center"> <?php echo $_SESSION['projectName'] ?> </p>
<br>

<h3 align="center"><b>Time Elapsed:</b></h3>
<h4 align="center" id="elapse">00:00:00 </h4>


<form  method="post"  action="clockout.php" align="center" style="margin-top: 50px;">
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-info" style="display: block;position: relative;left: 40%;transform:translateX(-50%);" name="clockout">Clock out</button>
		</div>
	</div>
</form>


<script>
startElapseTime(<?php echo "\"".$_SESSION['startTime']."\"" ?>);
</script>

</body>
</html>
