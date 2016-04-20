<?php
	if($is_valid){	// Is request processed by controller
		include dirname(__FILE__)."/../Classes/Gift.php";
		if($params['from_user_id']){
			$gift= new Gift($_SESSION['user_id'], $conn1);
			$result= $gift->claimGift($params['from_user_id']);
			echo $result;
		}
	}else{ // Redirect If no User
		header("Location=/login.php");
	}
?>
