<?php
include "config.php";

function getProducts(){
global $conn;
return $conn->query("SELECT * FROM products WHERE status='available'");
}

function getCategories(){
global $conn;
return $conn->query("SELECT * FROM categories");
}

function getUsers(){
global $conn;
return $conn->query("SELECT * FROM users");
}

function getOrders(){
global $conn;

$sql="SELECT orders.*, users.username, products.name AS product
FROM orders
JOIN users ON orders.user_id=users.id
JOIN products ON orders.product_id=products.id";

return $conn->query($sql);
}
?>