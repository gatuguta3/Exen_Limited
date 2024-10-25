<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read and decode the raw JSON input data
    $inputData = json_decode(file_get_contents('php://input'), true);
    
    // Validate input data
    if (!isset($inputData['Serv_Id'], $inputData['status'], $inputData['mpesa_number'], $inputData['transaction_id'], $inputData['bank_id'])) {
        http_response_code(400);
        echo json_encode(["message" => "Invalid input"]);
        exit;
    }

    $ServiceId = $inputData['Serv_Id'];
    $status = $inputData['status'];
    $mpesa_number = $inputData['mpesa_number']; // Cast to float for safety
    $transaction_id = $inputData['transaction_id']; // Cast to float for safety
    $bank_id = $inputData['bank_id']; // Cast to float for safety
    $currentDate = date('Y-m-d');
    $payId =rand(1000, 9999);


    // Prepare the SQL query to update the order status
    $sql = "UPDATE services SET Status = ? WHERE Serv_Id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(["message" => "Failed to prepare the SQL statement: " . $conn->error]);
        exit;
    }

    // Bind parameters and execute the query
    $stmt->bind_param("si", $status,  $ServiceId);
    if ($stmt->execute()) {
        echo json_encode(["message" => "Service was paid successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to update service status: " . $stmt->error]);
    }

    $method = !empty($bank_id) ? 'bank' : 'mpesa'; // Determine payment method
   $acc_no = !empty($bank_id) ? mysqli_real_escape_string($conn, $bank_id) : null; // Bank account number
   $sql = "INSERT INTO `payments`(`pay_id`,`Serv_id`, `Method`, `Acc_no`, `mpesa_number`, `mpesa_code`,`Date_Paid`) 
           VALUES ('$payId','$ServiceId','$method', '$acc_no', '$mpesa_no', '$transaction_id' ,'$currentDate')";
   
   if (!$conn->query($sql)) {
       $conn->rollback();
       echo json_encode(["success" => "false", "message" => "Error inserting payment: " . $conn->error]);
       return;
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