<?php
// Database connection file include karein
require_once '../../config/db_connect.php';

// Header set karein taake browser ko pata chale ke data JSON format mein hai
header('Content-Type: application/json');

try {
    // Sirf row ID 1 fetch karni hai kyunke settings hamesha single hoti hain
    $query = "SELECT * FROM settings WHERE id = 1 LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($settings) {
        // Agar data mil gaya to success response bhejein
        echo json_encode([
            "status" => "success",
            "data" => [
                "storeName" => $settings['store_name'],
                "currency" => $settings['currency'],
                "taxRate" => (float)$settings['tax_rate'],
                "language" => $settings['language'],
                "receiptPrinter" => $settings['receipt_printer'],
                "backupFrequency" => $settings['backup_freq'],
                "theme" => $settings['theme_color']
            ]
        ]);
    } else {
        // Agar table khali hai to default values bhejein taake UI crash na ho
        echo json_encode([
            "status" => "empty",
            "data" => [
                "storeName" => "Elyscents",
                "currency" => "PKR",
                "taxRate" => 17.0,
                "language" => "en",
                "receiptPrinter" => "default",
                "backupFrequency" => "daily",
                "theme" => "purple"
            ]
        ]);
    }

} catch (PDOException $e) {
    // Database error handle karein
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed: " . $e->getMessage()
    ]);
}
?>