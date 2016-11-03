<?php
/**
 * Created by PhpStorm.
 * User: cairo
 * Date: 03/11/2016
 * Time: 00:31
 */
class Product{
    /*
     * Database connection and table name
     * */
    private $conn;
    private $table_name = 'products';

    /*
     * Object Properties
     * */
    public $id;
    public $name;
    public $description;
    public $price;
    public $created;

    /*
     * Constructor with $db as database connection
     * */
    public function __construct($db){
        $this->conn = $db;
    }

    // Create Product
    function create(){
        // Query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET name = :name, price = :price, description = :description, created = :created";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Posted values
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":created", $this->created);

        // Execute query
        if($stmt->execute()){
            return true;
        }else{
            echo "<pre>";
                print_r($stmt->errorInfo());
            echo "</pre>";
            return false;
        }
    }

    // Read products
    function readAll(){

        // Select all query
        $query = "SELECT id, name, description, price, created FROM " . $this->table_name . " ORDER BY id DESC";

        // Prepare query statement
        $stmt = $this->conn->prepare( $query );

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}