<?php

include "../config.php";

if(isset($_GET['id']) && isset($_GET['status'])){

$id = intval($_GET['id']);
$status = $_GET['status'];

$conn->query("UPDATE orders SET status='$status' WHERE id=$id");

}

header("Location: orders.php");
exit();

?>