<?php 
// Headers 
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB and Connect 
$database = new Database();
$db = $database->connect();

// Instantiate blog post object 
$post = new Post($db);

// Get ID from URL
$post->id = isset($_GET['id']) ? $_GET['id'] : die(); 

// Get post 
$post->read_single();

// Return JSON data 
// Create array 
$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name

);

// Make JSON 
// Prints an array 
print_r(json_encode($post_arr));

