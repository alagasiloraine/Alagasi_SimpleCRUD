<?php
require 'db.conn.php';

$id = $_GET['id'] ?? null;

$sql = 'DELETE FROM products WHERE id = ?';
$statement = $conn->prepare($sql);

$statement->execute([$id]);

header('Location: index.php');
