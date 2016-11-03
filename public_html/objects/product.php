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
    private $table_name;

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
}