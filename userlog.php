<?php 
session_start(); 
require_once('inc/header.php');
require_once('lib/command.php');
list($displayUser, $ulogs) = Command::getUserLogs($_GET['userID'], $_GET['week']);

function checkweek($string){
	if(!strcmp($string, $_GET['week'])){
		echo 'selected="selected"';
	}
}

?>


<body>
<div class="container">
<script>
$(document).ready( function () {
	$('#logTable').DataTable();

	$('#weekPicker').change(function(){
		//alert("hil" + $('#weekPicker').val() +"ll");
		var location = $(location).attr('href');
		var week = $('#weekPicker').val();
		var userID = <?php echo $_GET['userID'] ?>;

		window.location='userlog.php?userID='+ userID + '&week=' + week;
		//URL = URL.replace('return=false','return=true'); 
		//location.reload();
	});
} );

//$( "#weekPicker" ).change(function() {
  //alert( "Handler for .change() called." );});
</script>
	<h1> User Logs </h1>
	<h3> Showing logs for: <?php echo $displayUser ?> </h3>
	
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
		<tr>
			<td>Project</td>
			<td>This week</td>
			<td>Total time</td>
		</tr>
		</thead>
		<tbody>
		<?php
			foreach($ulogs as $l){
	    		echo '<tr>';
	    		echo "<td> $l[0] </td>";
	    		echo "<td> $l[1] </td>";
	    		echo "<td> $l[2] </td>";
	    		echo '</tr>';
    		}
		?>
		</tbody>
	</table>
	

<div> <a class="btn btn-info" style="color:white;" href="ahome.php"> <span class="glyphicon glyphicon-chevron-left"></span> Back </a></div>

</div>
</body>
