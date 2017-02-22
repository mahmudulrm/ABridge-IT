<?php
	ob_start();
	session_start();
	require_once '../admin/db_connect.php';
	
	// prevent sql injections/ clear user invalid inputs
	$user_name = trim($_POST['user_login']);
	$user_name = strip_tags($user_name);
	$user_name = htmlspecialchars($user_name);	
	$pass = trim($_POST['pass']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);
	
	$password = hash('sha256', $pass);	
	$result = db_query('SELECT * FROM `login` WHERE `login`.`user_name` = "'. $user_name .'" AND `login`.`password` = "'. $password .'"');
	$num_rows = mysqli_num_rows($result);
	
	if( $num_rows>0) {
		session_regenerate_id();
		$_SESSION['SESS_LOGIN_USER'] = $user_name;
		session_write_close();
		echo 1;
		exit();
		} else {
		echo 0;
	}
	
	
	ob_end_flush();
	
?>