<?php
require 'db.conn.php';

$statement = $conn->query('SELECT * FROM products');
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

$columns = ['id', 'name', 'description', 'quantity', 'price', 'created_at', 'updated_at'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
</head>

<body>
  <h1>Product List</h1>
  <a href="create.php">Add New Product</a>
  <table border="2">
    <thead>
      <tr>
        <?php foreach ($columns as $column): ?>
          <th><?= ucfirst(str_replace('_', ' ', $column)) ?></th>
        <?php endforeach; ?>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product): ?>
        <tr>
          <?php foreach ($columns as $column): ?>
            <td><?= htmlspecialchars($product[$column]) ?></td>
          <?php endforeach; ?>
          <td>
            <a href="read.php?id=<?= $product['id'] ?>">View</a>
            <a href="update.php?id=<?= $product['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $product['id'] ?>" onclick="return confirm('Are you sure you want to delete it?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>