<?php
	include('include/header.php');
	include 'admin/db_connect.php';
    session_start();
?>
<link rel="stylesheet" href="css/style.css">
<div class="form">
	<div id="signup">   
		<h1>Registration <span> <a href="index.php">GoHome</a> <a href="login.php">Login</a> </span></h1>
		<form id="sign_up"  method="POST">
			<div class="top-row">
				<div class="field-wrap">
					<label>
						First Name<span class="req">*</span>
					</label>
					<input type="text" name="frist_name" id="frist_name" required autocomplete="off" />
				</div>
				<div class="field-wrap">
					<label>
						Last Name<span class="req">*</span>
					</label>
					<input type="text" name="last_name" id="last_name" required autocomplete="off"/>
				</div>
			</div>
			<div class="top-row">
				<div class="field-wrap">
					<label>
						User Name<span class="req">*</span>
					</label>
					<input type="text" name="user" id="user" required autocomplete="off"/>
				</div>
				<div class="field-wrap">
					<label>
						<div id='result'></div> 
					</label>	
				</div>
			</div>
			<div class="field-wrap">
				<label>
					Enter Password<span class="req">*</span>
				</label>
				<input type="password" name="password" id="password"required autocomplete="off"/>
			</div>
		<button type="submit" class="button button-block"/>Get Started</button>
	</form>
</div>

</div> <!-- /form -->
<script src="js/index.js"></script>
<script>
 	$("#sign_up").on("submit", function(event) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "include/signup.php",
			data: $(this).serialize(),
			success: function(data) {
				if(data == 1 ){
					success:  window.location.href = 'login.php';
					} else {
					$("#result").html('<span style="background-color:red;"><span style="color:white;">Sorry Not Available!!!</span></span>'); 
				};
			},
		});
	});	
	$(document).ready(function()
	{    
		$("#user").keyup(function()
		{		
			var name = $(this).val();				
			if(name.length > 3)
			{		
				$("#result").html('<img src="images/loading.gif" /> Checking...');			
				$.ajax({				
					type : 'POST',
					url  : 'include/check_username.php',
					data : $(this).serialize(),
					success : function(data)
					{
						$("#result").html(data);
					}
				});
				return false;
				
			}
			else
			{
				$("#result").html('');
			}
		});
		
	});
	</script>	