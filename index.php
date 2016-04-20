<?php
	// Include Necessary Files
	include "config.php";
	include "standart_connection.php";
	include "Classes/User.php";
	if($_SESSION['user_id']){	// If User Logged in
		$userClass= new User($_SESSION['user_id'], $conn1, $daily_gift_limit);
		// Fetch and Get User Content HTML
		$userClass->fetchUsers();
		$userContentHTML= $userClass->generateUsersHTML();
		// Fetch and Get Claim Content HTML
		$userClass->fetchTotalClaims();
		$claimContentHTML= $userClass->generateClaimsHTML();
		include "frontend/templates/index.php";
	}else{ // Redirect If no User
		header('Location: login.php');
	}
?>
