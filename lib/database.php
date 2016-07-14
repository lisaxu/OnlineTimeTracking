<?php
class Database extends PDO{
	
	public function __construct(){
		parent::__construct("sqlite:/home/zichunxu/public_html/time404/database.db");
	}
	
	
	function initDatabase(){
		$this->dropTable('user');
		$this->dropTable('project');
		$this->dropTable('log');
		//user table  type 1 for student, type 2 for mentor
		$command = "CREATE TABLE if not exists user (userID INTEGER PRIMARY KEY AUTOINCREMENT, email VARCHAR(50) NOT NULL, userName VARCHAR(50) NOT NULL, firstName VARCHAR(50) NOT NULL,lastName VARCHAR(50) NOT NULL, password CHARACTER(32) NOT NULL, type INTEGER NOT NULL)";
		$status = $this->exec($command);
		if($status === FALSE){
			echo 'fail to create user';
			print_r($this->errorInfo());
			return;
		}else{
			echo 'success in creating user';
		}
		
		//project table
		$command = "CREATE TABLE if not exists project (projectID INTEGER PRIMARY KEY AUTOINCREMENT, name VARCHAR(50) NOT NULL, groupName VARCHAR(50) NOT NULL, hours INTEGER, description CHARACTER(100))";
		$status = $this->exec($command);
		if($status === FALSE){
			echo 'fail to create project';
			print_r($this->errorInfo());
			return;
		}else{
			echo 'success in creating project';
		}
		
		
		//time log entry table, 0 for not finished, 1 for finished
		//logID, startTime, endTime, status, duration, projectID, userID;
		$command = "CREATE TABLE if not exists log (logID INTEGER PRIMARY KEY AUTOINCREMENT, startTime DATETIME, endTime DATETIME, status INTEGER NOT NULL, duration DATETIME NOT NULL, projectID INTEGER NOT NULL, userID INTEGER NOT NULL, FOREIGN KEY(projectID) REFERENCES project(projectID), FOREIGN KEY(userID) REFERENCES user(userID))";
		$status = $this->exec($command);
		if($status === FALSE){
			echo 'fail to create log';
			print_r($this->errorInfo());
			return;
		}else{
			echo 'success in creating log';
		}
		// insert initial value
		$command = "INSERT INTO user (email, userName , firstName,lastName, password, type VALUES (''))";
		$status = $this->exec($command);
		
	}
	
	
	function dropTable($name){
		$command = "DROP TABLE IF EXISTS " . $name;
		$status = $this->exec($command);
		if($status === FALSE){
			echo '<pre class="bg-danger">';
			print_r($this->errorInfo());
			echo '</pre>';
		}else{
			echo '<pre class="bg-success">';
			echo 'Number of rows effected: ' . $status;
			echo '</pre>';
		}
	}
	
	
	
}


?>
