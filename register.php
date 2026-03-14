<?php
include "config.php";

if(isset($_POST['register'])){

$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];

$conn->query("INSERT INTO users(username,email,password)
VALUES('$username','$email','$password')");

echo "Registered Successfully";
}
?>

<form method="POST">

<h2>Register</h2>

<input type="text" name="username" placeholder="Username" required><br><br>

<input type="email" name="email" placeholder="Email" required><br><br>

<input type="password" name="password" placeholder="Password" required><br><br>

<button name="register">Register</button>

</form>