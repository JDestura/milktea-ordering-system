<?php
include "layout.php";

if(isset($_POST['add'])){

$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];

/* IMAGE UPLOAD */
$image = "";

if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

$filename = time() . "_" . $_FILES['image']['name'];
$target = "../images/" . $filename;

move_uploaded_file($_FILES['image']['tmp_name'], $target);

$image = $filename;
}

$conn->query("INSERT INTO products (name, price, category_id, image)
VALUES ('$name','$price','$category','$image')");

echo "<script>alert('Product Added');window.location='products.php';</script>";
}

$cats = $conn->query("SELECT * FROM categories");
?>

<style>

/* ✅ ADD THIS (same as edit_product.php) */
.main{
display:flex;
justify-content:center;
align-items:center;
min-height:100vh;
}

/* KEEP YOUR EXISTING DESIGN */
.form-box{
max-width:500px;
background:white;
padding:30px;
border-radius:20px;
box-shadow:0 15px 35px rgba(0,0,0,.2);
}

.form-box input,
.form-box select{
width:100%;
padding:10px;
margin:10px 0;
border-radius:10px;
border:1px solid #ccc;
}

.form-box button{
width:100%;
padding:12px;
border:none;
background:#6f4e37;
color:white;
border-radius:25px;
cursor:pointer;
font-size:16px;
}

.form-box button:hover{
background:#5a3c2b;
}

/* IMAGE PREVIEW */
.preview{
width:100%;
height:200px;
border:2px dashed #ccc;
border-radius:15px;
display:flex;
align-items:center;
justify-content:center;
margin-bottom:10px;
overflow:hidden;
}

.preview img{
width:100%;
height:100%;
object-fit:cover;
}

</style>

<!-- ✅ WRAP INSIDE MAIN -->
<div class="main">

<div class="form-box">

<form method="POST" enctype="multipart/form-data">

<div class="preview" id="preview">
<span>No Image</span>
</div>

<input type="file" name="image" accept="image/*" onchange="previewImage(event)">

<input type="text" name="name" placeholder="Product Name" required>

<input type="number" name="price" placeholder="Price" required>

<select name="category" required>
<option value="">Select Category</option>
<?php while($c = $cats->fetch_assoc()){ ?>
<option value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
<?php } ?>
</select>

<button name="add">Add Product</button>

</form>

</div>

</div>

<script>

function previewImage(event){
let reader = new FileReader();

reader.onload = function(){
let img = document.createElement("img");
img.src = reader.result;

let preview = document.getElementById("preview");
preview.innerHTML = "";
preview.appendChild(img);
}

reader.readAsDataURL(event.target.files[0]);
}

</script>

</div>
</body>
</html>