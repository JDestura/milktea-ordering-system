<?php
include "../config.php";

if(isset($_GET['group'])){

$group = $_GET['group'];

$conn->query("DELETE FROM orders WHERE order_group='$group'");

header("Location: orders.php");
exit();

}
?>