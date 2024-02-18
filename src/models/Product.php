<?php
require_once dirname(__FILE__) . '/../db/db.php';

class Product
{
    static private $TABLE_NAME = 'product';

    static private $DSN = 'mysql:host=mysql;dbname=shop';
    private $name;
    private $price;
    private $description;

    public function __construct()
    {
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
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

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDetails($id)
    {
        global  $db_user, $db_pass;
        $dbh = new PDO(self::$DSN, $db_user, $db_pass);
        $stmt = $dbh->prepare('SELECT * FROM ' . self::$TABLE_NAME . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    public function getList()
    {
        global $db_user, $db_pass;
        $dbh = new PDO(self::$DSN, $db_user, $db_pass);
        $stmt = $dbh->prepare('SELECT * FROM ' . self::$TABLE_NAME);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function save()
    {
        global $db_user, $db_pass;
        $dbh = new PDO(self::$DSN, $db_user, $db_pass);
        $stmt = $dbh->prepare('INSERT INTO ' . self::$TABLE_NAME . ' (name, price, description) VALUES (:name, :price, :description)');
        $stmt->execute([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
        ]);
    }

    public function update($id)
    {
        global $dbh;
        $stmt = $dbh->prepare(
            'UPDATE ' . self::$TABLE_NAME . ' SET name = :name, price = :price, description = :description WHERE id = :id'
        );
        $stmt->execute([
            'id' => $this->$id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
        ]);
    }
}
