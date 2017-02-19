<?php
	include 'admin/db_connect.php';
    session_start();
	
	$user = $_SESSION['SESS_LOGIN_USER'];
	$result = db_query('SELECT `user_name` FROM `login` WHERE `login`.`user_name` = "'. $user .'"');
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	$login_session = $row['user_name'];
	
	if(!isset($_SESSION['SESS_LOGIN_USER'])){
		header("location:index.php");
	}
?>