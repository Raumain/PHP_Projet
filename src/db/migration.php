<?php
require_once 'db.php';

// Execute the migration that creates the database
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
        if (pathinfo($sqlFilePath, PATHINFO_FILENAME) === "data") {
            continue;
        }
        if (empty($sqlScript)) {
            continue;
        }
        echo $sqlFilePath . "\n";

        $sqlScript = file_get_contents(__DIR__ . "/" . $sqlFilePath);
        var_dump($sqlScript);

        // Split the SQL script into individual queries
        $queries = explode(';', $sqlScript);

        // Execute each query separately
        foreach ($queries as $query) {
            if (trim($query) !== '') {
                $sth = $dbh->prepare($query);
                $sth->execute();
            }
        }
    }
} catch (PDOException $e) {
    echo "Error creating database: " . $e->getMessage() . "\n";
}
