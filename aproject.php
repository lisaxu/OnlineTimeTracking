<?php 
session_start(); 
require_once('lib/command.php');
require_once('inc/header.php');
function checkweek($string){
	if(!strcmp($string, $_GET['week'])){
		echo 'selected="selected"';
	}
}

if(!isset($_GET['projectID'])){
	header('Location: ahome.php');
}else{
	$projID= $_GET['projectID'];
	$project = Command::getProject($_GET['projectID']);
	$userShare = Command::getUserContribution($_GET['projectID'], $_GET['week']);
	//Array ( [0] => wetland herbarium [1] => wetland ecology [2] => 0 )
}

?>


<body onresize="drawChart()">
<script>
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Name', 'Hours'],
          <?php 
          	foreach($userShare as $s){
          		echo '[\''.$s[0].'\','.$s[1].'],';
          	}
          ?>
          //['Precious Wolfre',     11.88],
          //['Joe Fort',      2],
          //['Kallen Smith',  5],
          //['Tracy Beverage', 2]
        ]);

        var options = {
          title: 'Time Chart',
          is3D: true,
          chartArea: {left:10,top:10,width:'90%',height:'90%'},
          legend: {position:'labeled', textStyle: {color: 'blue', fontSize: 16}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

	$(document).ready( function () {
	$('#weekPicker').change(function(){
		var location = $(location).attr('href');
		var week = $('#weekPicker').val();
		var projectID = <?php echo $_GET['projectID'] ?>;

		window.location='aproject.php?projectID='+ projectID + '&week=' + week;
	});
} );
</script>

<div class="container">
<h1>Project Details</h1>


<table "align=center" class="auto-style9" style="width: 80%">
	<tr>
		<td class="auto-style7" style="width: 50%; height: 67px;"><span class="auto-style4">
		Project: <?php echo $project[0] ?>
		</span><br class="auto-style4" />
		<span class="auto-style4">Team: <?php echo $project[1] ?></span><br class="auto-style4" />
		<span class="auto-style4">Status: In progress </span></td>
		<td class="auto-style8" valign="top" style="height: 67px; width: 50%;">
			Total Hours:<br/>
			<h1><?php echo $project[2]?> </h1>
		</td>
	</tr>
	<tr>
		<td class="auto-style10" style="width:50%; height: 52px;" valign="top"></td>
		<td class="auto-style10" style="width:50%; height: 52px;" valign="top">
		<form>
			<div class=" col-sm-9" align="center">
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
		<a href="aproject.php?projectID=<?php echo $_GET['projectID'] ?>&week=all">or show total</a>
		</td>
	</tr>
	<tr>
		<td class="auto-style12" style="width:50%; height: auto;" valign="top" colspan="2">
		<div id="piechart" style="width: 100%; height: 450px;"></div></td>
	</tr>
</table>
	
<div> <a class="btn btn-info" style="color:white;" href="ahome.php"> <span class="glyphicon glyphicon-chevron-left"></span> Back </a></div>	
	
	
</div>
</body>
</html>
	
		
