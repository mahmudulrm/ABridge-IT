<?php
	include('include/session.php');
	include 'include/header.php';
?>
<div class="container">
	<header>
		<h1> ABridge IT</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="post.php?post_id=">Create a Post</a></li>
			<?php if (empty($login_session)) { ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="registration.php">Registration</a></li>
			<?php } ?>
			<li><a href="search.php">Search</a></li>
			<?php if (!empty($login_session)) { ?>
				<li><a href="include/logout.php">Logout</a></li>
			<?php } ?>
		</ul>
		<?php if (!empty($login_session)) { ?>
			<h4>Welcome : <?php echo $login_session; ?></h4>
		<?php } ?>
	</nav>	
	<?php 
		$post_id =$_GET['post_id'];
		$post_results = db_query("SELECT * FROM `posts`  WHERE `post_id` ='$post_id'");
		while($row = $post_results->fetch_assoc()){ ?> 
		<article>	
			<?php			
				echo  '<h1>'.$row["title"] .'</h1>';
				echo '<div class="image"><img src="data:image/jpeg;base64,'. base64_encode( $row['image'] ).'"/></div>';
				echo '<p>'.$row["discretion"].'</p>';
				echo '<p>Author :'.$row["poster_name"].'</p>';
				$date = $row["post_date_time"];
				$valid_date = date( 'M-j-Y', strtotime($date));
				echo 'Post Date :'. $date;
				$post_id = $row["post_id"];
				echo '<br/><h2>Comments: </h2>';
				
				$comment_message = runQuery("SELECT * FROM comments WHERE `post_id` ='$post_id' ");	
			?>
			
			<div class="container-style">
				<div id="comment-list-box_<?php echo $post_id;?>">
					<?php
						if(!empty($comment_message)) {
							foreach($comment_message as $k=>$v) {
							?>
							<div class="message-box" id="message_<?php echo $comment_message[$k]["id"];?>">
								<div class="commants_btn" id="check_login">
									<?php $comment_name = $comment_message[$k]["comment_name"]; ?>
									<?php if ($login_session==$comment_name){ ?>
										<button class="btn-style-edit" name="edit" onClick="showEditBox(this,<?php echo $comment_message[$k]["id"]; ?>)">Edit</button>
										<button class="btn-style-delete" name="delete" onClick="callCrudAction('delete',<?php echo $comment_message[$k]["id"]; ?>)">Delete</button>
										<?php }else{ ?> 
										<button class="btn-style-edit" onClick="divFunction()" id="test" name="edit">Edit</button>
										<button class="btn-style-delete" onClick="divFunction()" id="test" name="delete">Delete</button>
									<?php } ?>	
								</div>
								<span><h3><?php echo $comment_message[$k]["comment_name"]; ?> :</h3>
								<div class="message-content"><?php echo $comment_message[$k]["message"]; ?></div></span>		
								<?php
									$empty = $comment_message[$k]["comment_image"];
									if (!empty($empty)) { ?>
									<div class="image_size"><img src="data:image/jpeg;base64,<?php echo base64_encode( $comment_message[$k]["comment_image"] ); ?>"/ width="100px" height="80"></div>
									<?php } 
									echo '<br/><p>Comments Date :'. $date .'</p>';
								?>
							</div>
							<?php
							}
						} ?>
						<div id="image_<?php echo $post_id; ?>"></div>
						
				</div>
				<div class="upload">
					<div id="image_preview_<?php echo $post_id; ?>"><img id="previewing_<?php echo $post_id; ?>" src="images/up.jpg"/></div>
				</div>
				
				<form id="fileUploadForm_<?php echo $post_id; ?>" action="include/image_commment.php"  method="post" enctype="multipart/form-data">
					<div id="frmAdd"><textarea name="txtmessage" class="textarea-style" id="txtmessage" cols="80" rows="2" ></textarea>
						<input type="hidden" id="post_id" name="post_id" value="<?php echo $post_id; ?>" />
						<input type="hidden" id="poster_name" name="poster_name" value="<?php echo $login_session; ?>" />
						<div id="selectImage">
							<div class="BroweForFile">
								<label for="file_<?php echo $post_id; ?>">
									<img src="images/im.png"/>
								</label>
								<input id="file_<?php echo $post_id; ?>" name="file" type="file" />
							</div>
						</div>
						<p><button id="btn-style-add" name="submit">Comment</button></p>
						
					</div>
					<img src="images/LoaderIcon.gif" id="loaderIcon" style="display:none" />
				</form>
				<script>
					$(document).ready(function (e) {
						$("#fileUploadForm_<?php echo $post_id; ?>").on("submit", function(event) {
							event.preventDefault();
							var formObj = $(this);
							var formURL = formObj.attr("action");
							var formData = new FormData(this);
							$.ajax({
								url: formURL,
								type: 'POST',
								data:  formData,
								mimeType:"multipart/form-data",
								contentType: false,
								cache: false,
								processData:false,
								success: function(data, textStatus, jqXHR)
								{
									$("#txtmessage").val(' ');
									$("#image_<?php echo $post_id; ?>").append(data);
									$('#image_preview_<?php echo $post_id; ?>').html('');
									$('#image_preview_<?php echo $post_id; ?>').html('<img id="previewing_<?php echo $post_id; ?>" src="images/up.jpg"/>');
									
								},
							});
						});
						$(function () {
							$("#file_<?php echo $post_id; ?>").change(function() {
								var file = this.files[0];
								var imagefile = file.type;
								var match= ["image/jpeg","image/png","image/jpg"];
								if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
								{
									$('#previewing_<?php echo $post_id; ?>').attr('src','noimage.png');
									return false;
								}
								else
								{
									var reader = new FileReader();
									reader.onload = imageIsLoaded;
									reader.readAsDataURL(this.files[0]);
								}
							});
						});
						function imageIsLoaded(e) {
							$('#image_preview_<?php echo $post_id; ?>').css("display", "block");
							$('#previewing_<?php echo $post_id; ?>').attr('src', e.target.result);
							$("#preview_<?php echo $post_id; ?>").attr('src', e.target.result);
							$('#previewing_<?php echo $post_id; ?>').attr('width', '100px');
							$('#previewing_<?php echo $post_id; ?>').attr('height', '80px');
							
						};
					});	
				</script>	
			</div>	
			<hr />
		</article>
		<?php	
		}
		include 'model.php';
	?>
	<footer>Copyright 2017 by Mahmudul Hasan | Giving is the best communication</footer>
</div>
</body>
</html>