<?php
   include('include/header.php');
?>
<div class="form">
<div id="login">   
	<h1>Welcome Back!</h1>
	<h1><div id='error'></div></h1>
	<form id="login_user" action="include/login.php" method="POST">
		<div class="field-wrap">
			<label>
				User Name<span class="req">*</span>
			</label>
			<input type="text" name="user_login" id="user_login" required autocomplete="off"/>
		</div>
		<div class="field-wrap">
			<label>
				Password<span class="req">*</span>
			</label>
			<input type="password" name="pass" id="pass" required autocomplete="off"/>
		</div>
	<button class="button button-block"/>Log In</button>
	</form>
</div>
</div> <!-- /form -->

<script src="js/index.js"></script>
<script>
 	$("#login_user").on("submit", function(event) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "include/login.php",
			data: $(this).serialize(),
			success: function(data) {
			
			if(data == 1 ){
             success:  window.location.href = 'welcome.php'; 
            };
			$("#error").html('<span style="color:red;"><span style="font-size:15px;">Incorrect UserName and Credentials, Try again...</span></span>');
			},
		});
	});
	
</script>
</body>
</html>