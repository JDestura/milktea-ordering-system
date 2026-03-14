<?php

include "../config.php";

if(isset($_POST['add'])){

$name = $_POST['name'];
$price = $_POST['price'];
$cat = $_POST['category'];

$conn->query("INSERT INTO products (name,price,category_id)
VALUES('$name','$price','$cat')");

header("Location: products.php");

}

?>

<form method="POST">

Name<br>
<input type="text" name="name"><br><br>

Price<br>
<input type="number" name="price"><br><br>

Category<br>

<select name="category">

<?php

$c=$conn->query("SELECT * FROM categories");

while($row=$c->fetch_assoc()){

echo "<option value='{$row['id']}'>{$row['name']}</option>";

}

?>

</select>

<br><br>

<button name="add">Add Product</button>

</form>