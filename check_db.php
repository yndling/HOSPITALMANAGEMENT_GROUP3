<?php

// Bootstrap CodeIgniter
require_once 'app/Config/Paths.php';
$paths = new Config\Paths();
require_once $paths->systemDirectory . '/Boot.php';
CodeIgniter\Boot::bootWeb($paths);

// Initialize database connection
$db = \Config\Database::connect();

echo "Checking database state...\n\n";

try {
    // Check if tables exist
    $tables = ['users', 'patients'];
    foreach ($tables as $table) {
        $result = $db->query("SHOW TABLES LIKE '$table'");
        if ($result->getNumRows() > 0) {
            echo "✓ Table '$table' exists\n";

            // Get record count
            $countResult = $db->query("SELECT COUNT(*) as count FROM $table");
            $count = $countResult->getRow()->count;
            echo "  - Records: $count\n";

            // Show sample data if exists
            if ($count > 0) {
                $sample = $db->query("SELECT * FROM $table LIMIT 1")->getRowArray();
                echo "  - Sample: " . json_encode($sample) . "\n";
            }
        } else {
            echo "✗ Table '$table' does not exist\n";
        }
        echo "\n";
    }

    echo "Database check completed!\n";

} catch (Exception $e) {
    echo "Error checking database: " . $e->getMessage() . "\n";
}
