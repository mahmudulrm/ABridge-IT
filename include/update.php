<?php
	include '../admin/db_connect.php';
	
	$id = 7;
	$new = "Shohag";
	$result = db_query("UPDATE `login` SET `last_name` = '$new' WHERE `login`.`u_id` = 6;");
	if($result === false) {
		echo "Not connection";
		} else {
		echo "We successfully update a row into the database";
	}
	
?>

