<?php
session_start();
include "../config.php";

$id = $_GET['id'];

$product = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();

if(isset($_POST['update'])){

$name = $_POST['name'];
$price = $_POST['price'];

// keep current image
$image = $product['image'];

// check if new image uploaded
if(!empty($_FILES['image']['name'])){
    $image = time().'_'.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/".$image);
}

$conn->query("UPDATE products 
SET name='$name', price='$price', image='$image'
WHERE id=$id");

header("Location: products.php");
exit();
}
?>

<?php include "layout.php"; ?>

<style>

/* CENTER CONTENT */
.main{
display:flex;
justify-content:center;
align-items:center;
min-height:100vh;
}

/* CARD FORM */
.form-box{
background:#fffaf3;
padding:30px;
border-radius:25px;
box-shadow:0 15px 40px rgba(0,0,0,.2);
width:420px;
animation:fadeUp .6s ease;
}

/* TITLE */
.form-box h2{
color:#6f4518;
margin-bottom:20px;
text-align:center;
}

/* INPUT */
.form-box input{
width:100%;
padding:12px;
margin-top:10px;
border-radius:12px;
border:1px solid #ccc;
transition:.3s;
}

.form-box input:focus{
outline:none;
border-color:#8b5a2b;
box-shadow:0 0 5px rgba(139,90,43,.3);
}

/* BUTTON */
.form-box button{
margin-top:20px;
width:100%;
padding:12px;
border:none;
border-radius:25px;
background:#8b5a2b;
color:white;
font-size:15px;
cursor:pointer;
transition:.3s;
}

.form-box button:hover{
background:#6f4518;
transform:scale(1.05);
}

/* ANIMATION */
@keyframes fadeUp{
from{
opacity:0;
transform:translateY(30px);
}
to{
opacity:1;
transform:translateY(0);
}
}

</style>

<div class="main">

<div class="form-box">

<h2>Edit Product</h2>

<form method="POST" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name" value="<?php echo $product['name']; ?>" required>

<label>Price</label>
<input type="number" name="price" value="<?php echo $product['price']; ?>" required>

<!-- ✅ SHOW CURRENT IMAGE -->
<?php if(!empty($product['image'])){ ?>
<img src="../images/<?php echo $product['image']; ?>" style="width:100%;border-radius:10px;margin-top:10px;">
<?php } ?>

<!-- ✅ UPDATE IMAGE -->
<label>Update Picture</label>
<input type="file" name="image">

<button name="update">Update Product</button>

</form>

</div>

</div>