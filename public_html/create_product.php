<?php
/**
 * Created by PhpStorm.
 * User: cairo
 * Date: 03/11/2016
 * Time: 00:00
 */

// Get Database Connection
include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();

// Instance product Object
include_once 'objects/product.php';
$product = new Product($db);

// Get Posted Data
$data = json_decode(file_get_contents("php://input"));

// Set Product Property Values
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->created = date('Y-m-d H:i:s');

// Create The Product
if($product->create()){
    echo "Product was created.";
}

// If Unable To Create The Product, tell The User
else{
    echo "Unable to create product.";
}