<?php
	function db_connect() {
		static $connection;
		if(!isset($connection)) {
			$config = parse_ini_file('config.ini'); // Connect Credential
			$connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
		}
		if($connection === false) {
			return mysqli_connect_error(); 
		}
		return $connection;
	}
	
	function db_query($query) {
		$connection = db_connect();
		$result = mysqli_query($connection,$query);
		return $result;
	}
		function runQuery($query) {
			$result = db_query($query);
			
		while($row = $result->fetch_assoc()) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = db_query($query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
	
	
?>