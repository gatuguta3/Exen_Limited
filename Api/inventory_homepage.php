<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Prepare the SQL queries
$sql = "SELECT COUNT(*) AS product_count FROM products";
$sql1 = "SELECT COUNT(*) AS supply_count FROM supplies";
$sql2 = "SELECT COUNT(*) AS supplier_count FROM suppliers";
$sql3="SELECT SUM(`Quantity` * `Product_Price`) AS Total_Products_Value FROM `products`";
$sql4="SELECT SUM(`Quantity` * `Price`) AS Total_Supplies_Value FROM `supplies`";

// Initialize the $analysis array
$analysis = [];

// Execute the first query
$stmt = $conn->prepare($sql);
if ($stmt->execute()) {
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $analysis[] = [
    "product_count"=>$row["product_count"],
  ];
} else {
  http_response_code(500);
  $error = $stmt->error;
  echo json_encode(["message" => "Failed to execute query: $error", "code" => 500]);
  exit;
}

// Execute the second query
$stmt = $conn->prepare($sql1);
if ($stmt->execute()) {
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $analysis[] = [
    "Supply_count"=>$row["supply_count"],
  ];
} else {
  http_response_code(500);
  $error = $stmt->error;
  echo json_encode(["message" => "Failed to execute query: $error", "code" => 500]);
  exit;
}

// Execute the third query
$stmt = $conn->prepare($sql2);
if ($stmt->execute()) {
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $analysis[] = [
    "Supplier_count"=>$row["supplier_count"],
  ];
} else {
  http_response_code(500);
  $error = $stmt->error;
  echo json_encode(["message" => "Failed to execute query: $error", "code" => 500]);
  exit;
}

$stmt = $conn->prepare($sql3);
if ($stmt->execute()) {
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $analysis[] = [
    "Total_Products_Value"=>$row["Total_Products_Value"],
  ];
} else {
  http_response_code(500);
  $error = $stmt->error;
  echo json_encode(["message" => "Failed to execute query: $error", "code" => 500]);
  exit;
}


$stmt = $conn->prepare($sql4);
if ($stmt->execute()) {
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $analysis[] = [
    "Total_Supplies_Value"=>$row["Total_Supplies_Value"],
  ];
} else {
  http_response_code(500);
  $error = $stmt->error;
  echo json_encode(["message" => "Failed to execute query: $error", "code" => 500]);
  exit;
}
// Echo the $analysis array as JSON
echo json_encode($analysis);

// Close the database connection
mysqli_close($conn);
?>