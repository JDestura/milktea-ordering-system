<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

include "config.php";

$categories = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>

<title>Dont Go Boba-listic 🧋</title>

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
cursor:pointer;
position:relative;
}

.cart-count{
position:absolute;
top:-5px;
right:-5px;
background:red;
color:white;
font-size:12px;
padding:3px 7px;
border-radius:50%;
}

.category-title{
font-size:30px;
color:#6f4518;
margin:40px 0 20px 0;
}

.products{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:30px;
}

.product{
background:#fffaf3;
border-radius:22px;
padding:20px;
text-align:center;
box-shadow:0 12px 30px rgba(0,0,0,.2);
transition:.35s;
}

.product:hover{
transform:translateY(-10px) scale(1.05);
box-shadow:0 25px 45px rgba(139,90,43,.4);
}

.product img{
width:100%;
height:180px;
object-fit:cover;
border-radius:18px;
margin-bottom:10px;
}

.product h3{
color:#6f4518;
}

.product p{
font-weight:bold;
margin:8px 0;
}

select{
width:100%;
padding:8px;
margin-top:5px;
border-radius:10px;
border:1px solid #ccc;
}

button{
margin-top:12px;
padding:10px;
width:100%;
border:none;
border-radius:25px;
background:#8b5a2b;
color:white;
cursor:pointer;
}

/* CART POPUP */

.cartPopup{
position:fixed;
top:50%;
left:50%;
transform:translate(-50%,-50%) scale(0);
background:white;
padding:30px;
border-radius:20px;
width:350px;
box-shadow:0 25px 50px rgba(0,0,0,.3);
transition:.3s;
z-index:1000;
}

.cartPopup.active{
transform:translate(-50%,-50%) scale(1);
}

.cartItem{
display:flex;
justify-content:space-between;
align-items:center;
margin:10px 0;
}

.qtyBox{
display:flex;
align-items:center;
gap:6px;
}

.qtyBtn{
width:28px;
height:28px;
border-radius:50%;
border:none;
background:#8b5a2b;
color:white;
cursor:pointer;
display:flex;
align-items:center;
justify-content:center;
font-weight:bold;
font-size:16px;
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
<a class="logout" href="about.php">About</a>

<a class="logout" onclick="openCart()">
Cart
<span id="cartCount" class="cart-count">0</span>
</a>

<a class="logout" href="logout.php">Logout</a>
</div>

</header>

<?php while($cat = $categories->fetch_assoc()){ ?>

<h2 class="category-title"><?php echo $cat['name']; ?></h2>

<div class="products">

<?php
$cid = (int)$cat['id'];
$products = $conn->query("SELECT * FROM products WHERE category_id=$cid");

while($p = $products->fetch_assoc()){

$image = !empty($p['image']) ? "images/".$p['image'] : "images/default.png";
?>

<div class="product">

<img src="<?php echo $image; ?>">

<h3><?php echo $p['name']; ?></h3>

<p>₱<?php echo $p['price']; ?></p>

<?php if($cat['name'] == "Milk Tea"){ ?>

<select id="sugar<?php echo $p['id']; ?>">
<option>0%</option>
<option>25%</option>
<option>50%</option>
<option>75%</option>
<option>100%</option>
</select>

<select id="ice<?php echo $p['id']; ?>">
<option>No Ice</option>
<option>Less Ice</option>
<option>Normal Ice</option>
</select>

<button onclick="addToCart(
'<?php echo $p['name']; ?>',
'<?php echo $p['price']; ?>',
document.getElementById('sugar<?php echo $p['id']; ?>').value,
document.getElementById('ice<?php echo $p['id']; ?>').value
)">Add To Cart</button>

<?php } else { ?>

<button onclick="addToCart(
'<?php echo $p['name']; ?>',
'<?php echo $p['price']; ?>',
'',
''
)">Add To Cart</button>

<?php } ?>

</div>

<?php } ?>

</div>

<?php } ?>

<div id="cartPopup" class="cartPopup">

<h2>Your Cart</h2>

<div id="cartItems"></div>

<h3>Total ₱<span id="total">0</span></h3>

<button onclick="checkout()">Buy Now</button>
<button onclick="closeCart()">Close</button>

</div>

<script>

let cart=[]

function addToCart(name,price,sugar,ice){

let existing = cart.find(item =>
item.name===name &&
item.sugar===sugar &&
item.ice===ice
)

if(existing){
existing.qty++
}else{
cart.push({
name:name,
price:parseFloat(price),
sugar:sugar,
ice:ice,
qty:1
})
}

updateCartCount()
renderCart()

}

function increase(i){
cart[i].qty++
updateCartCount()
renderCart()
}

function decrease(i){

if(cart[i].qty>1){
cart[i].qty--
}else{
cart.splice(i,1)
}

updateCartCount()
renderCart()

}

function updateCartCount(){

let count=0

cart.forEach(item=>{
count+=item.qty
})

document.getElementById("cartCount").innerText=count

}

function renderCart(){

let html=""
let total=0

cart.forEach((item,index)=>{

let itemTotal=item.price*item.qty
total+=itemTotal

html+=`
<div class="cartItem">

<div>
<b>${item.name}</b><br>
<small>${item.sugar ? item.sugar+' sugar • '+item.ice : ''}</small>
</div>

<div class="qtyBox">
<button class="qtyBtn" onclick="decrease(${index})">−</button>
<span>${item.qty}</span>
<button class="qtyBtn" onclick="increase(${index})">+</button>
</div>

<div>₱${itemTotal}</div>

</div>
`

})

document.getElementById("cartItems").innerHTML=html
document.getElementById("total").innerText=total

}

function openCart(){
document.getElementById("cartPopup").classList.add("active")
}

function closeCart(){
document.getElementById("cartPopup").classList.remove("active")
}

function checkout(){

fetch("actions.php",{
method:"POST",
headers:{'Content-Type':'application/json'},
body:JSON.stringify(cart)
})
.then(res=>res.text())
.then(data=>{
alert("Order placed!")
cart=[]
updateCartCount()
renderCart()
closeCart()
})

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