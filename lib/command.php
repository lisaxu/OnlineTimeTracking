<?php
require_once("database.php");

class Command{

	public static function processName($name){
		$name_lower = strtolower($name);
		$name_lower = preg_replace( '/\s+/', '', $name_lower ); 
		return $name_lower;
	}
	
	public static function addData(){
		$dbh = new Database();
		$command = "INSERT INTO user (email, userName, firstName, lastName, password, type) VALUES(?,?,?,?,?,?)";
		$statement = $dbh->prepare($command);
		$statement->execute(array('example@gmail.com', 'user1', 'Precious', 'Wolfre', md5("12345"), 1));
		$statement->execute(array('example@gmail.com', 'user2', 'Joe', 'Fort', md5("12345"), 1));
		$statement->execute(array('example@gmail.com', 'user3', 'Kallen', 'Smith', md5("12345"), 1));
		$statement->execute(array('example@gmail.com', 'user4', 'Tracy', 'Beverage', md5("12345"), 1));
		$statement->execute(array('example@gmail.com', 'user5', 'Spencer', 'Howe', md5("12345"), 1));
		$statement->execute(array('example@gmail.com', 'lisaxu', 'lisa', 'xu', md5("chem"), 1));
		$statement->execute(array('example@gmail.com', 'admin', 'Alex', 'Cantor', md5("12345"), 2));
		Command::addData2();
		Command::addData3();
		
	}
	public static function addData2(){
		$dbh = new Database();
		$command = "INSERT INTO project(name, groupName, hours, description) VALUES (?,?,?,?)";
		$statement = $dbh->prepare($command);
		$statement->execute(array('wetland herbarium', 'wetland ecology', 70, 'sample description'));
		$statement->execute(array('AFA Nox Weed Mon', 'Botany', 10, 'sample description'));
		$statement->execute(array('Huerfano wetlands', 'ecology', 20, 'sample description'));
		$statement->execute(array('Photography', 'Botany', 30, 'sample description'));
		$statement->execute(array('Wildlife Database', 'ecology',40,  'sample description'));
		$statement->execute(array('Data Entry', 'Biology',0,  'sample description'));
	}
	public static function addData3(){ //yyyy-MM-dd HH:mm:ss
		$dbh = new Database();
		//$date = date('Y-m-d H:i:s', time());
		$command = "INSERT INTO log (startTime, endTime, status, duration, projectID, userID) VALUES (?,?,?,?,?,?)";
		$statement = $dbh->prepare($command);
		$statement->execute(array('2016-04-03 08:00:00', '2016-04-03 10:00:00', 1, '02:00:00', 1, 1));
		$statement->execute(array('2016-04-12 08:00:00', '2016-04-12 09:00:00', 1, '01:00:00', 2, 1));
		$statement->execute(array('2016-04-15 08:00:00', '2016-04-15 09:00:00', 1, '01:00:00', 1, 2));
		$statement->execute(array('2016-04-29 08:00:00', '2016-04-29 09:00:00', 1, '01:00:00', 1, 3));
		$statement->execute(array('2016-04-29 08:00:00', '2016-04-29 09:00:00', 1, '01:00:00', 1, 4));
		$statement->execute(array('2016-05-01 14:00:00', '2016-05-01 17:00:00', 1, '03:00:00', 3, 1));
		$statement->execute(array('2016-04-04 12:30:00', '2016-04-04 17:00:00', 1, '04:30:00', 4, 2));
		$statement->execute(array('2016-05-02 15:00:00', '2016-05-02 18:00:00', 1, '03:00:00', 3, 3));
		$statement->execute(array('2016-04-17 14:00:00', '2016-04-17 19:00:00', 1, '05:00:00', 4, 4));
		$statement->execute(array('2016-05-01 14:30:00', '2016-05-01 17:30:00', 1, '03:00:00', 1, 4));
	}
	
	public static function addUser($email, $username, $firstname, $lastname, $password, $type){
		$dbh = new Database();
		$command = "INSERT INTO user (email, userName, firstName, lastName, password, type) VALUES(?,?,?,?,?,?)";
		$statement = $dbh->prepare($command);
		if(!$statement->execute(array($email, $username, $firstname, $lastname, $password, $type))){
			echo '<div class="alert alert-danger">';
			print_r($dbh->errorInfo());
			echo '</div>';
		}else{
			$_SESSION['success'] = 'yes';
		}
		
	}
	
	public static function addProject($name, $groupName, $description){
		$dbh = new Database();
		$command = "INSERT INTO project(name, groupName, hours, description) VALUES (?,?,?,?)";
		$statement = $dbh->prepare($command);
		if(!$statement->execute(array($name, $groupName, 0, $description))){
			echo '<div class="alert alert-danger">';
			print_r($dbh->errorInfo());
			echo '</div>';
		}else{
			echo "<div class=\"alert alert-success\"> Project <b>$name</b> has been successfully added! </div>";
		}
		
	}
	
	public static function signin($username, $password){
		$dbh = new Database();
		$command = "SELECT * FROM user WHERE userName = \"$username\" and password = \"$password\"";
		$statement = $dbh->prepare($command);
		$statement->execute();
		$result = $statement->fetch();
		if(empty($result)){
			echo '<div class="alert alert-danger"> Wrong username/password combination </div>';
		}else{
			$_SESSION['username'] = $result['userName'];
			$_SESSION['userID'] = $result['userID'];
			if($result['type'] == 1){
				header('Location: clockIn.php');
			}else{
				header('Location: ahome.php');
			}
		}
	}
		
	public static function getAllProjects(){
		$dbh = new Database();
		$command = "SELECT * FROM project ORDER BY projectID";
		$result = $dbh->query($command);
		$projectArray = array();
		foreach($result as $row){
			$projectArray[] = array($row['projectID'], $row['name'], $row['hours']);
		}
		return $projectArray;
	}
	
	public static function getProject($id){
		
		$dbh = new Database();
		$command = "SELECT * FROM project WHERE projectID = $id";
		$result = $dbh->query($command);
		foreach($result as $row){
			$projectArray = array($row['name'], $row['groupName'], $row['hours']);
		}
		return $projectArray;
	}
	public static function getUserContribution($id, $start){
		$dbh = new Database();
		$command = "SELECT * FROM log natural JOIN user WHERE projectID=$id";		
		$statement = $dbh->prepare($command);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		$shareArray = array();
		$table = array(); //an array of project name - duration

		if(strcmp($start, "all") == 0){
			$weekBegin = new DateTime('0001-01-01 00:00:00');
			$weekEnd = new DateTime('now');
		}else{
			$weekBegin = new DateTime($start);
			$weekBegin2 = new DateTime($start);
			$weekEnd = $weekBegin2->add(new DateInterval('P6D'));
		}

		foreach($result as $row){
			//print_r($row);
			//add to this week's hours
			$recordWeek = new DateTime($row['startTime']);
			if($recordWeek >= $weekBegin && $recordWeek <= $weekEnd){
				$realname = $row['firstName'].' '.$row['lastName'];
				if(!array_key_exists($realname, $table)){
					$e = new DateTime('00:00:00');
					$e->add(Command::sqlTimeConvert($row['duration']));
					$table[$realname]= $e;
				}else{
					$y = $table[$realname];
					$y->add(Command::sqlTimeConvert($row['duration']));
					$table[$realname] = $y;
				}
			}
		}
		foreach($table as $rname=>$dt){
			$totalDuration = $dt->diff(new DateTime('00:00:00'));
    		$totalHours = $totalDuration->d * 24 + $totalDuration->h + $totalDuration->i /60.0;
    		$shareArray[] = array($rname, $totalHours);
    		//echo $rname.':'.$totalHours."\n";
		}

		return $shareArray;
	}
	
	public static function clockIn($userID, $projectID){
		$dbh = new Database();
		//current system time
		$date = date('Y-m-d H:i:s', time());
		$command = "INSERT INTO log (startTime, endTime, status, duration, projectID, userID) VALUES (?,?,?,?,?,?)";
		$statement = $dbh->prepare($command);
		//echo "$projectID\n";
		//echo "$userID\n";
		$statement->execute(array($date, '0000-00-00 00:00:00', 0, '00:00', $projectID, $userID));
		
		
		$command = "SELECT * FROM project WHERE projectID = $projectID";
		$result = $dbh->query($command);
		$rows = $result-> fetch();
		
		$_SESSION['startTime'] = $date;
		$_SESSION['projectName'] = $rows['name'];
		header('Location: clockout.php');
	}

	public static function addManually($userID, $projectID, $start, $end){
		$dbh = new Database();
		//current system time
		$startTime = new DateTime($start);
		$endTime = new DateTime($end);
		$interval = $startTime->diff($endTime);

		$duration = $interval->format('%H:%I:%S');

		$date = date('Y-m-d H:i:s', time());
		$command = "INSERT INTO log (startTime, endTime, status, duration, projectID, userID) VALUES (?,?,?,?,?,?)";
		$statement = $dbh->prepare($command);
		//echo "$projectID\n";
		//echo "$userID\n";
		$result = $statement->execute(array($start, $end, 1, $duration, $projectID, $userID));	
		if($result === FALSE ){
			echo '<div class="alert alert-danger">';
				print_r($dbh->errorInfo());
			echo '</div>';
		}else{
			echo "<div class=\"alert alert-success\"> Your time has been successfully logged. Nide job! </div>";
		}
	}
	
	public static function checkStatus($userID){
		$dbh = new Database();
		$command = "SELECT * FROM log NATURAL JOIN project WHERE status = 0 and userID=$userID";
		$result = $dbh->query($command);
		
		$rows = $result-> fetch();
		if(!$rows){
			//echo "no entry";
		}else{
		//$rows: Array ( [logID] => 5 [0] => 5 [startTime] => 2016-04-04 08:00:00 ... )
			//print_r($rows);
			$_SESSION['startTime'] = $rows['startTime'];
			$_SESSION['projectName'] = $rows['name'];
			header('Location: clockout.php');
		}
	}
	
	public static function clockOut($userID){
		$dbh = new Database();
		$currTime = new DateTime(); //now
		$startTime = new DateTime($_SESSION['startTime'] );
		$interval = $startTime->diff($currTime);

		$end = $currTime->format('Y-m-d H:i:s');
		$duration = $interval->format('%H:%I:%S');  //04:31:24


		$command = "UPDATE log SET status=1, endTime=\"$end\", duration= \"$duration\"  WHERE status = 0 and userID=$userID";
		$statement = $dbh->prepare($command);
		$result = $statement-> execute();
		if($result === FALSE ){
			echo '<div class="alert alert-danger">';
				print_r($dbh->errorInfo());
			echo '</div>';
		}else{
			$_SESSION['logsuccess'] = "yes";
			unset($_SESSION['startTime']);
			unset($_SESSION['projectName']);
			header('Location:clockIn.php');
		}
		//$result = $statement->fetch();
		//return $result[0];
	}
	
	public static function getAllLogs($start){ //TODO has bugs, check return results
		$dbh = new Database();
		$command = "SELECT * FROM log natural JOIN (user natural join project)";		
		$statement = $dbh->prepare($command);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		$LogArray = array();

		$weekBegin = new DateTime($start);
		$weekBegin2 = new DateTime($start);
		$weekEnd = $weekBegin2->add(new DateInterval('P6D'));

		foreach($result as $row){
			$recordWeek = new DateTime($row['startTime']);
			if($recordWeek >= $weekBegin && $recordWeek <= $weekEnd){
				$LogArray[] = array($row['userID'], $row['firstName'], $row['lastName'],  $row['startTime'], $row['endTime'], $row['duration'], $row['name']);
			}
		}
		return $LogArray;
	}

	public static function sqlTimeConvert($sqlTime){
		$timec = explode(":", $sqlTime); //07:00:00 string stored in database datetime
		//P2Y4DT6H8M
		$interval = new DateInterval('PT'.$timec[0].'H'.$timec[1].'M'.$timec[2].'S');
		return $interval;
	}

	//start time stamp example: 2016-5-1
	public static function getUserLogs($userID, $start){
		$dbh = new Database();
		$command = "SELECT * FROM log natural JOIN (user natural join project) WHERE userID=$userID";		
		$statement = $dbh->prepare($command);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		$LogArray = array();
		$displayUser = $result[0]['firstName'].' '.$result[0]['lastName'];
		$totalTable = array(); //an array of project name - duration
		$thisWeekTable = array();

		$weekBegin = new DateTime($start);
		$weekBegin2 = new DateTime($start);
		$weekEnd = $weekBegin2->add(new DateInterval('P6D'));

		foreach($result as $row){
			//add to this week's hours
			$recordWeek = new DateTime($row['startTime']);
			//echo $recordWeek->format('Y-m-d H:i:s');
			//echo $weekBegin->format('Y-m-d H:i:s')."\n";
			//var_dump( $recordWeek < $weekBegin);
			if($recordWeek >= $weekBegin && $recordWeek <= $weekEnd){
				if(!array_key_exists($row['name'], $thisWeekTable)){
					$e = new DateTime('00:00');
					$e->add(Command::sqlTimeConvert($row['duration']));
					$thisWeekTable[$row['name']]= $e;
				}else{
					$y = $thisWeekTable[$row['name']];
					$y->add(Command::sqlTimeConvert($row['duration']));
					$thisWeekTable[$row['name']] = $y;
				}
			}


			//add to the total table
			if(!array_key_exists($row['name'], $totalTable)){
				$e = new DateTime('00:00');
				$e->add(Command::sqlTimeConvert($row['duration']));
				$totalTable[$row['name']]= $e;
			}else{
				$y = $totalTable[$row['name']];
				$y->add(Command::sqlTimeConvert($row['duration']));
				$totalTable[$row['name']] = $y;
			}
		}
		//output stats
		foreach($totalTable as $pname=>$dt){
			$totalDuration = $dt->diff(new DateTime('00:00'));
    		$totalString = $totalDuration->format("%d days %H hr %I min");
    		$thisweekhr = 0;
    		if(array_key_exists($pname, $thisWeekTable)){
    			$thisweekhr = $thisWeekTable[$pname]->diff(new DateTime('00:00'))->format("%d days %H hr %I min");
    		}
    		$LogArray[] = array($pname, $thisweekhr, $totalString);
		}

		return array($displayUser, $LogArray);
	}
	
	public static function getTodayHours($userID){
		$dbh = new Database();
		$command = "SELECT * FROM log natural JOIN user WHERE userID=$userID";		
		$statement = $dbh->prepare($command);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		$dayBegin = new DateTime(); //curr time
		$dayBegin->setTime(0,0,0);//clear out the hoursof the day
		$dayEnd = new DateTime(); //curr time

		$counter = new DateTime('00:00:00');
		foreach($result as $row){
			//print_r($row);
			//add to this week's hours
			$record = new DateTime($row['startTime']);
			if($record >= $dayBegin && $record <= $dayEnd){
				$counter->add(Command::sqlTimeConvert($row['duration']));
			}
		}
		$totalDuration = $counter->diff(new DateTime('00:00:00'));
		return $totalDuration->format("%H hr %I min");
	}

		

	
}
?> 
