<?php

// display the product corresponding to the id in the URL

require_once __DIR__ . '/../models/Product.php';
session_start();

$product = new Product();
$productDetails = $product->getDetails($_GET['id']);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/product.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?= $productDetails['name'] ?></title>
</head>

<body>
    <?php include __DIR__ . '/../components/header.php'; ?>
    <a href="/"><i class="fa-solid fa-arrow-left"></i>Back to products</a>
    <div class="product">
        <div class="head">
            <h1><?= $productDetails['name'] ?></h1>
            <p><?= $productDetails['description'] ?></p>
        </div>
        <div class="body">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit iure neque magnam quas voluptas sequi enim recusandae blanditiis labore! Architecto dolor explicabo magnam velit, modi adipisci praesentium rerum earum debitis?</p>
        </div>
        <div class="foot">
            <p><?= $productDetails['price'] ?> €</p>
            <form action="/handlers/cart.php?from=<?= $productDetails['id'] ?>" method="post">
                <input type="hidden" name="product_id" value="<?= $productDetails['id'] ?>">
                <input type="hidden" name="product_name" value="<?= $productDetails['name'] ?>">
                <input type="hidden" name="product_price" value="<?= $productDetails['price'] ?>">
                <input type="hidden" name="product_description" value="<?= $productDetails['description'] ?>">
                <button type="submit"><i class="fa-solid fa-plus"></i></button>
            </form>
        </div>
    </div>
</body>

</html>