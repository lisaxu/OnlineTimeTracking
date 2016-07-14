<?php 
session_start(); 
require_once('inc/header.php');
require_once('lib/command.php');
function checkweek($string){
	if(!strcmp($string, $_GET['week'])){
		echo 'selected="selected"';
	}
}

//$logs = Command::getAllLogs($_GET['week']);
/*
$datetime2 = new DateTime();
$datetime1 = new DateTime('2016-4-29 12:00:00');
$interval = $datetime2->diff($datetime1);
//echo $interval->format('%h hr %i min');
echo $interval->format('%H:%I:%S');
echo $datetime2->format('Y-m-d H:i:s'); 
//echo $date->format('Y-m-d H:i:s');
*/
?>


<body>
<script>
$(document).ready( function () {
	$('#logTable').DataTable();

	$('#weekPicker').change(function(){
		var location = $(location).attr('href');
		var week = $('#weekPicker').val();
		window.location='alog.php?week=' + week;

	});
} );

</script>

<div class="container">
	<h1> Time Logs </h1>

	<form>
			<div class="col-sm-offset-4 col-sm-4" align="center">
				<select class="form-control" id="weekPicker" >
					<optgroup label="-- Last Month --">
						<option value="2016-04-03" <?php checkweek("2016-04-03")?> >April 3 - 9</option>
						<option value="2016-04-10" <?php checkweek("2016-04-10")?> >April 10 - 16</option>
						<option value="2016-04-17" <?php checkweek("2016-04-17")?> >April 17 - 23</option>
						<option value="2016-04-24" <?php checkweek("2016-04-24")?> >April 24 - 30</option>
					</optgroup>
					<optgroup label="-- This Month --">
						<option value="2016-05-01" <?php checkweek("2016-05-01")?> >May 1 - 7</option>
						<option value="2016-05-08" <?php checkweek("2016-05-08")?> >May 8 - 14</option>
					</optgroup>
				</select>
			</div>
		</form>

	<table id = "logTable" class=" table table-bordered table-hover">
		<thead>
		<tr >
			<th>Name</th>
			<th>Start</th>
			<th>End</th>
			<th>Duration</th>
			<th>Project</th>
		</tr>
		</thead>
		<tbody>
		<?php 
			$logs = Command::getAllLogs($_GET['week']);
			foreach($logs as $log){
				echo "<tr>";
				echo "<td> <a href=\"userlog.php?userID=$log[0]&week=2016-05-01\">$log[1] $log[2] </td>";
				echo "<td> $log[3] </td>";
				echo "<td> $log[4] </td>";
				
				$dt = new DateTime($log[5]);
				$dt = $dt->format('H:i:s');
				echo "<td> $dt </td>";
				echo "<td> $log[6] </td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	
<div> <a class="btn btn-info" style="color:white;" href="ahome.php"> <span class="glyphicon glyphicon-chevron-left"></span> Back </a></div>



</div>
</body>
