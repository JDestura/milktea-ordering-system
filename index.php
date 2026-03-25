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

/* (ALL YOUR ORIGINAL CSS — UNCHANGED) */

*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI';}

body{
background:linear-gradient(135deg,#f5e6d3,#fffaf3);
padding:40px;
}

/* NAVBAR */
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

/* LOGO */
.logo{font-size:26px;font-weight:800;}
.logo span{
width:18px;height:18px;background:#f4b400;border-radius:50%;
display:inline-block;margin:0 2px;position:relative;top:2px;
}
.logo span::after{
content:'';width:6px;height:6px;background:#6f4e37;border-radius:50%;
position:absolute;top:6px;left:6px;
}

/* NAV */
.nav-links a{
color:white;text-decoration:none;margin:0 10px;padding:6px 12px;border-radius:20px;
}
.nav-links a.active{background:#f4b400;}

/* RIGHT */
.nav-right{display:flex;gap:15px;align-items:center;}

.cart{cursor:pointer;position:relative;}
.cart-count{
position:absolute;top:-6px;right:-8px;background:red;color:white;
font-size:10px;padding:3px 6px;border-radius:50%;
}

.user-menu{position:relative;cursor:pointer;}
.dropdown{
display:none;position:absolute;top:35px;right:0;
background:white;border-radius:10px;box-shadow:0 10px 25px rgba(0,0,0,.2);
}
.dropdown a{display:block;padding:10px 20px;text-decoration:none;color:#333;}
.dropdown.show{display:block;}

/* PRODUCTS */
.category-title{font-size:28px;color:#6f4518;margin:30px 0;}
.products{
display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
gap:25px;
}
.product{
background:#fffaf3;padding:20px;border-radius:20px;text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,.15);
}
.product img{width:100%;height:170px;border-radius:15px;object-fit:cover;}

button{
margin-top:10px;padding:10px;width:100%;
border:none;border-radius:25px;background:#8b5a2b;color:white;cursor:pointer;
}

/* CART POPUP */
.cartPopup{
position:fixed;top:50%;left:50%;
transform:translate(-50%,-50%) scale(0);
background:white;padding:30px;border-radius:20px;width:350px;
box-shadow:0 25px 50px rgba(0,0,0,.3);transition:.3s;
}
.cartPopup.active{transform:translate(-50%,-50%) scale(1);}

.cartItem{display:flex;justify-content:space-between;margin:10px 0;}
.qtyBox{display:flex;gap:5px;}
.qtyBtn{
width:25px;height:25px;border:none;border-radius:50%;
background:#8b5a2b;color:white;cursor:pointer;
}

/* FLOATING BOBA */
.boba{
position:fixed;bottom:-40px;width:18px;height:18px;background:#6f4518;
border-radius:50%;opacity:.15;animation:floatBoba linear infinite;
}
@keyframes floatBoba{
0%{transform:translateY(0);}100%{transform:translateY(-120vh);}
}

/* FLOAT BUTTON */
.milk-btn{
position:fixed;bottom:25px;right:25px;background:#8b5a2b;color:white;
padding:15px;border-radius:50%;cursor:pointer;font-size:22px;
box-shadow:0 10px 25px rgba(0,0,0,.3);
}

.info-box{
position:fixed;bottom:90px;right:25px;background:white;padding:20px;
border-radius:15px;display:none;width:220px;
box-shadow:0 15px 35px rgba(0,0,0,.3);
}

.stars span{cursor:pointer;font-size:20px;color:#ccc;}

</style>
</head>

<body>

<!-- (ALL YOUR HTML — UNCHANGED) -->

<div class="navbar">

<div class="logo">
D<span></span>nt G<span></span> B<span></span>ba-lastic
</div>

<div class="nav-links">
<a class="active" href="index.php">Shop</a>
<a href="about.php">About</a>
</div>

<div class="nav-right">

<div class="cart" onclick="openCart()">🛒
<span id="cartCount" class="cart-count">0</span>
</div>

<div class="user-menu">
<span onclick="toggleUserMenu()">👤</span>
<div id="userDropdown" class="dropdown">
<a href="logout.php">Logout</a>
</div>
</div>

</div>
</div>

<?php while($cat = $categories->fetch_assoc()){ ?>

<h2 class="category-title"><?php echo $cat['name']; ?></h2>

<div class="products">

<?php
$products = $conn->query("SELECT * FROM products WHERE category_id=".$cat['id']);
while($p = $products->fetch_assoc()){
$image = !empty($p['image']) ? "images/".$p['image'] : "images/default.png";
?>

<div class="product">
<img src="<?php echo $image; ?>">
<h3><?php echo $p['name']; ?></h3>
<p>₱<?php echo $p['price']; ?></p>

<?php if($cat['name']=="Milk Tea"){ ?>
<select id="sugar<?php echo $p['id']; ?>">
<option>0%</option><option>25%</option><option>50%</option><option>75%</option><option>100%</option>
</select>
<select id="ice<?php echo $p['id']; ?>">
<option>No Ice</option><option>Less Ice</option><option>Normal Ice</option>
</select>

<button onclick="addToCart('<?php echo $p['name']; ?>','<?php echo $p['price']; ?>',
document.getElementById('sugar<?php echo $p['id']; ?>').value,
document.getElementById('ice<?php echo $p['id']; ?>').value)">
Add To Cart</button>

<?php } else { ?>
<button onclick="addToCart('<?php echo $p['name']; ?>','<?php echo $p['price']; ?>','','')">Add To Cart</button>
<?php } ?>

</div>
<?php } ?>

</div>
<?php } ?>

<!-- CART POPUP -->

<div id="cartPopup" class="cartPopup">
<h2>Your Cart</h2>
<div id="cartItems"></div>
<h3>Total ₱<span id="total">0</span></h3>

<button onclick="checkout()">Buy Now</button>
<button onclick="closeCart()">Close</button>
</div>

<div class="milk-btn" onclick="toggleInfo()">🧋</div>

<div id="infoBox" class="info-box">
<h3>Contact</h3>
<p>📞 0912-345-6789</p>
<p>📧 Milktea@email.com</p>

<h4>Rate Us</h4>
<div class="stars">
<span onclick="rate(1)">★</span>
<span onclick="rate(2)">★</span>
<span onclick="rate(3)">★</span>
<span onclick="rate(4)">★</span>
<span onclick="rate(5)">★</span>
</div>

<button onclick="toggleInfo()">Close</button>
</div>

<script>

/* (ALL YOUR JS — UNCHANGED ABOVE) */

function toggleUserMenu(){
document.getElementById("userDropdown").classList.toggle("show")
}

let cart=[]

function addToCart(name,price,sugar,ice){
let e=cart.find(i=>i.name==name&&i.sugar==sugar&&i.ice==ice)
if(e){e.qty++}else{cart.push({name,price:parseFloat(price),sugar,ice,qty:1})}
updateCartCount();renderCart();openCart();
}

function increase(i){cart[i].qty++;updateCartCount();renderCart();}
function decrease(i){cart[i].qty>1?cart[i].qty--:cart.splice(i,1);updateCartCount();renderCart();}

function updateCartCount(){
let c=0;cart.forEach(i=>c+=i.qty);
document.getElementById("cartCount").innerText=c;
}

function renderCart(){
let html="",total=0;
cart.forEach((i,x)=>{
let t=i.price*i.qty;total+=t;
html+=`<div class="cartItem">
<div><b>${i.name}</b><br><small>${i.sugar?i.sugar+' • '+i.ice:''}</small></div>
<div class="qtyBox">
<button class="qtyBtn" onclick="decrease(${x})">−</button>
<span>${i.qty}</span>
<button class="qtyBtn" onclick="increase(${x})">+</button>
</div>
<div>₱${t}</div>
</div>`;
});
document.getElementById("cartItems").innerHTML=html;
document.getElementById("total").innerText=total;
}

function openCart(){document.getElementById("cartPopup").classList.add("active")}
function closeCart(){document.getElementById("cartPopup").classList.remove("active")}

/* ✅ ONLY CHANGE IS HERE */
function checkout(){

if(cart.length===0){
alert("Cart is empty!");
return;
}

let order_group = Date.now();

fetch("actions.php",{
method:"POST",
headers:{'Content-Type':'application/json'},
body:JSON.stringify({
cart: cart,
order_group: order_group
})
})
.then(res=>res.text())
.then(()=>{
alert("Order placed successfully!");
cart=[];
updateCartCount();
renderCart();
closeCart();
});
}

/* (REST UNCHANGED) */

function toggleInfo(){
let b=document.getElementById("infoBox");
b.style.display=b.style.display==="block"?"none":"block";
}

function rate(n){
let s=document.querySelectorAll(".stars span");
s.forEach((e,i)=>e.style.color=i<n?"gold":"#ccc");
}

for(let i=0;i<18;i++){
let b=document.createElement("div");
b.className="boba";
b.style.left=Math.random()*100+"vw";
b.style.animationDuration=(8+Math.random()*6)+"s";
document.body.appendChild(b);
}

</script>

</body>
</html>