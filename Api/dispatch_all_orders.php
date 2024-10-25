<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Read and decode the raw JSON input data
  $inputData = json_decode(file_get_contents('php://input'), true);

  // Prepare the SQL query to fetch all orders with a status of "pending"
  $sql = "SELECT o.Order_Id, o.Amount, o.Date_Payed, o.Cust_Id, o.service_Id, o.Project_Id,
                 o.Status, dl.Id, dl.Receiver_name, dl.phone_no, dl.county, dl.town, dl.Nearest_landmark,
                 po.Product_Id, po.Product_name, po.Price, po.Quantity FROM orders o INNER JOIN `delivery locations` dl ON 
                 o.Order_Id = dl.Order_id INNER JOIN products_ordered po ON o.Order_Id = po.Order_id WHERE o.Status = 'pending';
";
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
        "paymentMethod" => $row["mpesa_number"] ? "M-Pesa" : ($row["Acc_no"] ? "Bank" : "Unknown"),
        "mpesaNumber" => $row["mpesa_number"],
        "mpesaCode" => $row["mpesa_code"],
        "bankAccountNumber" => $row["Acc_no"],
        "bankTransactionId" => $row["transaction_id"],
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