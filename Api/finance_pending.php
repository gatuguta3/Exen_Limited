<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Read and decode the raw JSON input data
  $inputData = json_decode(file_get_contents('php://input'), true);

  // Prepare the SQL query to fetch all orders with a status of "pending"
  $sql = "SELECT o.Order_Id, o.Amount, o.Date_Payed, o.Status, p.mpesa_number, p.mpesa_code, p.Acc_no, p.pay_id ,p.Method
           FROM orders o LEFT JOIN payments p ON o.Order_Id = p.Order_id WHERE o.Status = 'pending';";
  $stmt = $conn->prepare($sql);

  // Check if the SQL statement was prepared successfully
  if ($stmt === false) {
    http_response_code(500);
    echo json_encode(["message" => "Failed to prepare the SQL statement: " . $conn->error]);
    exit;
  }

  // Execute the query
  if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(["message" => "Failed to execute query: " . $stmt->error]);
    exit;
  }

  // Fetch the result set
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $orders = [];
    while ($row = $result->fetch_assoc()) {
      $orders[] = [
        "orderId" => $row["Order_Id"],
        "amount" => $row["Amount"],
        "datePayed" => $row["Date_Payed"],
        "status" => $row["Status"],
        "paymentMethod" => $row["Method"],
        "mpesaNumber" => $row["mpesa_number"],
        "mpesaCode" => $row["mpesa_code"],
        "bankAccountNumber" => $row["Acc_no"],        
      ];
    }
    // Output the orders as a JSON array
    echo json_encode($orders);
  } else {
    // No orders found
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