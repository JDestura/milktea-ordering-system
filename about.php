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

/* HEADER */

header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:40px;
}

.logo{
font-size:42px;
font-weight:800;
background:linear-gradient(270deg,#8b5a2b,#d2b48c,#8b5a2b);
background-size:600% 600%;
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
animation:titleFlow 6s ease infinite, float 3s ease-in-out infinite;
}

@keyframes titleFlow{
0%{background-position:0% 50%}
50%{background-position:100% 50%}
100%{background-position:0% 50%}
}

@keyframes float{
0%,100%{transform:translateY(0)}
50%{transform:translateY(-6px)}
}

.logout{
text-decoration:none;
background:#8b5a2b;
color:white;
padding:10px 20px;
border-radius:25px;
margin-left:10px;
}

/* ABOUT CARD */

.about-container{
max-width:900px;
margin:auto;
background:#fffaf3;
border-radius:25px;
padding:40px;
box-shadow:0 20px 45px rgba(0,0,0,.2);
animation:fadeUp 1s ease;
}

.about-container h1{
color:#6f4518;
margin-bottom:20px;
font-size:36px;
}

.about-container p{
font-size:18px;
line-height:1.6;
margin-bottom:15px;
color:#444;
}

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

/* FEATURE CARDS */

.features{
margin-top:30px;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
}

.feature{
background:white;
padding:20px;
border-radius:20px;
box-shadow:0 12px 30px rgba(0,0,0,.2);
text-align:center;
transition:.3s;
}

.feature:hover{
transform:translateY(-8px) scale(1.05);
box-shadow:0 20px 40px rgba(139,90,43,.4);
}

.feature h3{
color:#8b5a2b;
margin-bottom:10px;
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

<header>

<div class="logo">Dont Go Boba-listic 🧋</div>

<div>
<a class="logout" href="index.php">Shop</a>
<a class="logout" href="logout.php">Logout</a>
</div>

</header>

<div class="about-container">

<h1>About Our Milk Tea Shop 🧋</h1>

<p>
Dont Go Boba-listic was created to bring the best milk tea experience to every customer.
We believe that milk tea is not just a drink — it's a moment of happiness.
</p>

<p>
Every cup we serve is crafted with premium tea leaves, fresh milk,
and high-quality toppings. Our drinks are fully customizable,
so every customer can create their perfect milk tea.
</p>

<p>
From classic flavors to modern creations, we aim to deliver
a refreshing and memorable experience in every sip.
</p>

<div class="features">

<div class="feature">
<h3>Premium Ingredients</h3>
<p>We only use high quality tea, milk, and toppings.</p>
</div>

<div class="feature">
<h3>Customizable Drinks</h3>
<p>Choose your sugar level, ice level, and toppings.</p>
</div>

<div class="feature">
<h3>Freshly Made</h3>
<p>Every drink is prepared fresh when you order.</p>
</div>

<div class="feature">
<h3>Milk Tea Lovers</h3>
<p>Made by milk tea lovers for milk tea lovers.</p>
</div>

</div>

</div>

<script>

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