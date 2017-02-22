<?php
	include '../admin/db_connect.php';
	$action = $_POST["action"];
	if(!empty($action)) {
		switch($action) {
			
			case "edit":
			$result = db_query("UPDATE comments set message = '".$_POST["txtmessage"]."' WHERE  id=".$_POST["message_id"]);
			if($result){
				echo $_POST["txtmessage"];
			}
			break;			
			
			case "delete": 
			if(!empty($_POST["message_id"])) {
				db_query("DELETE FROM comments WHERE id=".$_POST["message_id"]);
			}
			break;
		}
	}
?>