<?php
class user_model extends main_model {

	public function __construct()
	{		
		return parent::__construct();
	}
	public function createTable() {
		// sql to create table
		$sql = "CREATE TABLE users (
			id 			INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			username			TEXT(255)    NOT NULL,
			nickname			VARCHAR(255) NOT NULL,
			email				VARCHAR(555) NOT NULL,
			password		    VARCHAR(555) NOT NULL,
			created         	DATETIME	 NOT NUll,
		)";

		$result = $this->con->query($sql);
		return $result;
	}

	public function addRecord($datas) {
		$datas['password'] = md5($datas['password']);		
		return parent::addRecord($datas);
	}

	public function loginData($user) {
		$loginPass = md5($user['password']);
		$loginEmail = $user['email'];
		$query = "SELECT * FROM $this->table where email = '$loginEmail' and password = '$loginPass'";
		$result = mysqli_query($this->con,$query);
		
		if($result) {
			$record = mysqli_fetch_assoc($result);
		} else $record=false;
		return $record;
	}
}
?>
