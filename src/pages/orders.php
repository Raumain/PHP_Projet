<?php
session_start();
require_once __DIR__ . '/../models/Order.php';
if (!isset($_COOKIE['user'])) {
    header('Location: /pages/login.php');
    exit;
}

$orders = new Order();
$list = $orders->getOrdersAndProductsByUser($_COOKIE['user-id']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/orders.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <?php include __DIR__ . '/../components/header.php'; ?>
    <a href="/"><i class="fa-solid fa-arrow-left"></i>Back to products</a>
    <h1>Orders</h1>
    <?php if (empty($list)) : ?>
        <p>No orders yet</p>
    <?php else : ?>
        <table>
            <tr>
                <th>Price</th>
                <th>Details</th>
            </tr>
            <?php foreach ($list as $order) : ?>
                <tr>
                    <td><?= $order['price'] ?></td>
                    <td>
                        <table>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                            </tr>
                            <?php foreach ($order['products'] as $product) : ?>
                                <tr>
                                    <td><?= $product['name'] ?></td>
                                    <td><?= $product['quantity'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>




</body>

</html>