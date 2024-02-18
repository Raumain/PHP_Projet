<?php
if (!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])) {
    require_once dirname(__FILE__) . '/../db/db.php';
    $dbh = new PDO($dsn, $db_user, $db_pass);
    $stmt = $dbh->prepare('SELECT * FROM user WHERE email = :email');
    $stmt->execute([':email' => $_POST['email']]);
    $user = $stmt->fetch();
    if ($user && password_verify($_POST['password'], $user['password'])) {
        setcookie('user-id', $user['id'], time() + 3600 * 24 * 30, '/');
        setcookie('user', $user['name'], time() + 3600 * 24 * 30, '/');
        header('Location: / ');
        exit;
    }
    else{
        header('Location: /pages/login.php?user-error=Invalid email or password');
    }
}
