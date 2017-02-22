<?php
	include '../admin/db_connect.php';
	$id=$_GET['post_id'];
	$result = db_query("DELETE FROM posts WHERE post_id='$id'");
	if($result === false) {
		echo "Not connection";
		} else {
		$result = db_query("DELETE FROM comments WHERE post_id='$id'");
		header("Location: ../index.php");
	}
	
?>