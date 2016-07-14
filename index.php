<?php 
session_start();
require_once('inc/header.php');
require_once('lib/command.php');
require_once('lib/database.php');

$dbh = new Database();			
//$dbh->initDatabase();
//Command::addData();
if(isset($_SESSION['success'])){
	echo "<div class=\"alert alert-success\"> You're signed up! Please log in. </div>";
	unset($_SESSION['success']);
}

if(isset($_POST['username'])){
	Command::signin($_POST['username'], md5($_POST['password']));
}


?>

<body>
<div class="container">
<h1>Welcome</h1>



<form method="post" action="index.php">
	<div class="form-group row">
		<label for="username" class="col-sm-2 form-control-label">Username</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" name="username" id="username" placeholder="username"> 
		</div>
	</div>
   
	<div class="form-group row">
		<label for="password" class="col-sm-2 form-control-label">password</label>
		<div class="col-sm-3">
			<input type="password" class="form-control" name="password" id="password" placeholder="password">
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-info" name="login">Log in</button>
		  Not registered? <a href="signup.php">Sign up</a>
		</div>
	</div>
</form>

<br><br><br><br>
<div style="color: #CECDCD;"> 
	test note: <br> 
	admin account: username:admin, pswd:12345<br>
	user account: username:user1, pswd:12345
</div>
</div>
</body>

