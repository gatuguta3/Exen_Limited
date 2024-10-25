<?php
include "Connect.php";

// Enable detailed error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set the response to return JSON
header('Content-Type: application/json');

// Read and decode the incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);

// If unable to parse the JSON, return an error message
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Unable to parse JSON data - " . json_last_error_msg()]);
    exit;
}

// Get the values from the JSON
$designer_id = $data['Designer_Id'] ?? '';
$date = $data['date'] ?? '';
$status = $data['Status'] ?? '';
$serviceId = $data['Serv_Id'] ?? '';

// Check if any required fields are missing
if (empty($designer_id) || empty($date) || empty($status) || empty($serviceId)) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Missing required fields: installer_Id, date, status, Serv_Id"]);
    exit;
}

// Check if the Order_Id exists in the orders table
$sql = "SELECT * FROM services WHERE Serv_id = '$serviceId'";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    http_response_code(404); // Not Found
    echo json_encode(["error" => "service Id does not exist in the orders table"]);
    exit;
}

// Insert data into table
$sql="UPDATE `services` SET `Status`='$status',`Start_Date`='$date',`Designer_Id`='$designer_id' WHERE Serv_id= '$serviceId'";

if ($conn->query($sql) === TRUE) {
    http_response_code(201); // Created
    echo json_encode(["message" => "Services updated successfully"]);

} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Error: " . $sql . " - " . $conn->error]);
}

$conn->close();
?>
