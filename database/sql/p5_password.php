<?php

$salt = 'emensa2023';
$password = 'test';
$hashedPassword = sha1($password . $salt);

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
       'admin@emensa.example',
       '$hashedPassword',
       TRUE,
       0,
       0,
       NULL,
       NULL
);";

echo "Hashed password (SHA-1): " . $hashedPassword . "\n";
echo "\nSQL Query to execute:\n" . $sql . "\n";

// Database connection parameters
$host = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "emensa"; // Replace with your database name

// Create connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
       die("Connection failed: " . $mysqli->connect_error);
}

// Execute query
if ($mysqli->query($sql) === TRUE) {
       echo "\nAdmin user created successfully";
} else {
       echo "\nError: " . $mysqli->error;
}

// Close connection
$mysqli->close();
