<?php

include "../config.php";

$id=$_GET['id'];

$product=$conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();

if(isset($_POST['update'])){

$name=$_POST['name'];
$price=$_POST['price'];

$conn->query("UPDATE products
SET name='$name', price='$price'
WHERE id=$id");

header("Location: products.php");

}

?>

<form method="POST">

Name<br>
<input type="text" name="name" value="<?php echo $product['name']; ?>"><br><br>

Price<br>
<input type="number" name="price" value="<?php echo $product['price']; ?>"><br><br>

<button name="update">Update</button>

</form>