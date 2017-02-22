<?php
	include '../admin/db_connect.php';
	
	$post_id = $_POST["post_id"];
	$poster_name = $_POST["poster_name"];
	$txtmessage = $_POST["txtmessage"];
	$empty = $_FILES['file']['tmp_name'];
	if (!empty($empty)) {
		$image = $_FILES['file']['tmp_name'];
		$img = file_get_contents($image);
		$image = addslashes(file_get_contents($_FILES['file']['tmp_name'])); //SQL Injection defence!
		$image_name = addslashes($_FILES['file']['name']);
		}else{$image ='';
		$img ='';
	}
	$result = db_query("INSERT INTO `comments`(`post_id`, `comment_name`, `message`, `comment_image`) VALUES ('$post_id', '$poster_name', '$txtmessage','$image')");
	if($result){
		$connection = db_connect();
		$insert_id =mysqli_insert_id($connection);
		
		echo '<div class="message-box"  id="message_' . $insert_id . '"><div><div class="commants_btn">
		<button class="btn-style-edit" name="edit" onClick="showEditBox(this,'.$insert_id. ')">Edit</button>
		<button class="btn-style-delete" name="delete" onClick="callCrudAction(\'delete\','.$insert_id .')">Delete</button>
		</div>
		<span><h3> '. $poster_name .' :</h3><div class="message-content">'.$txtmessage.'</div></span>';
		
		if (!empty($img)) {
			echo '<div class="image_size"><img src="data:image/jpeg;base64,'.base64_encode($img).'"/ width="100px" height="80"></div>';
		}
		echo '<br/>Comments Date :'. date('Y-m-d H:i:s');
	}
	
?>
