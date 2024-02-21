<?php

require_once dirname(__FILE__) . '/../db/db.php';

class Order{
    static private  $DSN = 'mysql:host=mysql;dbname=shop';
    private $user_id;
    private $price;

    public function __construct()
    {
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function saveOrder($user_id, $price, $cart)
    {
        global $db_user, $db_pass;
        $dbh = new PDO(self::$DSN, $db_user, $db_pass);
        $stmt = $dbh->prepare("INSERT INTO `user_order` (user_id, price) VALUES (:user_id, :price)");
        $stmt->execute([
            ":user_id" => $user_id,
            ":price" => $price
        ]);
        $order_id = $dbh->lastInsertId();
        $stmt = $dbh->prepare("INSERT INTO products_order (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
        foreach ($cart as $product) {
            $stmt->execute([
                ":order_id" => $order_id,
                ":product_id" => $product["product_id"],
                ":quantity" => $product["quantity"]
            ]);
        }
        unset($_SESSION["cart"]);
        return $order_id;
    }


    public function getOrdersAndProductsByUser($user_id)
    {
        global $db_user, $db_pass;
        $dbh = new PDO(self::$DSN, $db_user, $db_pass);
        $stmt = $dbh->prepare("SELECT * FROM user_order WHERE user_id = :user_id");
        $stmt->execute([":user_id" => $user_id]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $dbh->prepare("SELECT * FROM products_order WHERE order_id = :order_id");
        $stmt = $dbh->prepare("SELECT products_order.*, product.name FROM products_order JOIN product ON products_order.product_id = product.id WHERE order_id = :order_id");
        foreach ($orders as $key => $order) {
            $stmt->execute([":order_id" => $order["id"]]);
            $orders[$key]["products"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $orders;

    }
}