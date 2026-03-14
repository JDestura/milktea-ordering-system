<?php include "layout.php"; ?>

<h1>Users</h1>

<table>

<tr>
<th>ID</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>

<?php

$u = $conn->query("SELECT * FROM users");

while($row=$u->fetch_assoc()){

$newRole = $row['role']=="admin" ? "user" : "admin";

echo "

<tr>

<td>{$row['id']}</td>

<td>{$row['email']}</td>

<td>{$row['role']}</td>

<td>
<a class='btn' href='change_role.php?id={$row['id']}&role=$newRole'>
Make $newRole
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