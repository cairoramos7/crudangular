<?php

class Database {
    /*
     * Specify your own database credentials
     * */

    private $host = 'localhost';
    private $db_name = 'crudangular';
    private $username = 'cairo.ramos';
    private $password = '1';
    public $conn;

    /*
     * Get the database connection
     * */

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name , $this->username, $this->password);
        }
        catch(PDOException $exception){
            echo "Connection Error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}