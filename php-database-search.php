<?php 
	function custom_echo($x, $length){
		if(strlen($x)<=$length){	
			echo $x;
			}else{
			$y=substr($x,0,$length) . '....';
			echo '<p>'.$y .'</p>'; 
		}
	}
	$config = parse_ini_file('admin/config.ini');
	$host = "localhost";
	$user = $config['username'];
	$password = $config['password'];
	$database_name = $config['dbname'];
	$pdo = new PDO("mysql:host=$host;dbname=$database_name", $user, $password, array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	));
	$search=$_POST['search'];
	$query = $pdo->prepare("select * from posts where title LIKE '%$search%' OR discretion LIKE '%$search%' OR poster_name LIKE '%$search%'  LIMIT 0 , 10");
	$query->bindValue(1, "%$search%", PDO::PARAM_STR);
	$query->execute();
	
	if (!$query->rowCount() == 0) {
		echo "Search found :<br/>";				
		while ($results = $query->fetch()) {
			
			echo '<a href="search_view.php?post_id='.$results['post_id'].'">'. $results['title'].'</a>';
			echo custom_echo($results['discretion'], 100);				
			echo '<h5>Author :'.$results['poster_name'].'</h5>';				
			echo '<p> Last Modifiy - '.$results['post_date_time']. '</p><br/>';				
		}	
	} else {}
	$query = $pdo->prepare("select * from comments where comment_name LIKE '%$search%' OR message LIKE '%$search%' LIMIT 0 , 10");
	$query->bindValue(1, "%$search%", PDO::PARAM_STR);
	$query->execute();
	
	if (!$query->rowCount() == 0) {
		
		while ($results = $query->fetch()) {
			
			echo '<a href="search_view.php?post_id='.$results['post_id'].'">'. $results['comment_name'].'</a>';
			echo custom_echo($results['message'], 100);				
			echo '<h5>Author :'.$results['comment_name'].'</h5>';				
			echo '<p> Last Modifiy - '.$results['comment_date']. '</p><br/>';				
		}	
        } else {
		echo 'Nothing found';
	}
	
	
?>
