<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read and decode the raw JSON input data
    $inputData = json_decode(file_get_contents('php://input'), true);
    
    // Validate input data
    if (!isset($inputData['Serv_Id'], $inputData['status'], $inputData['service_fee'], $inputData['other_fee'], $inputData['supplies_fee'])) {
        http_response_code(400);
        echo json_encode(["message" => "Invalid input"]);
        exit;
    }

    $ServiceId = $inputData['Serv_Id'];
    $status = $inputData['status'];
    $servicefee = (float)$inputData['service_fee']; // Cast to float for safety
    $otherfee = (float)$inputData['other_fee']; // Cast to float for safety
    $suppliesfee = (float)$inputData['supplies_fee']; // Cast to float for safety
    $currentDate = date('Y-m-d');

    $totalservicefee = $servicefee + $otherfee;

    // Prepare the SQL query to update the order status
    $sql = "UPDATE services SET Status = ?, Date_Completed = ?, Service_fee = ?, Supplies_Cost = ? WHERE Serv_Id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(["message" => "Failed to prepare the SQL statement: " . $conn->error]);
        exit;
    }

    // Bind parameters and execute the query
    $stmt->bind_param("ssdsi", $status, $currentDate, $totalservicefee, $suppliesfee, $ServiceId);
    if ($stmt->execute()) {
        echo json_encode(["message" => "Service was completed successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to update service status: " . $stmt->error]);
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