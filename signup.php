<?php 
session_start(); 
require_once('inc/header.php');
require_once('lib/command.php');
$errors = array();

if(isset($_POST['email'])){
	//TODO: check if retyped password is a match
	Command::addUser($_POST['email'], $_POST['userName'],  $_POST['firstName'],  $_POST['lastName'],  md5($_POST['password']),  $_POST['type']);
	if(isset($_SESSION['success'])){
		header('Location: index.php');
	}
}
?>

<body>
<div class="container">
<h1>Sign Up</h1>


<form method="post" action="signup.php">
	<div class="form-group row">
		<label for="email" class="col-sm-2 form-control-label">Email</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" name="email" id="email" placeholder="email" required > 
		</div>
	</div>
	
	<div class="form-group row">
		<label for="userName" class="col-sm-2 form-control-label">Username</label>
		<div class="col-sm-3">
			<input type="text" pattern="[a-zA-Z0-9]{2,64}" class="form-control" name="userName" id="userName" placeholder="user name" required > 
		</div>
	</div>
   
   <div class="form-group row">
		<label for="firstName" class="col-sm-2 form-control-label">First Name</label>
		<div class="col-sm-3">
			<input type="text" pattern="[a-zA-Z0-9]{2,64}" class="form-control" name="firstName" id="firstName" placeholder="first nme" required > 
		</div>
	</div>
	<div class="form-group row">
		<label for="lastName" class="col-sm-2 form-control-label">Last Name</label>
		<div class="col-sm-3">
			<input type="text" pattern="[a-zA-Z0-9]{2,64}" class="form-control" name="lastName" id="lastName" placeholder="last name" required > 
		</div>
	</div>
	
	
	<div class="form-group row">
		<label for="password" class="col-sm-2 form-control-label">password</label>
		<div class="col-sm-3">
			<input type="password" class="form-control" name="password" id="password" placeholder="password" required >
		</div>
	</div>

	<div class="form-group row">
		<label for="repassword" class="col-sm-2 form-control-label">Re-type password</label>
		<div class="col-sm-3">
			<input type="password" class="form-control" name="repassword" id="repassword" placeholder="retype password" required >
		</div>
	</div>
	
	<div class="form-group row">
		<label for="repassword" class="col-sm-2 form-control-label">Register as</label>
		<div class="col-sm-7">
		  <input type="radio" name="type" id="student" value="1" checked="checked"> student/volunteer
		  <br>
		  <input type="radio" name="type" id="mentor" value="2"> mentor/administrator
		</div>
	</div>


	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-info" name="Sign Up">Sign Up</button>
		</div>
	</div>
</form>


</div>
</body>



