<?php
	// Include Necessary Files
	include "config.php";
	include "standart_connection.php";
	include "Classes/User.php";
	if(!$_SESSION['user_id']){	// If User Logged in
		if(sizeof($_POST) && $_POST['username'] && $_POST['password']){
			$result= User::login(secure_db($_POST['username']), secure_db($_POST['password']), $conn1);
			if($result && isset($result['id']) && $result['id']){
				$_SESSION['user_id']= $result['id'];
				$_SESSION['username']= $result['username'];
				header("Location: index.php");
			}else{
				$warning_message= "User is not found!";
				include "frontend/templates/login.php";
			}
		}else{
			include "frontend/templates/login.php";
		}
	}else{ // Redirect If no User
		header("Location:index.php");
	}
?>
