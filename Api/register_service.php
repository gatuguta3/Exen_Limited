<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

include "Connect.php";

$servid=uniqid();
$status="CU1";
$currentDate = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawData = file_get_contents('php://input');

    // Log the raw data to see what's being received
    error_log("Raw data received: " . $rawData);

    // Check if data is empty
    if (empty($rawData)) {
        echo json_encode(["message" => "No data received"]);
        http_response_code(400);
        exit;
    }

    // Decode JSON data
    $data = json_decode($rawData, true);

    // Check if JSON decoding failed
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["message" => "Invalid JSON data", "error" => json_last_error_msg()]);
        http_response_code(400);
        exit;
    }

    // Extract data
    $id = $data['id'];
    $type = $data['type'];
    $description = $data['description'];
    $image = $data['image'];

    // Decode the base64 image
    $imageData = base64_decode($image);

    // Escape strings to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $type = mysqli_real_escape_string($conn, $type);
    $description = mysqli_real_escape_string($conn, $description);

    // Prepare the SQL statement with parameter binding
    $stmt = $conn->prepare("INSERT INTO `services` (`Serv_id`, `Type`, `Date_Booked`, `Cust_Id`, `Description`, `Description_Image`, `Status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(["message" => "Failed to prepare statement", "error" => $conn->error]);
        http_response_code(500);
        exit;
    }
    $stmt->bind_param('sssssss', $servid, $type, $currentDate, $id, $description, $imageData, $status);

    if ($stmt->execute()) {
        echo json_encode(["message" => "New record created successfully"]);
    } else {
        error_log("Error: " . $stmt->error);
        echo json_encode(["message" => "Failed to create a new record.", "error" => $stmt->error]);
        http_response_code(500);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
    http_response_code(405);
}

mysqli_close($conn);