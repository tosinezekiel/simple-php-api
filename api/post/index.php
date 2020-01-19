<?php 

header('Allow-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once "../../config/database.php";
include_once "../../model/post.php";


$db = new Database;
$post = new Post($db->connect());
$results = $post->getAll();
$post_arr = array();
$post_arr['data'] = array();
$post_arr['version'] = "1.0";

if($results->rowCount() > 0){
	while($row = $results->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$item = array(
				'id' => $id,
				'title' => $title,
				'body' => $body,
				'author' => $author,
				'name' => $name
		);
		array_push($post_arr['data'], $item);
	}
	echo json_encode($post_arr);
}else{

	echo json_encode(array('message' => 'no post found!'));
}


?>
