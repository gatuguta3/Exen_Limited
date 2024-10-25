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
$driver_id = $data['driver_id'] ?? '';
$date = $data['date'] ?? '';
$status = $data['Status'] ?? '';
$order_id = $data['order_id'] ?? '';
$delivery_id =rand(1000, 9999);

// Check if any required fields are missing
if (empty($driver_id) || empty($date) || empty($status) || empty($order_id)) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Missing required fields: driver_id, date, status, order_id"]);
    exit;
}

// Check if the Order_Id exists in the orders table
$sql = "SELECT * FROM orders WHERE Order_Id = '$order_id'";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    http_response_code(404); // Not Found
    echo json_encode(["error" => "Order_Id does not exist in the orders table"]);
    exit;
}

// Insert data into table
$sql = "INSERT INTO `deliveries`(`Delivery_Id`, `Driver_Id`, `Delivery_Date`, `Status`, `Order_Id`) VALUES ('$delivery_id','$driver_id', '$date', '$status', '$order_id')";
if ($conn->query($sql) === TRUE) {
    http_response_code(201); // Created
    echo json_encode(["message" => "New record created successfully"]);
$sql1="UPDATE `orders` SET `Status`='$status' WHERE Order_Id= '$order_id'";
$conn->query($sql1);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Error: " . $sql . " - " . $conn->error]);
}

$conn->close();
?>
