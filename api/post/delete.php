<?php 
// Headers 

// Allows content to be accessible from any origin/ * wildcard
header('Access-Control-Allow-Origin: *');

// Serves JSON as the response type
header('Content-type: application/json');

// Additional Headers for PUT Request
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB and Connect 
$database = new Database();
$db = $database->connect();

// Instantiate blog post object 
$post = new Post($db);

// Get raw posted data 
$data = json_decode(file_get_contents('php://input'));

// Set ID to Update
$post->id = $data->id;

// Delete post 
if($post->delete()) {
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}


