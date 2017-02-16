<?php
    // mysql database connection details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mars_core";

    // open connection to mysql database
    $connection = mysqli_connect($host, $username, $password, $dbname) or die("Connection Error " . mysqli_error($connection));
    
    // fetch mysql table rows   
	$sql = "SELECT Date, AVG(APH) AS Average FROM demo GROUP By Date";
	$result = mysqli_query($connection, $sql) or die("Selection Error " . mysqli_error($connection));

    $fp = fopen('chart.csv', 'w');

	fputcsv($fp, array('Date', 'Average'));
		while($row = mysqli_fetch_assoc($result)){
			fputcsv($fp, $row);
		}
    
    fclose($fp);
    //close the db connection
    mysqli_close($connection);
?>