<?php
require_once __DIR__ . '/models/Product.php';
session_start();

$products = new Product();
$productsList = $products->getList();
// var_dump($_SESSION['cart']);
// die();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Products</title>
</head>

<body>
    <?php include __DIR__ . '/components/header.php'; ?>
    <h1>Products list</h1>
    <ul class="products-list">
        <?php foreach ($productsList as $product) : ?>
            <li class="product-card">
                <h2><?= $product['name'] ?></h2>
                <p><?= $product['description'] ?></p>
                <p><?= $product['price'] ?> €</p>
                <div>
                    <a href="pages/product.php?id=<?= $product['id'] ?>">View details</a>
                    <form action="handlers/cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                        <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                        <input type="hidden" name="product_description" value="<?= $product['description'] ?>">
                        <button type="submit"><i class="fa-solid fa-plus"></i></button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>