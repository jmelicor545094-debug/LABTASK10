<?php
require 'config.php';


$sql = "SELECT u.users_id, u.name, u.email, o.orders_id, o.product, o.amount
        FROM users u
        INNER JOIN orders o ON u.users_id = o.user_id
        ORDER BY u.users_id";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($results as $row) {
    echo "User ID: {$row['users_id']} - Name: {$row['name']} ({$row['email']})<br>";
    echo "Order ID: {$row['orders_id']} - Product: {$row['product']} - Amount: {$row['amount']}<br><hr>";
}
?>