
<?php 
session_start(); 
require_once('inc/header.php');
require_once('lib/command.php');

if(isset($_SESSION['logsuccess'])){
	echo "<div class=\"alert alert-success\"> Your time has been successfully logged. Nide job! </div>";
	unset($_SESSION['logsuccess']);
}
Command::checkStatus($_SESSION['userID']);

if(isset($_POST['behavior']) && strcmp("clockin", $_POST['behavior']) == 0){
	Command::clockIn($_SESSION['userID'], $_POST['project']);
	//
}
if(isset($_POST['behavior']) && strcmp("add", $_POST['behavior']) == 0){
	//Command::clockIn($_SESSION['userID'], $_POST['project']);
	Command::addManually($_SESSION['userID'], $_POST['project'], $_POST['date'].$_POST['start'].':00',  $_POST['date'].$_POST['end'].':00');
}

?>

<body onload="startTime()">

<div class="container">

<h4 align="center"> Current Time: <span id = "clock"> Wed, 27 Apr 2016 16:49:34 GMT</span></h4> 
<h4 align="center"> Today's Hours: <span> <?php echo Command::getTodayHours($_SESSION['userID']); ?> </span></h4> 
<br>


<form method="post" action="clockIn.php">
	<div class="form-group row">
		<label for="project" class="col-sm-2 form-control-label">Choose a project</label>
		<div class="col-sm-3">
			<select name="project" class="form-control">
			<optgroup label="-- Recently used --">
				<option value="1" selected="selected">wetland herbarium</option>
			</optgroup>
			<optgroup label="--Others">
				<?php
					$projectCollection = Command::getAllProjects();
					foreach($projectCollection as $p){
						if($p[0] != 1){
							echo "<option value=\"$p[0]\"> $p[1]</option>";
						}
					}
				?>
			</optgroup>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-info" name="behavior" value="clockin">Clock in</button>
		</div>
	</div>


<br><br>


<h4 style="padding-top:20px;"> OR Enter Manually </h4>
	<div class="form-group row">
		<label for="date" class="col-sm-2 form-control-label">Date:</label>
		<div class="col-sm-3">
			<input type="date" class="form-control" name="date" id="date" >
		</div>
	</div>
		
	<div class="form-group row">
		<label for="start" class="col-sm-2 form-control-label">Start Time:</label>
		<div class="col-sm-3">
			<input type="time" class="form-control" name="start" id="start"  >
		</div>
	</div>
		
	<div class="form-group row">
		<label for="end" class="col-sm-2 form-control-label">End Time: </label>
		<div class="col-sm-3">
			<input type="time" class="form-control" name="end" id="end"  >
		</div>
	</div>
		
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-info" name="behavior" value="add">Add</button>
		</div>
	</div>

</form>




</div>
</body>
</html>





