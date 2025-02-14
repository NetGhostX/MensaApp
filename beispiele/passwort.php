<?php

// Configuration
$salt = 'emensa2023';  // Application-wide salt (not per user)
$password = 'test';     // Password for admin user
$email = 'admin@emensa.example';

// Generate salted SHA-1 hash
$hashedPassword = sha1($password . $salt);

// SQL query to create admin user
$sql = "INSERT INTO benutzer (
    name,
    email,
    passwort,
    admin,
    anzahlfehler,
    anzahlanmeldungen,
    letzteanmeldung,
    letzterfehler
) VALUES (
    'Administrator',
    '$email',
    '$hashedPassword',
    TRUE,
    0,
    0,
    NULL,
    NULL
);";

// Output results
echo "Configuration:\n";
echo "-------------\n";
echo "Salt: $salt\n";
echo "Password: $password\n";
echo "Email: $email\n\n";

echo "Generated Hash:\n";
echo "--------------\n";
echo "SHA-1 Hash: $hashedPassword\n\n";

echo "SQL Query:\n";
echo "----------\n";
echo $sql . "\n\n";

// Optional: Execute the query directly
if (isset($argv[1]) && $argv[1] === '--execute') {
    $db = new PDO(
        'mysql:host=localhost;dbname=emensa;charset=utf8',
        'root',
        ''
    );
    
    try {
        $db->exec($sql);
        echo "Success: Admin user created in database.\n";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}

// Usage instructions
echo "Usage:\n";
echo "------\n";
echo "1. Run script to see generated SQL: php passwort.php\n";
echo "2. Run script and execute SQL: php passwort.php --execute\n";
