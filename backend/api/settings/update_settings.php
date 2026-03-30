<?php
// Database connection file include karein
require_once '../../config/db_connect.php';

// Header set karein taake browser ko pata chale ke response JSON format mein hai
header('Content-Type: application/json');

// Sirf POST requests allow karein
if ($_SERVER['REQUEST_SERVER'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit;
}

// Frontend se bheja gaya JSON data receive karein
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Invalid data received"]);
    exit;
}

try {
    // Database table update karein (ID 1 hamesha fixed rahegi)
    $query = "UPDATE settings SET 
                store_name = :storeName,
                currency = :currency,
                tax_rate = :taxRate,
                language = :language,
                receipt_printer = :receiptPrinter,
                backup_freq = :backupFrequency,
                theme_color = :theme
              WHERE id = 1";

    $stmt = $pdo->prepare($query);

    // Data bind karein aur execute karein
    $result = $stmt->execute([
        ':storeName' => $data['storeName'],
        ':currency'  => $data['currency'],
        ':taxRate'   => $data['taxRate'],
        ':language'  => $data['language'],
        ':receiptPrinter' => $data['receiptPrinter'],
        ':backupFrequency' => $data['backupFrequency'],
        ':theme'     => $data['theme']
    ]);

    if ($result) {
        echo json_encode([
            "status" => "success",
            "message" => "Settings updated successfully"
        ]);
    } else {
        echo json_encode([
            "status" => "error", 
            "message" => "Failed to update database"
        ]);
    }

} catch (PDOException $e) {
    // Database errors handle karein
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Update failed: " . $e->getMessage()
    ]);
}
?>