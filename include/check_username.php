<?php
	include '../admin/db_connect.php';
	$user = strip_tags($_POST['user']);
	
	$result = db_query('SELECT `user_name` FROM `login` WHERE `login`.`user_name` = "'. $user .'"');
	$row=mysqli_num_rows($result);
	if($row>0){
		echo "<span style='color:brown;'>Sorry Not Available!!!</span>";
		}else{
		echo "<span style='color:green;'>Available</span>";
	}	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	