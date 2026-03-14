<?php

$conn = new mysqli("localhost","root","","milktea_db");

if($conn->connect_error){
die("Connection failed");
}

?>