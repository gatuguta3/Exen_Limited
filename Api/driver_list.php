<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Prepare the SQL query to fetch all drivers
$sql = "SELECT * FROM employee_details WHERE Emp_role ='Driver'";
$stmt = $conn->prepare($sql);

// Execute the query
if ($stmt->execute()) {
  $result = $stmt->get_result();
  $drivers = [];
  while ($row = $result->fetch_assoc()) {
    $drivers[] = [
      "Emp_Id" => $row["Emp_Id"],
      "Emp_Firstname" => $row["Emp_Firstname"],
    ];
  }
  echo json_encode($drivers);
} else {
  http_response_code(500);
  $error = $stmt->error;
  echo json_encode(["message" => "Failed to execute query: $error", "code" => 500]);
  exit;
}

// Close the database connection
mysqli_close($conn);
?>