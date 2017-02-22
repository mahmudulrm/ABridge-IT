<?php
	include '../admin/db_connect.php';
    $title = trim($_POST['title']);
    $discretion = trim($_POST['discretion']);
    $poster_name = trim($_POST['poster_name']);
	
	
	$empty = $_FILES['file']['tmp_name'];
	if (!empty($empty)) {
		$image = $_FILES['file']['tmp_name'];
		$img = file_get_contents($image);
		$image = addslashes(file_get_contents($_FILES['file']['tmp_name'])); //SQL Injection defence!
		$image_name = addslashes($_FILES['file']['name']);
		}else{$image ='';
		$img ='';
	}
	//echo  $title . $discretion  . $poster_name. $image ;
	
	$result = db_query("INSERT INTO `posts`(`title`, `discretion`, `image`, `poster_name`) VALUES ('$title','$discretion','$image','$poster_name')");
	if($result === false) {
		echo "Not connection";
		} else {
		header('Location: ../index.php');
	} 
	
