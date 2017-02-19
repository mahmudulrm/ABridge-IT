<?php 
	include '../admin/db_connect.php';
	$frist_name = $_POST['frist_name'];
	$last_name = $_POST['last_name'];
	$user = strip_tags($_POST['user']);
	$user = htmlspecialchars($user);
	
	$pass = trim($_POST['password']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);
	$password = hash('sha256', $pass);
	
	$result = db_query('SELECT `user_name` FROM `login` WHERE `login`.`user_name` = "'. $user .'"');
	$num_rows = mysqli_num_rows($result);
	if($num_rows>0){
		echo 0;
	}else{
		$result = db_query("INSERT INTO `login` (`u_id`, `frist_name`, `last_name`, `user_name`, `password`) VALUES (NULL, '$frist_name', '$last_name', '$user', '$password');");	
		echo 1;
	}	
