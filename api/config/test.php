<?php
  require_once 'Database.php';

      $database = new Database();
      $db = $database->connect();
        
      echo $database->db_status;

      