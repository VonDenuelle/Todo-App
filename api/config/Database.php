<?php

    class Database{
        // DB params
        private $host = 'localhost';
        private $dbName = 'todo_db';
        private $username = 'root';
        private $password = '';
        private $conn;
        public $db_status;

        // DB connect
        public function connect(){
            $this->conn = null;
            $dsn = 'mysql:host='. $this->host . ';dbname='. $this->dbName;

            try {
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->db_status  = "Succesfully Connected";
            } catch (PDOException $e) {
                $this->db_status  = "Not Connected: ".$e->getMessage();
                echo 'Connection Error' .$e->getMessage();
            }
            return $this->conn;
        }
    }
