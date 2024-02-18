<?php
require_once dirname(__FILE__) . '/../db/db.php';

class User {
    static private $TABLE_NAME = 'user';
    static private  $DSN = 'mysql:host=mysql;dbname=shop';
    private $name;
    private $surname;
    private $password;
    private $email;

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

    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }



    public function save()
    {
        global $db_user , $db_pass;
        $dbh = new PDO(self::$DSN, $db_user, $db_pass);
        $stmt = $dbh->prepare('INSERT INTO ' . self::$TABLE_NAME . ' (name, surname, password, email) VALUES (:name, :surname, :password, :email)');
        $stmt->bindParam(':name', $this->getName());
        $stmt->bindParam(':surname', $this->getSurname());
        $stmt->bindParam(':password', $this->getPassword());
        $stmt->bindParam(':email', $this->getEmail());
        $stmt->execute();
    }

    static public function get($id)
    {
        global $db_user, $db_pass;
        $dbh = new PDO(self::$DSN, $db_user, $db_pass);
        $stmt = $dbh->prepare('SELECT * FROM ' . self::$TABLE_NAME . ' WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();

    }
}