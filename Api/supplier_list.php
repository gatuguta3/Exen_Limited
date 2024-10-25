<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Prepare the SQL query to fetch all drivers
$sql = "SELECT * FROM Suppliers ";
$stmt = $conn->prepare($sql);

// Execute the query
if ($stmt->execute()) {
  $result = $stmt->get_result();
  $supplier = [];
  while ($row = $result->fetch_assoc()) {
    $supplier[] = [
      "Supplier_Id" => $row["Supplier_Id"],
      "S_Name" => $row["S_Name"],
    ];
  }
  echo json_encode($supplier);
} else {
  http_response_code(500);
  $error = $stmt->error;
  echo json_encode(["message" => "Failed to execute query: $error", "code" => 500]);
  exit;
}

// Close the database connection
mysqli_close($conn);
?>