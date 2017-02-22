<?php
	include('include/session.php');
	include 'include/header.php';
?>
<link rel="stylesheet" href="css/search.css">
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
	
	<article>
		<div id="main_body">	
			<form id="search_from"  method="POST">
				<input type="text" id="search" name="search" placeholder=" Search here ... "/>
				<input type="submit" id="submit" value="Search" />
				<hr />
			</form>
			<div id="search_value"></div>
		</div>
		<script>
			$("#search_from").on("submit", function(event) {
				event.preventDefault();
				$.ajax({
					type: "POST",
					url: "php-database-search.php",
					data: $(this).serialize(),
					success: function(data) {
						$("#search_value").html(data); 
					},
				});
			});	
		</script>
	</article>		
	<footer>Copyright 2017 by Mahmudul Hasan | Giving is the best communication</footer>
</div>
</body>
</html>