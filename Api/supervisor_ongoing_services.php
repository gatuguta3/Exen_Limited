<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Read and decode the raw JSON input data
  $inputData = json_decode(file_get_contents('php://input'), true);

  // Prepare the SQL query to fetch all orders with a status of "pending"
  $sql = "
    SELECT 
        s.Serv_id, 
        s.Type, 
        s.Date_Booked, 
        s.Cust_Id, 
        s.Description, 
        s.Status, 
        s.Installer_Id, 
        s.Start_Date,
        SUM(sus.Price * sus.Quantity) AS Total_Amount
    FROM 
        services s
    LEFT JOIN 
        services_used_supplies sus ON s.Serv_id = sus.Serv_id AND sus.Type = 'Non-Returnable'
    WHERE 
        s.Status = 'Started' AND (s.Type = 'Installation' OR s.Type = 'Repair')
    GROUP BY 
        s.Serv_id
    LIMIT 0, 25;
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
    $ongoing_services = [];
    while ($row = $result->fetch_assoc()) {
      $ongoing_services[] = [        
        "Serv_id" => $row["Serv_id"],
        "Type" => $row["Type"],
        "Date_Booked" => $row["Date_Booked"],
        "Cust_Id" => $row["Cust_Id"],
        "Description" => $row["Description"],        
        "Installer_Id" => $row["Installer_Id"],
        "Start_Date" => $row["Start_Date"],
        "Total_Amount" => $row["Total_Amount"] ? floatval($row["Total_Amount"]) : 0.0 // Ensure Total_Amount is a float
      ];
    }
    // Output the orders as a JSON array
    echo json_encode($ongoing_services);
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