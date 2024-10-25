<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Read and decode the raw JSON input data
  $inputData = json_decode(file_get_contents('php://input'), true);

  // Prepare the SQL query to fetch all orders with a status of "pending"
  $sql = "SELECT `Serv_id`, `Type`, `Date_Booked`, `Cust_Id`, `Description`,`Status`
          FROM `services`
          WHERE Status ='Awaiting approval'";
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
    $pending_services = [];
    while ($row = $result->fetch_assoc()) {
      $pending_services[] = [        
        "Serv_id" => $row["Serv_id"],
        "Type" => $row["Type"],
        "Date_Booked" => $row["Date_Booked"],
        "Cust_Id" => $row["Cust_Id"],
        "Description" => $row["Description"],

      ];
    }
    // Output the orders as a JSON array
    echo json_encode($pending_services);
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