<?php
	class Gift{
		private $_user_id;
		private $_conn;
		public function __construct($user_id, $conn){
			$this->_user_id= $user_id;
			$this->_conn= $conn;
		}
		public function assignGift($to_user_id){
			$queryToInsert= "INSERT INTO gifts(to_user_id, from_user_id, given_at, created_at) VALUES(".$to_user_id.", ".$this->_user_id.", '".date("Y-m-d H:i:s", time())."', '".date("Y-m-d H:i:s", time())."')";
			$result= mysql_query($queryToInsert, $this->_conn);
			if($result){
				return mysql_insert_id();
			}else{
				return "Error";
			}
		}
		public function claimGift($from_user_id){
			$queryToInsert= "INSERT INTO gifts(to_user_id, from_user_id, is_claim, created_at) VALUES( ".$this->_user_id.",".$from_user_id.", 1, '".date("Y-m-d H:i:s", time())."')";
			$result= mysql_query($queryToInsert, $this->_conn);
			if($result){
				return mysql_insert_id();
			}else{
				return "Error";
			}
		}
		public function verifyGiftClaim($claim_id){
			$queryToUpdate= "UPDATE gifts SET is_claim=0, given_at='".date('Y-m-d H:i:s', time())."' WHERE id=".$claim_id;
			$result= mysql_query($queryToUpdate, $this->_conn);
			if($result){
				return 1;
			}else{
				return "Error";
			}
		}
		// Standart Getters and Setters Functions
		public function setUserId($user_id){
			$this->_user_id= $user_id;
		}
	}
?>
