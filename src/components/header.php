<?php

$cart_quantity = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $cart_quantity += $product['quantity'];
    }
}


?>

<header>
    <?php if (isset($_COOKIE['user'])) : ?>
        <p>Logged in as <?= $_COOKIE['user'] ?></p>
        <div>

            <a href="/pages/cart.php" class="shopping-cart"><i class="fa-solid fa-cart-shopping"></i><small><?= $cart_quantity; ?></small></a>
            <a href="/handlers/logout.php">Logout</a>
        </div>
    <?php else : ?>
        <p>Not logged in</p>
        <a href="/pages/login.php">Login</a>
    <?php endif; ?>

</header>