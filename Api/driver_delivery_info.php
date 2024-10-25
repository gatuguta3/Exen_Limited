<?php
include "Connect.php";
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    // Check if 'Order_Id' is present and not empty in the decoded JSON
    if (!isset($inputData['Order_Id']) || empty($inputData['Order_Id'])) {
        http_response_code(400);
        echo json_encode(["message" => "Order ID is required"]);
        exit;
    }

    // Cast and validate the order ID
    $orderId = (int) $inputData['Order_Id'];
    if ($orderId <= 0) { // Use $orderId instead of $userId
        http_response_code(400);
        echo json_encode(["message" => "Invalid order ID"]);
        exit;
    }

    $sql = "SELECT `Receiver_name`, `phone_no`, `county`, `town`, `Nearest_landmark` FROM `delivery locations`
            WHERE `Order_id` = ?";

    $stmt = $conn->prepare($sql);

    // Check if the SQL statement was prepared successfully
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(["message" => "Failed to prepare the SQL statement: " . $conn->error]);
        exit;
    }

    // Bind the Order ID parameter and execute the query
    $stmt->bind_param("i", $orderId);
    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(["message" => "Failed to execute query: " . $stmt->error]);
        exit;
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Output the delivery details as a JSON object
        echo json_encode($row);
    } else {
        // No order found for the given order ID
        echo json_encode([]);
    }

    // Close the statement
    $stmt->close();
} else {
    http_response_code(405); // Method not allowed
    echo json_encode(["message" => "Invalid request method"]);
}

// Close the database connection
mysqli_close($conn);
?>
