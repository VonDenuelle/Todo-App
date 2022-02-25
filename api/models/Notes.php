<?php
    class Notes{
        // DB
        private $conn;
        private $table ='notes';

        // post properties
        public $Id;
        public $UserId;
        public $Title;
        public $Description;
  

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Get Notes
        public function Show(){
            $query  = 'SELECT * FROM notes';

        // preapred statements
        $stmt = $this->conn->query($query);

        // Execute
        $stmt->execute();

        return $stmt;
      } //end Show



      // Create notes
      public function Create(){
        $query = 'INSERT INTO notes(UserId, Title, Description) VALUES (:UserId , :Title,  :Description)';

        $stmt = $this->conn->prepare($query);

        // Clean Data
        // prepred statementonly for database
        // htmlspecialchars is for output to DOM
        // Strip tags is for escaping html , difference to abaoive is escaping and stripping
        $this->Title = htmlspecialchars(strip_tags($this->Title));
        $this->UserId = htmlspecialchars(strip_tags($this->UserId));
        $this->Description = htmlspecialchars(strip_tags($this->Description));

          if ($stmt->execute([
            
            'UserId' => $this->UserId,
            'Title' => $this->Title,
            'Description' => $this->Description
          ])
        ) {
             // Get Inserted ID and get details 
             $insertedID = $this->conn->lastInsertId();
             $query = 'SELECT * FROM notes WHERE Id = ?';
             $stmt = $this->conn->prepare($query);
             $stmt->execute([$insertedID]); 

             $row = $stmt->fetch();
                 return $row;
          } else {
            printf("Error: %s.\n", $stmt->error);
            return false;
          }
      }//end create


      // UPDATE
      public function Update(){
        $query = 'UPDATE notes'.'
          SET
          Title = :Title,
          Description = :Description
          WHERE
            Id = :Id
        ';

        $stmt = $this->conn->prepare($query);

        // Clean Data
        // prepred statementonly for database
        // htmlspecialchars is for output to DOM
        // Strip tags is for escaping html , difference to abaoive is escaping and stripping
        $this->Title = htmlspecialchars(strip_tags($this->Title));
        $this->UserId = htmlspecialchars(strip_tags($this->UserId));
        $this->Description = htmlspecialchars(strip_tags($this->Description));

        $this->Id = htmlspecialchars(strip_tags($this->Id));

          if ($stmt->execute([
            'Title' => $this->Title,
            'Description' => $this->Description,
            'Id' => $this->Id
          ])
        ) {
          $query = 'SELECT * FROM notes WHERE Id = ?';
          $stmt = $this->conn->prepare($query);
          $stmt->execute([$this->Id]); 

          $row = $stmt->fetch();
              return $row;
          } else {
            printf("Error: %s.\n", $stmt->error);
            return false;
          }
      }//end update



      // DELEETE
      public function Delete(){
        $query = "DELETE FROM notes WHERE Id = :Id";
        $stmt =  $this->conn->prepare($query);

        $this->Id = htmlspecialchars(strip_tags($this->Id));

        if ($stmt->execute(["Id" => $this->Id])) {
          return true;
        }else {
          printf("Error: %s.\n", $stmt->error);
          return false;
        }
      }
    }
