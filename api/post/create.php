<?php 

header('Allow-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Allow-Control-Allow-Origin,Content-Type,Allow-Control-Allow-Methods,Authorization, x-Requested-with');

include_once "../../config/database.php";
include_once "../../model/post.php";
include_once "../../controllers/validation.php";


$db = new Database;
$post = new Post($db->connect());



$validate = new Validation();
//$validate->post_data = $_POST;

$post_arr = array();
$post_arr['data'] = array();
$post_arr['version'] = "1.0";

// if($validate->validate_request($_POST)){
// 	echo json_encode(array('error' => 'invalid request supplied'));
// }else 

// print_r($_REQUEST);
// die();
if($validate->validate_request($_REQUEST)){
	echo json_encode(array('error' => 'expected parameters are not set'));
}else if($validate->validate_params($_REQUEST)){
	echo json_encode(array('error' => 'parameters supplied are either empty or not set'));
}else{ 

	$post->title = $_REQUEST['title']; 
	$post->body = $_REQUEST['body']; 
	$post->author = $_REQUEST['author']; 
	$post->name = $_REQUEST['name'];
	$post->created_at = date("l jS \of F Y h:i:s A");
	$post->update_at = date("l jS \of F Y h:i:s A");
	$result = $post->create(); 
	$row = $result->fetch(PDO::FETCH_ASSOC);
	$item = array(
					'id' => $row['id'],
					'title' => $row['title'],
					'body' => $row['body'],
					'author' => $row['author'],
					'name' => $row['name']
	);
	array_push($post_arr['data'], $item);
	echo json_encode($post_arr);
}

?>
