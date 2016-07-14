
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>time tracking system</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/bs-3.3.6/jq-2.2.0,dt-1.10.11,fh-3.1.1,r-2.0.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/t/bs-3.3.6/jq-2.2.0,dt-1.10.11,fh-3.1.1,r-2.0.2/datatables.min.js"></script>

	<script src="lib/dynamic.js"></script>
	<script src="lib/moment.js"></script>
	<script src="lib/moment-timezone-with-data-2010-2020.js"></script>
	<link href="style.css" type="text/css" rel="stylesheet">
	
	
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand"> Time Tracker (Test version)</a>
				<a><img src="inc/logo.png" alt="404logo" style="height: 50px; padding: 10px 10px 10px 0;"></a>
			</div>
			<!--
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Page 1</a></li>
				<li><a href="#">Page 2</a></li>
				<li><a href="#">Page 3</a></li>
			</ul>
			-->
			<ul class="nav navbar-nav navbar-right">
				<?php 
						if(isset($_SESSION['username'])){
							$name = $_SESSION['username'];
						}else{
							$name = 'Guest';
						}
					echo "<li><a style=\"color:#F6921E\"> <span class=\"glyphicon glyphicon-user\"></span> $name</a></li>"
				?>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
			
	  </div>
	</nav>
</head>





