<?php

include "../config.php";

$id = $_GET['id'];
$role = $_GET['role'];

$conn->query("UPDATE users SET role='$role' WHERE id=$id");

header("Location: users.php");

?>