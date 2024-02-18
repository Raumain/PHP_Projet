<?php
require_once 'db.php';

try {
    global $dsn, $db_user, $db_pass;
    $dbh = new PDO($dsn, $db_user, $db_pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlFilePath = __DIR__ . '/2024-02-18_v0.1_create_database.sql';
    $sqlScript = file_get_contents($sqlFilePath);
    $dbh->exec($sqlScript);
    echo "Database created successfully.\n";

    $migrations = scandir(__DIR__);

    foreach ($migrations as $sqlFilePath) {
        if (pathinfo($sqlFilePath, PATHINFO_EXTENSION) !== "sql") {
            continue;
        }
        if (empty($sqlScript)) {
            continue;
        }

        $sqlScript = file_get_contents(__DIR__ . "/" . $sqlFilePath);
        var_dump($sqlScript);

        $sth = $dbh->prepare($sqlScript);

        if (!$sth->execute()) {
            throw new Exception("Error with script $sqlFilePath : '$sqlScript'");
        }
    }
} catch (PDOException $e) {
    echo "Error creating database: " . $e->getMessage() . "\n";
}
