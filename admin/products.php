<?php include "layout.php"; ?>

<h1>Products</h1>

<a class="btn" href="add_product.php">Add Product</a>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Category</th>
<th>Actions</th>
</tr>

<?php

$p = $conn->query("
SELECT products.*, categories.name AS category
FROM products
LEFT JOIN categories
ON products.category_id = categories.id
");

while($row=$p->fetch_assoc()){

echo "

<tr>

<td>{$row['id']}</td>
<td>{$row['name']}</td>
<td>{$row['price']}</td>
<td>{$row['category']}</td>

<td>

<a class='btn' href='edit_product.php?id={$row['id']}'>Edit</a>

<a class='btn' href='delete_product.php?id={$row['id']}'>Delete</a>

</td>

</tr>

";

}

?>

</table>

</div>
</body>
</html>