<?php include "layout.php"; ?>

<h1>Orders</h1>

<style>

table{
width:100%;
border-collapse:collapse;
background:white;
border-radius:10px;
overflow:hidden;
box-shadow:0 10px 25px rgba(0,0,0,.15);
}

th, td{
padding:12px;
text-align:left;
border-bottom:1px solid #ddd;
}

th{
background:#6f4e37;
color:white;
}

/* DELETE BUTTON */
.delete-btn{
background:#e74c3c;
color:white;
padding:6px 12px;
border-radius:6px;
text-decoration:none;
font-size:13px;
transition:.3s;
}

.delete-btn:hover{
background:#c0392b;
}

/* STATUS BUTTON */
.status-btn{
padding:6px 12px;
border-radius:20px;
color:white;
font-size:12px;
text-decoration:none;
display:inline-block;
}

.unverified{
background:#f39c12;
}

.verified{
background:#27ae60;
}

.status-btn:hover{
opacity:.8;
}

</style>

<table>

<tr>
<th>Order Group</th>
<th>User</th>
<th>Items</th>
<th>Total</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM orders ORDER BY order_group DESC");

$grouped = [];

while($row = $result->fetch_assoc()){
$grouped[$row['order_group']][] = $row;
}

foreach($grouped as $group => $orders){

$total = 0;
$items = "";

foreach($orders as $o){
$total += $o['price'] * $o['qty'];
$items .= $o['product_name']." (x".$o['qty'].")<br>";
}

$status = $orders[0]['status'];
?>

<tr>

<td><?php echo $group; ?></td>

<td><?php echo $orders[0]['user_id']; ?></td>

<td><?php echo $items; ?></td>

<td>₱<?php echo $total; ?></td>

<td>

<a href="verify_order.php?group=<?php echo $group; ?>&status=<?php echo $status; ?>" 
class="status-btn <?php echo $status; ?>">
<?php echo ucfirst($status); ?>
</a>

</td>

<td>

<a href="delete_order.php?group=<?php echo $group; ?>" 
onclick="return confirm('Delete this order?')" 
class="delete-btn">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>
</body>
</html>