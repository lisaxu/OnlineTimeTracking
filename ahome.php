

<?php 
session_start(); 
require_once('inc/header.php');
require_once('lib/command.php');

if(!isset($_SESSION['username'])){
	header('Location: index.php');
}
?>
<body>
<script>$(document).ready( function () {$('#logTable').DataTable();} );</script>

<div class="container">
	<h1> Admin Home </h1>

	<table id="logTable" class="table table-bordered table-hover">
		<thead>
		<tr>
			<th style="width: 40%">Project</th>
			<th>Hours</th>
			<th>Status</th>
		</tr>
		</thead>
		<tbody>
		<?php 
			$projectCollection = Command::getAllProjects();
			foreach($projectCollection as $p){				
				echo "<tr>";
				echo "<td> <a href=\"aproject.php?projectID=$p[0]&week=all\">$p[1] </td>";
				echo "<td> $p[2] </td>";
				echo "<td> In Progress </td>";
				echo "</tr>";
			}
		?>
		</tbody>
	</table>
	
	
	
	<div  style="float:right; margin-right:10%;"> <a class="btn btn-info" style="color:white;" href="alog.php?week=2016-05-01"> <span class="glyphicon glyphicon-calendar"></span>  View Time Logs </a></div>
	<div style="float:left; margin-left:10%;"> <a class="btn btn-info"  style="color:white;" href="addProject.php"> <span class="glyphicon glyphicon-plus"></span> Add New Project </a></div>
	
</div>
</body>
