<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read and decode the raw JSON input data
    $inputData = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($inputData['Order_Id']) || !isset($inputData['status'])) {
        http_response_code(400);
        echo json_encode(["message" => "Invalid input"]);
        exit;
    }

    $orderId = $inputData['Order_Id'];
    $status = $inputData['status'];

    // Prepare the SQL queries
    $sql = "UPDATE deliveries SET Status = ? WHERE Order_Id = ?";
    $sql1 = "UPDATE orders SET Status = ? WHERE Order_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt1 = $conn->prepare($sql1);

    if ($stmt === false || $stmt1 === false) {
        http_response_code(500);
        echo json_encode(["message" => "Failed to prepare the SQL statement: " . $conn->error]);
        exit;
    }

    // Bind parameters and execute the queries
    $stmt->bind_param("si", $status, $orderId);
    $stmt1->bind_param("si", $status, $orderId);

    if ($stmt->execute() && $stmt1->execute()) {
        echo json_encode(["message" => "Order delivered successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to update delivery status: " . ($stmt->error ?: $stmt1->error)]);
    }

    // Close the statements
    $stmt->close();
    $stmt1->close();
} else {
    http_response_code(405); // Method not allowed
    echo json_encode(["message" => "Invalid request method"]);
}

// Close the database connection
mysqli_close($conn);
?>