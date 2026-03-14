<?php
include "config.php";
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $_SESSION['user_id'];

foreach($data as $item){

$name = $conn->real_escape_string($item['name']);
$price = $item['price'];
$qty = $item['qty'];
$sugar = $conn->real_escape_string($item['sugar']);
$ice = $conn->real_escape_string($item['ice']);

$conn->query("
INSERT INTO orders (user_id,product_name,price,qty,sugar,ice)
VALUES ('$user_id','$name','$price','$qty','$sugar','$ice')
");

}

echo "success";