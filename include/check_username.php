<?php
	include '../admin/db_connect.php';
	$user = strip_tags($_POST['user']);
	
	$result = db_query('SELECT `user_name` FROM `login` WHERE `login`.`user_name` = "'. $user .'"');
	$num_rows = mysqli_num_rows($result);
	if($num_rows>0){
		echo "<span style='color:brown;'>Sorry Not Available!!!</span>";
	}else{
		echo "<span style='color:green;'>Available</span>";
	}	