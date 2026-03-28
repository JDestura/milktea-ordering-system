<?php
include "config.php";

if(isset($_POST['register'])){

$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];

$conn->query("INSERT INTO users(username,email,password)
VALUES('$username','$email','$password')");

echo "<script>alert('Registered Successfully');window.location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register - Dont Go Boba-listic</title>

<style>

*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI';}

body{
background:linear-gradient(135deg,#f5e6d3,#fffaf3);
height:100vh;
display:flex;
overflow:hidden;
}

.container{display:flex;width:100%;}

/* LEFT */
.left{
flex:1;
display:flex;
flex-direction:column;
justify-content:center;
align-items:center;
padding:60px;
position:relative;
}

/* SAME IMAGE STYLE AS LOGIN */
.top-img{
width:180px;
margin-bottom:20px;
animation:float 4s ease-in-out infinite;
}

@keyframes float{
0%,100%{transform:translateY(0);}
50%{transform:translateY(-10px);}
}

/* SAME LOGO AS LOGIN */
.logo{
font-size:44px;
font-weight:900;
letter-spacing:1px;
color:#6f4e37;
}

.logo span{
width:22px;
height:22px;
background:#f4b400;
border-radius:50%;
display:inline-block;
margin:0 4px;
position:relative;
top:3px;
}

.logo span::after{
content:'';
width:8px;
height:8px;
background:#6f4e37;
border-radius:50%;
position:absolute;
top:7px;
left:7px;
}

/* QUOTE */
.quote{
margin-top:15px;
font-size:16px;
color:#6f4518;
text-align:center;
max-width:350px;
opacity:.8;
}

/* RIGHT */
.right{
flex:1;
display:flex;
justify-content:center;
align-items:center;
}

.box{
background:rgba(255,255,255,0.9);
backdrop-filter:blur(10px);
padding:40px;
border-radius:25px;
box-shadow:0 20px 45px rgba(0,0,0,.2);
width:350px;
text-align:center;
}

.box h2{
color:#6f4518;
margin-bottom:15px;
}

input{
width:100%;
padding:12px;
margin-top:12px;
border-radius:12px;
border:1px solid #ddd;
}

input:focus{
outline:none;
border-color:#8b5a2b;
}

button{
margin-top:20px;
width:100%;
padding:12px;
border:none;
border-radius:25px;
background:#8b5a2b;
color:white;
cursor:pointer;
transition:.3s;
}

button:hover{
background:#6f4518;
transform:scale(1.05);
}

.link{
margin-top:15px;
font-size:14px;
}

.link a{
color:#8b5a2b;
text-decoration:none;
font-weight:bold;
}

/* BOBA BG */
.boba{
position:absolute;
bottom:-40px;
width:20px;height:20px;
background:#6f4518;
border-radius:50%;
opacity:.15;
animation:floatBoba linear infinite;
}

@keyframes floatBoba{
0%{transform:translateY(0);}
100%{transform:translateY(-120vh);}
}

/* MOBILE */
@media(max-width:800px){
.container{flex-direction:column;}
}

</style>
</head>

<body>

<div class="container">

<!-- LEFT (MATCH LOGIN) -->
<div class="left">

<img src="images/milktea.png" class="top-img">

<div class="logo">
D<span></span>nt G<span></span> B<span></span>ba-listic
</div>

<div class="quote">
“Join us and start your milk tea journey today.”
</div>

</div>

<!-- RIGHT -->
<div class="right">

<div class="box">

<h2>Create Account</h2>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="register">Register</button>
</form>

<div class="link">
Already have an account? <a href="login.php">Login</a>
</div>

</div>

</div>

</div>

<script>
for(let i=0;i<20;i++){
let b=document.createElement("div");
b.className="boba";
b.style.left=Math.random()*100+"vw";
b.style.animationDuration=(8+Math.random()*6)+"s";
document.body.appendChild(b);
}
</script>

</body>
</html>