<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Prepare the SQL query to fetch all drivers
$sql = "SELECT * FROM supplies ";
$stmt = $conn->prepare($sql);

// Execute the query
if ($stmt->execute()) {
  $result = $stmt->get_result();
  $supplies = [];
  while ($row = $result->fetch_assoc()) {
    $supplies[] = [
      "Supply_Id" => $row["Supply_Id"],
      "Name" => $row["Name"],
      "Description" => $row["Description"],
      "Price" => $row["Price"],
      "Quantity" => $row["Quantity"],
      "Color" => $row["Color"],
      "Type" => $row["Type"],
      "metrics" => $row["metrics"],
      //"image"=> base64_encode(file_get_contents($row["image_path"]))
    ];
  }
  echo json_encode($supplies);
} else {
  http_response_code(500);
  $error = $stmt->error;
  echo json_encode(["message" => "Failed to execute query: $error", "code" => 500]);
  exit;
}

// Close the database connection
mysqli_close($conn);
?>