<?php

include "../config.php";

if(isset($_GET['group']) && isset($_GET['status'])){

$group = $_GET['group'];
$status = $_GET['status'];

/* TOGGLE STATUS */
$newStatus = ($status == "unverified") ? "verified" : "unverified";

/* UPDATE WHOLE ORDER GROUP */
$conn->query("UPDATE orders SET status='$newStatus' WHERE order_group='$group'");

}

header("Location: orders.php");
exit();

?>