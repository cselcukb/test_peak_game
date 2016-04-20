<?php
	if($is_valid){	// Is request processed by controller
		$userClass= new User($_SESSION['user_id'], $conn1, $daily_gift_limit);
		$userClass->fetchTotalClaims();
		$claimContentHTML= $userClass->generateClaimsHTML();
		echo $claimContentHTML;
	}else{ // Redirect If no User
		header("Location=/login.php");
	}
?>
