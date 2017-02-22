<?php
	include('include/session.php');
	include 'include/header.php';
?>
<link rel="stylesheet" href="css/style.css">
<?php
	$post_id = $_GET['post_id'];
	if (!empty($post_id)){	
		//include 'admin/db_connect.php'; 	
		$post_results = db_query("SELECT * FROM `posts` WHERE `post_id` ='$post_id'");
		while($row = $post_results->fetch_assoc()){ 
			if($login_session==$row['poster_name']){
			?>
			<div class="post">
				<h1>Post</h1>
				<form id="update" action="include/update.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
					<input type="text" name="title" value="<?php echo $row['title']; ?>" />
					<textarea name="discretion"  cols="80" rows="20" ><?php echo $row['discretion']; ?></textarea>
					<input id="file" name="file" type="file" />
					<br/><br />
					<input type="submit" value="Submit" />
				</form>
			</div>
			
			<?php }else{
				echo '<div class="post"><h1>You are not owner this post</h1></div>';
			}}	
	}else{ ?>
	<div class="post">
		<h1>Post</h1>
		<form id="new_post" action="include/post_insert.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="poster_name" value="<?php echo $login_session ?>" />
			<input type="text" name="title" placeholder="Title"  required />
			<textarea name="discretion" placeholder="Type your Message" cols="80" rows="20"  required></textarea>
			<input id="file" name="file" type="file"  required />
			<br/><br />
			<input type="submit" value="Submit" />
		</form>
	</div>
	
<?php } ?>

