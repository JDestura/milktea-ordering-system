<?php include "layout.php"; ?>

<h1>Orders</h1>

<table>

<tr>
<th>Product</th>
<th>Qty</th>
<th>Sugar</th>
<th>Ice</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php

$orders = $conn->query("SELECT * FROM orders");

while($o=$orders->fetch_assoc()){

$newStatus = $o['status']=="verified" ? "unverified" : "verified";

echo "

<tr>

<td>{$o['product_name']}</td>

<td>{$o['qty']}</td>

<td>{$o['sugar']}</td>

<td>{$o['ice']}</td>

<td>{$o['status']}</td>

<td>
<a class='btn' href='verify_order.php?id={$o['id']}&status=$newStatus'>
Set $newStatus
</a>
</td>

</tr>

";

}

?>

</table>

</div>
</body>
</html>