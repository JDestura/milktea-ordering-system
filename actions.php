<?php
session_start();
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $_SESSION['user_id'];
$order_group = $data['order_group'];

foreach($data['cart'] as $item){

$name = $item['name'];
$price = $item['price'];
$qty = $item['qty'];
$sugar = $item['sugar'];
$ice = $item['ice'];

$conn->query("INSERT INTO orders 
(user_id, product_name, price, qty, sugar, ice, order_group, status)
VALUES 
('$user_id','$name','$price','$qty','$sugar','$ice','$order_group','unverified')");

}

echo "success";
?>