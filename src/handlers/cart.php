<?php

if (!isset($_COOKIE['user'])) {
    header('Location: /pages/login.php');
    exit;
}

if (!empty($_POST)) {
    session_start();
    $location = isset($_GET['from']) ? '/pages/product.php?id=' . $_GET['from'] : '/';
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_id'] === $_POST['product_id']) {
            $_SESSION['cart'][$key]['quantity']++;
            header('Location: ' . $location);   
            exit;
        }
    }
    $_SESSION['cart'][] = $_POST;
    $_SESSION['cart'][count($_SESSION['cart']) - 1]['quantity'] = 1;
    header('Location: ' . $location);
    exit;
}
