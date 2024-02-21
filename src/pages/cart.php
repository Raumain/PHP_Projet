<?php
session_start();
if (!isset($_COOKIE['user'])) {
    header('Location: /pages/login.php');
    exit;
}

if (isset($_GET['id']) && isset($_GET['minus'])) {
    foreach ($_SESSION["cart"] as $key => $value) {
        if ($value['product_id'] == $_GET['id']) {
            if ($value['quantity'] == 1) {
                unset($_SESSION['cart'][$key]);
            } else {
                $_SESSION['cart'][$key]['quantity']--;
            }
            header('Location: /pages/cart.php');
            exit;
        }
    }
}

if (isset($_GET['id']) && isset($_GET['plus'])) {
    foreach ($_SESSION["cart"] as $key => $value) {
        if ($value['product_id'] == $_GET['id']) {
            $_SESSION['cart'][$key]['quantity']++;
            header('Location: /pages/cart.php');
            exit;
        }
    }
}


$cart_quantity = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $cart_quantity += $product['quantity'];
    }
}

$total_price = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $total_price += $product['product_price'] * $product['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cart (<?= $cart_quantity ?> items)</title>
</head>

<body>
    <?php include __DIR__ . '/../components/header.php'; ?>
    <a href="/"><i class="fa-solid fa-arrow-left"></i>Back to products</a>
    <h1>Cart</h1>

    <?php if (isset($_SESSION['order'])) : ?>
        <p>Your order has been placed. Order number: <?= $_SESSION['order'] ?></p>
        <?php unset($_SESSION['order']); ?>
    <?php endif; ?>

    <?php if (empty($_SESSION['cart'])) : ?>
        <p>No products in cart</p>
    <?php else : ?>
        <ul class="products-list">
            <?php foreach ($_SESSION['cart'] as $product) : ?>
                <li class="product-card">
                    <h2><?= $product['product_name'] ?></h2>
                    <p><?= $product['product_description'] ?></p>
                    <p><?= $product['product_price'] ?> €</p>
                    <div>
                        <p>Quantity: <?= $product['quantity'] ?></p>
                        <div>
                            <a href="cart.php?id=<?= $product["product_id"] ?>&minus">
                                <button type="submit"><i class="fa-solid fa-minus"></i></button>
                            </a>
                            <a href="cart.php?id=<?= $product["product_id"] ?>&plus">
                                <button type="submit"><i class="fa-solid fa-plus"></i></button>
                            </a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="total">Total price: <?= $total_price; ?> €</p>
    <?php endif; ?>
    <a href="/handlers/order.php" class="order">Order</a>
</body>

</html>