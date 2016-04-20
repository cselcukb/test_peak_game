<?php
	$host= "127.0.0.1";
	$user= "root";
	$site_root= "http://test_peak_game";
	$password= "";
	$database= "test_peak_games";

	$daily_gift_limit= 3;
	session_start();
	function secure_db($value){
    return htmlspecialchars(strip_tags(mysql_real_escape_string($value)));
	}
?>
