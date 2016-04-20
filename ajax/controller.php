<?php
	// Include Necessary Files
	include dirname(__FILE__)."/../config.php";
	include dirname(__FILE__)."/../standart_connection.php";
	include dirname(__FILE__)."/../Classes/User.php";
	if($_SESSION['user_id']){	// If User Logged in
		if(isset($_POST['task']) && $_POST['task']){
				$params= $_POST['params'];
				$is_valid= "1";
				switch($_POST['task']){
					case 'fetch_users':
						include dirname(__FILE__)."/fetchUsers.php";
						break;
					case 'fetch_claims':
						include dirname(__FILE__)."/fetchClaims.php";
						break;
					case 'assign_gift':
						if($params['to_user_id']){
							$userClass= new User($_SESSION['user_id'], $conn1, $daily_gift_limit);
							$isNotDailyTotal= $userClass->isNotDailyTotal();
							if($isNotDailyTotal){
								include dirname(__FILE__)."/assignGift.php";
							}
							break;
						}else{
							header("Location: /login.php");
							break;
						}
					case 'claim_gift':
						include dirname(__FILE__)."/claimGift.php";
						break;
					case 'claim_gift_verification':
						include dirname(__FILE__)."/verifyGiftClaim.php";
						break;
				}
		}else{
			header("Location: /login.php");
		}
	}else{ // Redirect If no User
		header("Location: /login.php");
	}
?>
