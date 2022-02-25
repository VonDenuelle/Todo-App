<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json ');
  header('Access-Control-Allow-Methods: POST'); //for POST
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With '); //X-requested-with for XSS and other stuff

  include_once '../config/Database.php';
  include_once '../models/Notes.php';

  // Instantiate DB and connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Notesobject
    $note = new Notes($db);


  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $note->Title = $data->Title;
  $note->UserId = $data->UserId;
  $note->Description = $data->Description;


// Create note
  if ($rows = $note->create()) {
    echo json_encode(
      array('message' => 'Post Created', $rows )
      
     );
  } else {
    echo json_encode(
       array('message' => 'Post not Created' )
     );
  }
