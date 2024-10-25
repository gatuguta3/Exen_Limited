<?php
include "Connect.php";
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    // Check if 'user_id' is present and not empty in the decoded JSON
    if (!isset($inputData['user_id']) || empty($inputData['user_id'])) {
      http_response_code(400);
      echo json_encode(["message" => "User  ID is required"]);
      exit;
    }
  
    // Cast and validate the user ID
    $userId = (string) $inputData['user_id'];
    if ($userId <= 0) {
      http_response_code(400);
      echo json_encode(["message" => "Invalid user ID"]);
      exit;
    }

  $sql = "SELECT `Emp_Id`, `Emp_Firstname`, `Emp_lastname`, `Emp_national_Id`,
                `Emp_Phonenumber`, `Email`, `Emp_role`, `Emp_dateofbirth`,
                `Emp_gender` 
          FROM  `employee_details`
          WHERE Emp_Id = ? ";

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

$result = $stmt->get_result();
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  // Output the employee details as a JSON object
  echo json_encode($row);
} else {
  // No employee found for the given user ID
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