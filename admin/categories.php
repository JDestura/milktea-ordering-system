<?php include "layout.php"; ?>

<h1>Categories</h1>

<?php

$categories = $conn->query("SELECT * FROM categories");

while($cat = $categories->fetch_assoc()){

echo "<h2>".$cat['name']."</h2>";

$products = $conn->query("
SELECT * FROM products 
WHERE category_id=".$cat['id']."
");

if($products->num_rows == 0){
    echo "No products<br><br>";
}else{

echo "<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
</tr>";

while($p = $products->fetch_assoc()){

echo "<tr>

<td>".$p['id']."</td>
<td>".$p['name']."</td>
<td>".$p['price']."</td>

</tr>";

}

echo "</table><br>";

}

}

?>

</div>
</body>
</html>