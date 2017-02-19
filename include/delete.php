<?php
	include '../admin/db_connect.php';
	
	
	$id=$_POST['id'];
	$result = db_query("DELETE FROM login WHERE u_id='$id'");
	if($result === false) {
		echo "Not connection";
		} else {
		echo "We successfully DELETE a row into the database";
	}
	
?>