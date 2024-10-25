<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Read and decode the raw JSON input data
  $inputData = json_decode(file_get_contents('php://input'), true);

  // Check if 'user_id' is present and not empty in the decoded JSON
  if (!isset($inputData['user_id']) || empty($inputData['user_id'])) {
    http_response_code(400);
    echo json_encode(["message" => "User ID is required"]);
    exit;
  }

  // Cast and validate the user ID
  $userId = (int) $inputData['user_id'];
  if ($userId <= 0) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid user ID"]);
    exit;
  }

  // Prepare the SQL query to fetch orders for the specified user ID
  $sql = "SELECT Order_Id, Amount, Date_Payed, Status FROM orders WHERE Cust_Id = ?";
  $stmt = $conn->prepare($sql);

  // Check if the SQL statement was prepared successfully
  if ($stmt === false) {
    http_response_code(500);
    echo json_encode(["message" => "Failed to prepare the SQL statement: " . $conn->error]);
    exit;
  }

  // Bind the user ID parameter and execute the query
  $stmt->bind_param("i", $userId);
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
      ];
    }
    // Output the orders as a JSON array
    echo json_encode($orders);
  } else {
    // No orders found for the given user ID
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
