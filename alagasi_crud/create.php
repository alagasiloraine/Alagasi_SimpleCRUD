<?php
require 'db.conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sql = "INSERT INTO products (name, description, quantity, price, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";
  $statement = $conn->prepare($sql);

  try {
    $statement->execute([$_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['price']]);
    header('Location: index.php?msg=New record created successfully');
    exit;
  } catch (PDOException $e) {
    $error = "Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Products</title>
</head>

<body>
  <h1>Add New Products</h1>
  <?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="post">
    <div>
      <label>Name: <input type="text" name="name" required></label>
    </div>
    <div>
      <label>Description: <textarea name="description"></textarea></label>
    </div>
    <div>
      <label>Quantity: <input type="number" name="quantity" required></label>
    </div>
    <div>
      <label>Price: <input type="number" step="0.01" name="price" required></label>
    </div>
    <button type="submit">Save</button>
    <a href="index.php">Cancel</a>
  </form>
</body>

</html>