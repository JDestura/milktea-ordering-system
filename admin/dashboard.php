<?php include "layout.php"; ?>

<h1>Dashboard</h1>

<div class="cards">

<div class="card">
<h3>Total Products</h3>
<p>

<?php
$q=$conn->query("SELECT * FROM products");
echo $q->num_rows;
?>

</p>
</div>

<div class="card">
<h3>Total Orders</h3>
<p>

<?php
$q=$conn->query("SELECT * FROM orders");
echo $q->num_rows;
?>

</p>
</div>

<div class="card">
<h3>Categories</h3>
<p>

<?php
$q=$conn->query("SELECT * FROM categories");
echo $q->num_rows;
?>

</p>
</div>

<div class="card">
<h3>Users</h3>
<p>

<?php
$q=$conn->query("SELECT * FROM users");
echo $q->num_rows;
?>

</p>
</div>

</div>

</div>
</body>
</html>