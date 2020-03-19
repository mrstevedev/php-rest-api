<?php 
// Headers 

// Allows content to be accessible from any origin/ * wildcard
header('Access-Control-Allow-Origin: *');

// Serves JSON as the response type
header('Content-type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB and Connect 
$database = new Database();
$db = $database->connect();

// Instantiate blog post object 
$post = new Post($db);

// Blog post query 
$result = $post->read();
// Get row count 
$num = $result->rowCount();

// Check if any posts
if($num > 0) {
    
    // Post array 
    $posts_arr = array();

    // Creates array name "data" = [];
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        // Push to "data"
        array_push($posts_arr['data'], $post_item);
    }
    // Turn to JSON & Output
    echo json_encode($posts_arr);
} else {
    // No posts
    echo json_encode(
        array('message' => 'No posts found')
    );
}


