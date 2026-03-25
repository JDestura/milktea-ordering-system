<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>About Us - Dont Go Boba-listic</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:linear-gradient(135deg,#f5e6d3,#fffaf3);
min-height:100vh;
padding:40px;
overflow-x:hidden;
}

/* HEADER (same navbar style as index) */

.navbar{
display:flex;
justify-content:space-between;
align-items:center;
background:#6f4e37;
padding:15px 40px;
border-radius:20px;
color:white;
margin-bottom:40px;
}

.logo{
font-size:26px;
font-weight:800;
}

.logo span{
width:18px;
height:18px;
background:#f4b400;
border-radius:50%;
display:inline-block;
margin:0 2px;
position:relative;
top:2px;
}

.logo span::after{
content:'';
width:6px;
height:6px;
background:#6f4e37;
border-radius:50%;
position:absolute;
top:6px;
left:6px;
}

.nav-links a{
color:white;
text-decoration:none;
margin:0 10px;
padding:6px 12px;
border-radius:20px;
}

.nav-links a.active{
background:#f4b400;
}

.nav-right{
display:flex;
gap:15px;
align-items:center;
}

.user-menu{
position:relative;
cursor:pointer;
}

.dropdown{
display:none;
position:absolute;
top:35px;
right:0;
background:white;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,.2);
}

.dropdown a{
display:block;
padding:10px 20px;
text-decoration:none;
color:#333;
}

.dropdown.show{
display:block;
}

/* ABOUT SECTION */

.about-container{
display:flex;
align-items:center;
justify-content:space-between;
gap:40px;
max-width:1100px;
margin:auto;
background:#fffaf3;
border-radius:25px;
padding:40px;
box-shadow:0 20px 45px rgba(0,0,0,.2);
animation:fadeUp 1s ease;
}

/* TEXT SIDE */
.about-text{
flex:1;
}

.about-text h1{
color:#6f4518;
margin-bottom:20px;
font-size:38px;
}

.about-text p{
font-size:17px;
line-height:1.7;
margin-bottom:15px;
color:#444;
}

/* IMAGE SIDE (FIXED SIZE — NOT TOO BIG) */
.about-image{
flex:1;
display:flex;
justify-content:center;
}

.about-image img{
width:320px;   /* smaller size */
border-radius:20px;
box-shadow:0 15px 35px rgba(0,0,0,.25);
}

/* ANIMATION */
@keyframes fadeUp{
from{
opacity:0;
transform:translateY(40px);
}
to{
opacity:1;
transform:translateY(0);
}
}

/* FLOATING BOBA */

.boba{
position:fixed;
bottom:-40px;
width:22px;
height:22px;
background:#6f4518;
border-radius:50%;
opacity:.15;
animation:floatBoba linear infinite;
pointer-events:none;
}

@keyframes floatBoba{
0%{transform:translateY(0)}
100%{transform:translateY(-120vh)}
}

</style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

<div class="logo">
D<span></span>nt G<span></span> B<span></span>ba-listic
</div>

<div class="nav-links">
<a href="index.php">Shop</a>
<a class="active" href="about.php">About</a>
</div>

<div class="nav-right">
<div class="user-menu">
<span onclick="toggleUserMenu()">👤</span>
<div id="userDropdown" class="dropdown">
<a href="logout.php">Logout</a>
</div>
</div>
</div>

</div>

<!-- ABOUT CONTENT -->

<div class="about-container">

<div class="about-text">

<h1>About Our Milk Tea Shop 🧋</h1>

<p>
At Dont Go Boba-listic, we believe that every cup of milk tea is more than just a drink — it’s an experience, a comfort, and a moment of happiness in your day. Our shop was created with a simple goal: to bring people together through flavors that feel both exciting and familiar.
</p>

<p>
We carefully select premium tea leaves, fresh milk, and high-quality ingredients to ensure that every sip delivers a rich and satisfying taste. From the first pour to the final seal, each drink is crafted with attention to detail, consistency, and passion for quality.
</p>

<p>
What makes us special is the freedom we give our customers to personalize their drinks. Whether you prefer less sugar, extra ice, or a perfect balance of both, we make sure your milk tea matches your taste exactly the way you like it.
</p>

<p>
Beyond serving beverages, we aim to create a welcoming space where friends bond, conversations flow, and everyday moments become memorable. Whether you're stopping by for a quick refreshment or treating yourself after a long day, Dont Go Boba-listic is here to make every visit feel special.
</p>

<p>
Because for us, milk tea isn’t just a trend — it’s a lifestyle, a passion, and a little cup of happiness we’re proud to share with you.
</p>

</div>

<div class="about-image">
<img src="images/don_t_go_boba_listic.png" alt="Milk Tea">
</div>

</div>

<script>

/* USER MENU */
function toggleUserMenu(){
document.getElementById("userDropdown").classList.toggle("show")
}

/* FLOATING BOBA */
for(let i=0;i<15;i++){
let b=document.createElement("div")
b.className="boba"
b.style.left=Math.random()*100+"vw"
b.style.animationDuration=(8+Math.random()*6)+"s"
document.body.appendChild(b)
}

</script>

</body>
</html>