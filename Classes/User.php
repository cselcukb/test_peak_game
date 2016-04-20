<?php
	class User{
		private $_user_id;
		private $_conn;
		private $_users;
		private $_claims;
		private $_daily_gift_limit;
		public function __construct($user_id, $conn, $daily_gift_limit){
			$this->_user_id= $user_id;
			$this->_conn= $conn;
			$this->_daily_gift_limit= $daily_gift_limit;
		}
		public function fetchUsers(){
			$user_data= array();
			$queryToSelect= "SELECT u.*, COUNT(g.id) AS total_gifts, (SELECT COUNT(g2.id) FROM users u2 LEFT JOIN gifts g2 ON g2.to_user_id=u2.id AND g2.given_at >= '".date('Y-m-d 00:00:00', time()-60*60)."' WHERE from_user_id=".$this->_user_id." AND u2.id=u.id) AS daily_total_by_user FROM users u LEFT JOIN gifts g ON g.to_user_id=u.id AND g.given_at >= '".date('Y-m-d H:i:s', time()-60*60*24*7)."' WHERE u.id !=".$this->_user_id." GROUP BY u.id";
			$queryToSelect= mysql_query($queryToSelect, $this->_conn);
			while($row= mysql_fetch_array($queryToSelect)){
				$user_data[]= $row;
			}
			$this->_users= $user_data;
		}
		public function isNotDailyTotal($to_user_id){
			$queryToSelect= "SELECT COUNT(g.*) AS total FROM users u LEFT JOIN gifts g ON g.to_user_id=".$to_user_id." AND g.given_at >= '".date('Y-m-d 00:00:00', time()-60*60)."') WHERE g.from_user_id=".$this->_user_id;
			$queryToSelect= mysql_query($queryToSelect, $this->_conn);
			$row= mysql_fetch_assoc($queryToSelect);
			if($row['total'] < $this->_daily_gift_limit){
				return 1;
			}else{
				return 0;
			}
		}
		public function fetchDailyGiftTotal($to_user_id){
			$queryToSelect= "SELECT COUNT(g.*) AS total FROM users u LEFT JOIN gifts g ON g.to_user_id=".$to_user_id." AND g.given_at >= '".date('Y-m-d 00:00:00', time()-60*60)."') WHERE g.from_user_id=".$this->_user_id;
			$queryToSelect= mysql_query($queryToSelect, $this->_conn);
			$row= mysql_fetch_assoc($queryToSelect);
			return $row['total'];
		}
		public function fetchTotalClaims(){
			$claim_datas= array();
			$queryToSelect= "SELECT u.username AS username, g.id FROM gifts g LEFT JOIN users u ON g.to_user_id=u.id WHERE g.from_user_id=".$this->_user_id." AND g.is_claim=1";
			$queryToSelect= mysql_query($queryToSelect, $this->_conn);
			while($row= mysql_fetch_array($queryToSelect)){
				$claim_datas[]= $row;
			}
			$this->_claims= $claim_datas;
		}
		// Login User
		public static function login($username, $password, $conn){
			$queryToSelect= "SELECT id, username FROM users WHERE username='".$username."' AND password='".md5($password)."'";
			$queryToSelect= mysql_query($queryToSelect, $conn);
			$user= mysql_fetch_assoc($queryToSelect);
			return $user;
		}
		// Output Claims HTML
		public function generateClaimsHTML(){
			$outputHTML= "";
			foreach($this->_claims AS $claim){
				$outputHTML.= "<tr>";
					$outputHTML.= "<td>";
					$outputHTML.= $claim['username'];
					$outputHTML.= "</td>";
					$outputHTML.= "<td>";
					$outputHTML.= "<button id='claim_btn_".$claim['id']."' class='verify_claim_button btn'>Verify Claim</button>";
					$outputHTML.= "<input id='claim_btn_".$claim['id']."_data' type='hidden' value='".$claim['id']."'>";
					$outputHTML.= "</td>";
				$outputHTML.= "</tr>";
			}
			return $outputHTML;
		}
		// Output Users HTML
		public function generateUsersHTML(){
			$outputHTML= "";
			foreach($this->_users AS $user){
				$outputHTML.= "<tr>";
					$outputHTML.= "<td>";
					$outputHTML.= $user['username'];
					$outputHTML.= "</td>";
					$outputHTML.= "<td>";
					$outputHTML.= $user['daily_total_by_user'];
					$outputHTML.= "</td>";
					$outputHTML.= "<td>";
					$outputHTML.= $user['total_gifts'];
					$outputHTML.= "</td>";
					if($user['daily_total_by_user'] < $this->_daily_gift_limit){
						$outputHTML.= "<td>";
						$outputHTML.= "<button id='send_gift_btn_".$user['id']."' class='send_gift_button btn'>Send Gift</button>";
						$outputHTML.= "<input id='send_gift_btn_".$user['id']."_data' type='hidden' value='".$user['id']."'>";
					$outputHTML.= "<button id='claim_gift_btn_".$user['id']."' class='claim_gift_button btn'>Claim Gift</button>";
					$outputHTML.= "<input id='claim_gift_btn_".$user['id']."_data' type='hidden' value='".$user['id']."'>";
						$outputHTML.= "</td>";
					}else{
						$outputHTML.= "<td>";
						$outputHTML.= "<button class='_button btn'>Daily Limit</button>";
					$outputHTML.= "<button id='claim_gift_btn_".$user['id']."' class='claim_gift_button btn'>Claim Gift</button>";
					$outputHTML.= "<input id='claim_gift_btn_".$user['id']."_data' type='hidden' value='".$user['id']."'>";
						$outputHTML.= "</td>";
					}
					/*
					$outputHTML.= "<td>";
					$outputHTML.= "<button id='claim_gift_btn_".$user['id']."' class='claim_gift_button btn'>Claim Gift</button>";
					$outputHTML.= "<input id='claim_gift_btn_".$user['id']."_data' type='hidden' value='".$user['id']."'>";
					$outputHTML.= "</td>";
					*/
				$outputHTML.= "</tr>";
			}
			return $outputHTML;
		}
		// Standart Getters and Setters Functions
		public function setUserId($user_id){
			$this->_user_id= $user_id;
		}
		public function getUsers(){
			return $this->_users;
		}
	}
?>
