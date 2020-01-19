<?php
class Database{
	private $host = "localhost";
	private $db_name = "model_api";
	private $username = "root";
	private $password = "";
	private $conn;

	public function connect(){
		$this->conn = null;
		try{
			$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
			$this->conn->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $err){
			echo "unable to set up connection ".$err;
		}
		return $this->conn;
	}
	
}

?>