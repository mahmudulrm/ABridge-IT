<?php
	include '../admin/db_connect.php';
	
	$post_id = trim($_POST['post_id']);
	$comment_name = trim($_POST['comment_name']);
	$comments = trim($_POST['comments']);
	
	$image = $_FILES['file']['tmp_name'];
	$img = file_get_contents($image);
	$comment_image = addslashes(file_get_contents($_FILES['file']['tmp_name'])); //SQL Injection defence!
	$image_name = addslashes($_FILES['file']['name']);
	
	$result = db_query("INSERT INTO `comments`(`post_id`, `comment_name`, `comments`, `comment_image`) VALUES ('$post_id','$comment_name','$comments','$comment_image')");
	if($result === false) {
		echo "Not connection";
		} else {
		header('Location: ../view.php');
	} 
	
?>	
	
	
