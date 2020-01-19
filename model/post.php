<?php
class Post{
	private $conn;
	private $table = "posts";

	public $id;
	public $title;
	public $body;
	public $author;
	public $name;

	public function __construct($db){
		$this->conn = $db;
	}

	public function getAll(){
		$query = 'select * from 
			'.$this->table.'  join categories 
			on '.$this->table.'.category_id = categories.id 
			order by '.$this->table.'.created_at';
		$statement = $this->conn->prepare($query);
		$statement->execute();
		return $statement;
	}
	public function show(){
		$query = 'select * from '.$this->table.'  join categories on '.$this->table.'.category_id = categories.id where '.$this->table.'.id = ? order by '.$this->table.'.created_at';
		$statement = $this->conn->prepare($query);
		$statement->execute([$this->id]);
		return $statement;
	}
	public function create(){
		$sql = 'select id from categories where name = ?';
		$res = $this->conn->prepare($sql);
		$res->execute([$this->name]);
		$cat_data = $res->fetch(PDO::FETCH_ASSOC);
		$cat_id = $cat_data['id'];

		$query = 'insert into '.$this->table.'(title,body,author,category_id) values (?,?,?,?)';
		$statement = $this->conn->prepare($query);
		$statement->execute([$this->title,$this->body,$this->author,$cat_id]);
		$this->id = $this->conn->lastInsertId();
		$last_result = $this->show();
		return $last_result;
	}
}

?>