<?php
require_once 'db.php';

try {
    global $dsn, $db_user, $db_pass;
    $dbh = new PDO('mysql:host=mysql', $db_user, $db_pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlFilePath = __DIR__ . '/2024-02-18_v0.1_create_database.sql';
    $sqlScript = file_get_contents($sqlFilePath);
    $dbh->exec($sqlScript);
    echo "Database created successfully.\n";
} catch (PDOException $e) {
    echo "Error creating database: " . $e->getMessage() . "\n";
}
