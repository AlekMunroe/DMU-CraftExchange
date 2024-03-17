<?php
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'employee')) {
    header('Location: login.php');
    exit;
}

$dbPath = __DIR__ . '/items_database.db';
$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE TABLE IF NOT EXISTS items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    price INTEGER NOT NULL,
    currency TEXT NOT NULL,
    image TEXT NOT NULL,
    item_limit INTEGER NOT NULL,
    instock BOOLEAN NOT NULL,
    stockamount INTEGER NOT NULL,
    showstockamount BOOLEAN NOT NULL,
    order_num INTEGER DEFAULT 0
)");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $maxOrderNum = $db->query("SELECT MAX(order_num) FROM items")->fetchColumn();
        $orderNum = $maxOrderNum !== false ? $maxOrderNum + 1 : 0;

        $stmt = $db->prepare("INSERT INTO items (name, price, currency, image, item_limit, instock, stockamount, showstockamount, order_num)
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'], $_POST['price'], $_POST['currency'], $_POST['image'],
            $_POST['item_limit'], $_POST['instock'] == '1', $_POST['stockamount'], $_POST['showstockamount'] == '1', $orderNum
        ]);
        header('Location: database.php');
        exit;
    } elseif (isset($_POST['delete'])) {
        $stmt = $db->prepare("DELETE FROM items WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        header('Location: database.php');
        exit;
    } elseif (isset($_POST['move'])) {
        $id = $_POST['id'];
        $direction = $_POST['direction'];
        $currentOrder = $db->query("SELECT order_num FROM items WHERE id = $id")->fetchColumn();
        
        if ($direction == 'up') {
            $swapItem = $db->query("SELECT id, order_num FROM items WHERE order_num < $currentOrder ORDER BY order_num DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        } else {
            $swapItem = $db->query("SELECT id, order_num FROM items WHERE order_num > $currentOrder ORDER BY order_num ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        }
        
        if ($swapItem) {
            $db->exec("UPDATE items SET order_num = {$swapItem['order_num']} WHERE id = $id");
            $db->exec("UPDATE items SET order_num = $currentOrder WHERE id = {$swapItem['id']}");
        }
        
        header('Location: database.php');
        exit;
    } elseif (isset($_POST['edit'])) {
        $editId = $_POST['edit_id'];
        $stmt = $db->prepare("UPDATE items SET name = ?, price = ?, currency = ?, image = ?, item_limit = ?, instock = ?, stockamount = ?, showstockamount = ? WHERE id = ?");
        $stmt->execute([
            $_POST['name'], $_POST['price'], $_POST['currency'], $_POST['image'],
            $_POST['item_limit'], $_POST['instock'] == '1', $_POST['stockamount'], $_POST['showstockamount'] == '1', $editId
        ]);
        header('Location: database.php');
        exit;
    }
}

$editItem = null;
if (isset($_GET['edit'])) {
    $editItemId = $_GET['edit'];
    $editItemStmt = $db->prepare("SELECT * FROM items WHERE id = ?");
    $editItemStmt->execute([$editItemId]);
    $editItem = $editItemStmt->fetch(PDO::FETCH_ASSOC);
}

$items = $db->query("SELECT * FROM items ORDER BY order_num ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Management</title>
</head>
<body>
    <h1>Item Management</h1>
    
    <?php if ($editItem): ?>
        <h2>Edit Item</h2>
        <form action="database.php" method="post">
            <input type="hidden" name="edit_id" value="<?= $editItem['id'] ?>">
            <input type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($editItem['name']) ?>" required>
            <input type="number" name="price" placeholder="Price" value="<?= htmlspecialchars($editItem['price']) ?>" required>
            <input type="text" name="currency" placeholder="Currency" value="<?= htmlspecialchars($editItem['currency']) ?>" required>
            <input type="text" name="image" placeholder="Image Path" value="<?= htmlspecialchars($editItem['image']) ?>" required>
            <input type="number" name="item_limit" placeholder="Limit" value="<?= htmlspecialchars($editItem['item_limit']) ?>" required>
            <select name="instock">
                <option value="1" <?= $editItem['instock'] ? 'selected' : '' ?>>In Stock</option>
                <option value="0" <?= !$editItem['instock'] ? 'selected' : '' ?>>Out of Stock</option>
            </select>
            <input type="number" name="stockamount" placeholder="Stock Amount" value="<?= htmlspecialchars($editItem['stockamount']) ?>" required>
            <select name="showstockamount">
                <option value="1" <?= $editItem['showstockamount'] ? 'selected' : '' ?>>Yes</option>
                <option value="0" <?= !$editItem['showstockamount'] ? 'selected' : '' ?>>No</option>
            </select>
            <button type="submit" name="edit">Save Changes</button>
        </form>
    <?php else: ?>
        <h2>Add New Item</h2>
        <form action="database.php" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="number" name="price" placeholder="Price" required>
            <input type="text" name="currency" placeholder="Currency" required>
            <input type="text" name="image" placeholder="Image Path" required>
            <input type="number" name="item_limit" placeholder="Limit" required>
            <select name="instock">
                <option value="1">In Stock</option>
                <option value="0">Out of Stock</option>
            </select>
            <input type="number" name="stockamount" placeholder="Stock Amount" required>
            <select name="showstockamount">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <button type="submit" name="add">Add Item</button>
        </form>
    <?php endif; ?>

    <h2>Items List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Currency</th>
                <th>Image</th>
                <th>Limit</th>
                <th>In Stock</th>
                <th>Stock Amount</th>
                <th>Show Stock Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= htmlspecialchars($item['price']) ?></td>
                    <td><?= htmlspecialchars($item['currency']) ?></td>
                    <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 50px; height: auto;"></td>
                    <td><?= htmlspecialchars($item['item_limit']) ?></td>
                    <td><?= $item['instock'] ? 'Yes' : 'No' ?></td>
                    <td><?= htmlspecialchars($item['stockamount']) ?></td>
                    <td><?= $item['showstockamount'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <form action="database.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                        <form action="database.php" method="get" style="display: inline;">
                            <input type="hidden" name="edit" value="<?= $item['id'] ?>">
                            <button type="submit">Edit</button>
                        </form>
                        <form action="database.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="direction" value="up">
                            <button type="submit" name="move">Move Up</button>
                        </form>
                        <form action="database.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="direction" value="down">
                            <button type="submit" name="move">Move Down</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
