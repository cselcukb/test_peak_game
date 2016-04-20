<?php
	// Include Necessary Files
	include dirname(__FILE__)."/../config.php";
	include dirname(__FILE__)."/../standart_connection.php";
	$i= 1;
	while($i <= 5){
		$queryToInsert= "INSERT INTO users(username, password, full_name) VALUES('test".$i."', '".md5('test'.$i)."', 'test".$i."')";
		mysql_query($queryToInsert, $conn1) or die(mysql_error());
		$i++;
	}
?>
