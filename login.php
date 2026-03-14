<?php
session_start();
include "config.php";

if(isset($_POST['login'])){

$username=$_POST['username'];
$password=$_POST['password'];

$sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
$result=$conn->query($sql);

if($result->num_rows>0){

$user=$result->fetch_assoc();

$_SESSION['user_id']=$user['id'];
$_SESSION['role']=$user['role'];

if($user['role']=="admin"){
header("Location: admin/dashboard.php");
}else{
header("Location: about.php");
}

}else{
$error="Invalid login";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - Dont Go Boba-listic</title>

<style>

body{
font-family:Segoe UI;
background:linear-gradient(135deg,#f5e6d3,#fffaf3);
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.box{
background:white;
padding:40px;
border-radius:25px;
box-shadow:0 15px 40px rgba(0,0,0,.2);
width:350px;
text-align:center;
}

.logo{
font-size:36px;
font-weight:800;

background:linear-gradient(270deg,#8b5a2b,#d2b48c,#8b5a2b);
background-size:600% 600%;

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

animation:titleFlow 6s infinite;
}

@keyframes titleFlow{
0%{background-position:0% 50%}
50%{background-position:100% 50%}
100%{background-position:0% 50%}
}

input{
width:100%;
padding:10px;
margin-top:10px;
border-radius:10px;
border:1px solid #ccc;
}

button{
margin-top:15px;
width:100%;
padding:10px;
border:none;
border-radius:20px;
background:#8b5a2b;
color:white;
}

.error{color:red;margin-top:10px;}

</style>

</head>

<body>

<div class="box">

<div class="logo">Dont Go Boba-listic 🧋</div>

<form method="POST">

<input name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>

</form>

<?php if(isset($error)){ echo "<div class='error'>$error</div>"; } ?>

</div>

</body>
</html>