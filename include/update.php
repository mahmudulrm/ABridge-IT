<?php
	include '../admin/db_connect.php';
    $post_id = trim($_POST['post_id']);
    $title = trim($_POST['title']);
    $discretion = trim($_POST['discretion']);
	$empty = $_FILES['file']['tmp_name'];
	if (!empty($empty)) {
		$image = $_FILES['file']['tmp_name'];
		$img = file_get_contents($image);
		$image = addslashes(file_get_contents($_FILES['file']['tmp_name'])); //SQL Injection defence!
		$image_name = addslashes($_FILES['file']['name']);
		}else{$image ='';
		$img ='';
	}
	$result = db_query("UPDATE `posts` SET `title` = '$title', `discretion` = '$discretion', `image` = '$image' WHERE `posts`.`post_id` = '$post_id'");
	if($result === false){
		echo "Not connection";
		} else {
		header("Location: ../search_view.php?post_id=$post_id");
	}
	
?>

