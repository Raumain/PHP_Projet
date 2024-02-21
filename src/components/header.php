<?php

$cart_quantity = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $cart_quantity += $product['quantity'];
    }
}


?>

<style>
    header {
        background-color: #f2f2f2;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    header>p {
        display: flex;
        align-items: center;
    }

    header>p>a.orders {
        text-decoration: none;
        color: #da1e1e !important;
        margin-left: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    header>p>a.orders:hover {
        text-decoration: underline;
    }

    header>div {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    header>div>a {
        position: relative;
        text-decoration: none;
        color: #000;
        font-weight: bold;
        transition: all ease-in-out 0.1s;
    }

    header>div>a>i {
        font-size: 1.4rem;
    }

    header>div>a>small {
        position: absolute;
        top: -8px;
        right: -10px;
        background-color: red;
        border-radius: 50%;
        padding: 0.1rem 0.3rem;
        color: white;
    }

    header>div>a.shopping-cart:hover {
        color: #3e3e3e;
        transform: scale(1.1);
        transition: all ease-in-out 0.1s;
    }

    header>div>a:not(.shopping-cart):hover {
        text-decoration: underline;
        transition: all ease-in-out 0.1s;
    }
</style>

<header>
    <?php if (isset($_COOKIE['user'])) : ?>
        <p>Logged in as <a href="../pages/orders.php" class="orders"><?= $_COOKIE['user'] ?></a></p>
        <div>
            <a href="/pages/cart.php" class="shopping-cart"><i class="fa-solid fa-cart-shopping"></i><small><?= $cart_quantity; ?></small></a>
            <a href="/handlers/logout.php">Logout</a>
        </div>
    <?php else : ?>
        <p>Not logged in</p>
        <a href="/pages/login.php">Login</a>
    <?php endif; ?>

</header>