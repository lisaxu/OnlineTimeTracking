<?php 
session_start(); 
require_once('inc/header.php');
require_once('lib/command.php');


if(isset($_POST['name'])){
	Command::addProject($_POST['name'], $_POST['team'], $_POST['description']);
}
?>

<body>
<div class="container">
<h1>Add Project </h1>

<form method="post" action="addProject.php">
	<div class="form-group row">
		<label for="name" class="col-sm-2 form-control-label">Project Name</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" name="name"  placeholder="Project Name" required > 
		</div>
	</div>
	
	<div class="form-group row">
		<label for="team" class="col-sm-2 form-control-label">Team</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" name="team"  placeholder="Team" required > 
		</div>
	</div>
	
	<div class="form-group row">
		<label for="description" class="col-sm-2 form-control-label"> Description</label>
		<div class="col-sm-3">
			<textarea class="form-control" name="description" rows="3" placeholder="max 100 characters"></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-info" name="add"> Add </button>
		</div>
	</div>
</form>


<div> <a class="btn btn-info" style="color:white;" href="ahome.php"> <span class="glyphicon glyphicon-chevron-left"></span> Back </a></div>

</div>
</body>
</html>
