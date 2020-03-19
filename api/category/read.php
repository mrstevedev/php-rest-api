<?php 
// Headers 

// Allows content to be accessible from any origin/ * wildcard
header('Access-Control-Allow-Origin: *');

// Serves JSON as the response type
header('Content-type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB and Connect 
$database = new Database();
$db = $database->connect();

// Instantiate category object 
$category = new Category($db);

// Category query 
$result = $category->read();
// Get row count 
$num = $result->rowCount();

// Check if any categories
if($num > 0) {
    
    // Category array 
    $cat_arr = array();

    // Creates array name "data" = [];
    $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $cat_item = array(
            'id' => $id,
            'name' => $name           
        );

        // Push to "data"
        array_push($cat_arr['data'], $cat_item);
    }
    // Turn to JSON & Output
    echo json_encode($cat_arr);
} else {
    // No Categories
    echo json_encode(
        array('message' => 'No categories found')
    );
}


