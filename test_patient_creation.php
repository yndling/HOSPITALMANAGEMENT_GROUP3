<?php

// Test script to verify patient creation with new fields
// Bootstrap CodeIgniter manually for standalone script
require_once 'vendor/autoload.php';

// Load essential CodeIgniter components
require_once 'app/Config/Database.php';
require_once 'app/Config/Services.php';

// Initialize database connection
$db = \Config\Database::connect();
$patientModel = new \App\Models\PatientModel();

// Test data for new patient
$testData = [
    'patient_id' => 'TEST001',
    'first_name' => 'John',
    'middle_name' => 'Michael',
    'last_name' => 'Doe',
    'date_of_birth' => '1990-05-15',
    'age' => 34,
    'gender' => 'Male',
    'blood_type' => 'O+',
    'civil_status' => 'Married',
    'nationality' => 'American',
    'contact_number' => '+1-234-567-8900',
    'email_address' => 'john.doe@example.com',
    'home_address' => '123 Main Street, City, State 12345',
    'emergency_contact_name' => 'Jane Doe',
    'emergency_relationship' => 'Spouse',
    'emergency_contact_number' => '+1-234-567-8901',
    'emergency_address' => '123 Main Street, City, State 12345',
    'medical_history' => 'No significant medical history',
    'current_medications' => 'None',
    'allergies' => 'Penicillin',
    'past_surgeries' => 'Appendectomy (2015)',
    'chronic_conditions' => 'None',
    'family_medical_history' => 'Father: Hypertension, Mother: Diabetes'
];

echo "Testing patient creation with new fields...\n";

// Test validation
$validation = \Config\Services::validation();
$validation->setRules($patientModel->validationRules);

if (!$validation->run($testData)) {
    echo "Validation failed:\n";
    print_r($validation->getErrors());
    exit(1);
}

echo "Validation passed!\n";

// Test insertion
if ($patientId = $patientModel->insert($testData)) {
    echo "Patient created successfully with ID: $patientId\n";

    // Verify data was saved
    $savedPatient = $patientModel->find($patientId);
    echo "Verifying saved data...\n";

    $fieldsToCheck = [
        'patient_id', 'first_name', 'last_name', 'gender', 'blood_type',
        'emergency_contact_name', 'medical_history', 'allergies'
    ];

    foreach ($fieldsToCheck as $field) {
        if ($savedPatient[$field] === $testData[$field]) {
            echo "✓ $field: OK\n";
        } else {
            echo "✗ $field: FAILED (expected: {$testData[$field]}, got: {$savedPatient[$field]})\n";
        }
    }

    echo "Test completed successfully!\n";
} else {
    echo "Failed to create patient:\n";
    print_r($patientModel->errors());
}
