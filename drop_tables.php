<?php

// Simple script to drop tables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hmsdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tables = ['appointments', 'lab_records', 'lab_requests', 'lab_results', 'patients', 'users'];

foreach ($tables as $table) {
    $sql = "DROP TABLE IF EXISTS $table";
    if ($conn->query($sql) === TRUE) {
        echo "Table $table dropped successfully\n";
    } else {
        echo "Error dropping table $table: " . $conn->error . "\n";
    }
}

// Truncate migrations table
$sql = "TRUNCATE TABLE migrations";
if ($conn->query($sql) === TRUE) {
    echo "Migrations table truncated successfully\n";
} else {
    echo "Error truncating migrations table: " . $conn->error . "\n";
}

$conn->close();
?>
