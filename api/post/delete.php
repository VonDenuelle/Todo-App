<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json ');
  header('Access-Control-Allow-Methods: DELETE'); //for POST delete
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With '); //X-requested-with for XSS and other stuff

  include_once '../config/Database.php';
  include_once '../models/Notes.php';

  // Instantiate DB and connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate notes object
    $notes = new Notes($db);


  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

// Set ID
  $notes->Id = $data->Id;

// Create post
  if ($notes->Delete()) {
    echo json_encode(
       array('message' => 'Note Deleted' )
     );
  } else {
    echo json_encode(
       array('message' => 'Note not Deleted ' )
     );
  }
