<?php
require_once dirname(__FILE__) . '/../models/Order.php';
session_start();
if (!isset($_COOKIE["user"])) {
    header("Location: /pages/login.php");
    exit;
}
if (empty($_SESSION["cart"])) {
    header("Location: /pages/cart.php");
    exit;
}

$order = new Order();
$price = array_reduce($_SESSION["cart"], function ($total, $product) {
    return $total + $product["product_price"] * $product["quantity"];
}, 0);
$order_id = $order->saveOrder($_COOKIE["user-id"], $price, $_SESSION["cart"]);
$_SESSION["order"] = $order_id;
header("Location: /pages/cart.php");
