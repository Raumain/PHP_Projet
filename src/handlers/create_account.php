<?php

if (!empty($_POST) && !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    try {
        require_once dirname(__FILE__) . '/../db/db.php';
        $dbh = new PDO($dsn, $db_user, $db_pass);
        $stmt = $dbh->prepare('INSERT INTO user (name, surname, email, password) VALUES (:name, :surname, :email, :password)');
        $stmt->execute([
            ':name' => $_POST['name'],
            ':surname' => $_POST['surname'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);
        setcookie('user', $_POST['name'], time() + 3600 * 24 * 30, '/');
        header('Location: / ');
        exit;
    } catch (Exception $e) {
        header('Location: /pages/login.php?user-error=Email already taken');
    }
}
