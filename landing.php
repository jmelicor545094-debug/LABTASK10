<?php
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';


$editUser = null;
if (isset($_GET['edit'])) {
    $user_id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDO CRUD System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>PDO</h1>
    <h2>WE FIND WAYS</h2>

    <div class="form-container">
        <h2><?= $editUser ? 'Update User' : 'USER INFORMATION' ?></h2>
        <form method="POST">
            <?php if ($editUser): ?>
                <input type="hidden" name="user_id" value="<?= $editUser['user_id'] ?>">
            <?php endif; ?>

            <label>Name:</label>
            <input type="text" name="name" value="<?= $editUser['name'] ?? '' ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= $editUser['email'] ?? '' ?>" required>

            <?php if (!$editUser): ?>
                <label>Product:</label>
                <input type="text" name="product" placeholder="Product" required>

                <label>Amount:</label>
                <input type="number" step="0.01" name="amount" placeholder="Amount" required>
            <?php endif; ?>

            <button type="submit" name="<?= $editUser ? 'update' : 'add' ?>">
                <?= $editUser ? 'Update' : 'Add' ?>
            </button>

            <?php if ($editUser): ?>
                <a href="landing.php" class="cancel-btn">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-container">
        <h2>USER AND PUSHER</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $row): ?>
                    <tr>
                        <td><?= $row['user_id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['product'] ?? '-' ?></td>
                        <td><?= $row['amount'] ?? '-' ?></td>
                        <td>
                            <a href="?edit=<?= $row['user_id'] ?>">Edit</a> |
                            <a href="?delete=<?= $row['user_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>