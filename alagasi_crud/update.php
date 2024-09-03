<?php
require 'db.conn.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  die("Product ID is required.");
}

$product = $conn->prepare('SELECT * FROM products WHERE id = ?');
$product->execute([$id]);
$product = $product->fetch(PDO::FETCH_ASSOC) ?? die("Product not found.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $update = $conn->prepare("UPDATE products SET name = ?, description = ?, quantity = ?, price = ?, updated_at = NOW() WHERE id = ?");
  $update->execute([$_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['price'], $id]);
  header('Location: index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Product</title>
</head>

<body>
  <h1>Update Product</h1>
  <form method="post">
    <?php
    function createField($label, $type, $name, $value, $extra = '')
    {
      echo
      "<div>
        <label for='$name'>$label</label>
        <input type='$type' id='$name' name='$name' value='" . htmlspecialchars($value) . "' $extra required>
        </div>";
    }
    createField('Name', 'text', 'name', $product['name']);
    echo
    "<div>
        <label for='description'>Description</label>
        <textarea id='description' name='description' required>" . htmlspecialchars($product['description']) . "</textarea>
        </div>";
    createField('Quantity', 'number', 'quantity', $product['quantity']);
    createField('Price', 'number', 'price', $product['price'], "step='0.01'");
    ?>
    <button type="submit">Save</button>
  </form>
</body>

</html>