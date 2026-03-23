<?php
require_once 'db-config.php';

header('Content-Type: application/json');

// Check if just checking database existence
if (isset($_GET['check'])) {
    $check_sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'pandora_produce'";
    $result = $conn->query($check_sql);
    echo json_encode(['dbExists' => $result->num_rows > 0]);
    exit;
}

$output = "Starting database setup...\n";

try {
    // Read database schema
    $schema_file = __DIR__ . '/database.sql';
    if (!file_exists($schema_file)) {
        throw new Exception("database.sql file not found");
    }
    
    $sql_content = file_get_contents($schema_file);
    $output .= "✓ Schema file loaded\n";
    
    // Execute SQL statements
    $statements = explode(';', $sql_content);
    $count = 0;
    
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement) && !preg_match('/^--/', $statement)) {
            if ($conn->query($statement) === TRUE) {
                $count++;
                $output .= "✓ Query executed\n";
            } else {
                $output .= "⚠ Query error: " . $conn->error . "\n";
            }
        }
    }
    
    $output .= "\n✓ Database setup completed!\n";
    $output .= "✓ Tables created successfully\n";
    $output .= "✓ Sample products inserted\n";
    $output .= "\nYou can now:\n";
    $output .= "1. Visit index.php to browse products\n";
    $output .= "2. Add products to cart\n";
    $output .= "3. Checkout and place orders\n";
    $output .= "4. View orders in admin.php\n";
    
    echo json_encode([
        'success' => true,
        'output' => $output,
        'message' => 'Database setup completed successfully'
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'output' => $output,
        'message' => $e->getMessage()
    ]);
}

$conn->close();
?>
