<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json ');

  require_once '../config/Database.php';
  require_once '../models/Notes.php';

  // Instantiate DB and connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Notes object
    $note = new Notes($db);

    $result = $note->Show();

    // get row count
    $num = $result->rowCount();

    // Check if any notes present
    if ($num >0) {
      $notes = $result->fetchAll();
      // Turn to json and output
      echo json_encode($notes);
    } else {
      echo json_encode(
        array('message' => 'no notes found')
      );
    }
 ?>
