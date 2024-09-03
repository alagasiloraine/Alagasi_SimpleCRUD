<?php
require 'db.conn.php';

$id = $_GET['id'] ?? null;
$product = null;

if ($id) {
  $statement = $conn->prepare('SELECT * FROM products WHERE id = ?');
  $statement->execute([$id]);
  $product = $statement->fetch(PDO::FETCH_ASSOC);
}

function e($string)
{
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Products</title>
</head>

<body>
  <h1>View Products</h1>
  <?php if ($product): ?>
    <div>
      <h2><?= e($product['name']) ?></h2>
      <p><strong>Description:</strong> <?= e($product['description']) ?></p>
      <p><strong>Quantity:</strong> <?= e($product['quantity']) ?></p>
      <p><strong>Price:</strong> <?= e($product['price']) ?></p>
      <p><strong>Created At:</strong> <?= e($product['created_at']) ?></p>
      <p><strong>Update At:</strong> <?= e($product['updated_at']) ?></p>
      <a href="index.php">Back to List</a>
    </div>
  <?php else: ?>
    <div>
      <p>Product not found.</p>
      <a href="index.php">Back to List</a>
    </div>
  <?php endif; ?>
</body>

</html>