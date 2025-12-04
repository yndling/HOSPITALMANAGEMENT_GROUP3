<?php

// Test script to verify patient update functionality
// Bootstrap CodeIgniter
require_once 'app/Config/Paths.php';
$paths = new Config\Paths();
require_once $paths->systemDirectory . '/Boot.php';
CodeIgniter\Boot::bootWeb($paths);

// Load config helper
require_once $paths->systemDirectory . '/Helpers/config_helper.php';

// Initialize database connection
$db = \Config\Database::connect();
$patientModel = new \App\Models\PatientModel();

// Get the test patient we created
$patient = $patientModel->find(1);

if (!$patient) {
    echo "Test patient not found. Please run test_patient_creation.php first.\n";
    exit(1);
}

echo "Testing patient update functionality...\n";

// Update data
$updateData = [
    'first_name' => 'Johnathan', // Changed from John
    'blood_type' => 'A+', // Changed from O+
    'allergies' => 'Penicillin, Sulfa drugs', // Updated allergies
    'chronic_conditions' => 'Mild hypertension' // Added new info
];

// Test update
if ($patientModel->updatePatient($patient['id'], $updateData)) {
    echo "Patient updated successfully!\n";

    // Verify updates
    $updatedPatient = $patientModel->find($patient['id']);

    $checks = [
        'first_name' => 'Johnathan',
        'blood_type' => 'A+',
        'allergies' => 'Penicillin, Sulfa drugs',
        'chronic_conditions' => 'Mild hypertension'
    ];

    foreach ($checks as $field => $expected) {
        if ($updatedPatient[$field] === $expected) {
            echo "✓ $field updated correctly\n";
        } else {
            echo "✗ $field update failed (expected: $expected, got: {$updatedPatient[$field]})\n";
        }
    }

    // Check that other fields weren't affected
    if ($updatedPatient['last_name'] === 'Doe') {
        echo "✓ Unchanged fields preserved\n";
    } else {
        echo "✗ Unchanged fields were modified\n";
    }

    echo "Update test completed successfully!\n";
} else {
    echo "Failed to update patient:\n";
    print_r($patientModel->errors());
}
