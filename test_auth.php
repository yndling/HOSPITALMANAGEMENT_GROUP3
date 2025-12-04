// Bootstrap CodeIgniter
require_once 'app/Config/Paths.php';
$paths = new Config\Paths();
require_once $paths->systemDirectory . '/Boot.php';
CodeIgniter\Boot::bootWeb($paths);

// Initialize database connection
$db = \Config\Database::connect();

// Initialize UserModel
$userModel = new \App\Models\UserModel();

echo "Testing Authentication System...\n\n";

// Test data for different roles
$testUsers = [
    [
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'role' => 'admin',
        'password' => 'password123'
    ],
    [
        'name' => 'Doctor User',
        'email' => 'doctor@test.com',
        'role' => 'doctor',
        'password' => 'password123'
    ],
    [
        'name' => 'Nurse User',
        'email' => 'nurse@test.com',
        'role' => 'nurse',
        'password' => 'password123'
    ],
    [
        'name' => 'Receptionist User',
        'email' => 'receptionist@test.com',
        'role' => 'receptionist',
        'password' => 'password123'
    ],
    [
        'name' => 'Lab Staff User',
        'email' => 'lab@test.com',
        'role' => 'laboratory_staff',
        'password' => 'password123'
    ]
];

// Test user registration
echo "Testing User Registration:\n";
foreach ($testUsers as $userData) {
    $data = [
        'name' => $userData['name'],
        'email' => $userData['email'],
        'role' => $userData['role'],
        'password_hash' => password_hash($userData['password'], PASSWORD_DEFAULT),
    ];

    try {
        $userId = $userModel->insert($data);
        if ($userId) {
            echo "✓ Registered {$userData['role']}: {$userData['email']}\n";
        } else {
            echo "✗ Failed to register {$userData['role']}: " . implode(', ', $userModel->errors()) . "\n";
        }
    } catch (Exception $e) {
        echo "✗ Error registering {$userData['role']}: " . $e->getMessage() . "\n";
    }
}

echo "\nTesting User Authentication:\n";

// Test user login
foreach ($testUsers as $userData) {
    $user = $userModel->where('email', $userData['email'])->first();

    if ($user) {
        $passwordValid = password_verify($userData['password'], $user['password_hash']);
        $roleNormalized = str_replace(' ', '_', strtolower($user['role']));

        echo "✓ Found user: {$userData['email']} (Role: {$user['role']})\n";
        echo "  - Password valid: " . ($passwordValid ? 'Yes' : 'No') . "\n";
        echo "  - Normalized role: {$roleNormalized}\n";

        // Test role routing
        $roleRoutes = [
            'admin' => '/admin/dashboard',
            'doctor' => '/doctor/dashboard',
            'nurse' => '/dashboard',
            'receptionist' => '/dashboard',
            'laboratory_staff' => '/dashboard',
            'pharmacist' => '/dashboard',
            'accountant' => '/dashboard',
            'it_staff' => '/dashboard',
        ];

        $redirectUrl = $roleRoutes[$roleNormalized] ?? '/dashboard';
        echo "  - Redirect URL: {$redirectUrl}\n\n";

    } else {
        echo "✗ User not found: {$userData['email']}\n\n";
    }
}

echo "Authentication testing completed!\n";
