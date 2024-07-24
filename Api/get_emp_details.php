<?php
include "Connect.php";

$user_id = isset($_POST['user_id']) ? $conn->real_escape_string($_POST['user_id']) : '';

if (empty($user_id)) {
    echo json_encode(["error" => "User ID is required"]);
    exit();
}

// Create the SQL query
// `Emp_Id`, `Emp_Firstname`, `Emp_lastname`, `Emp_national_Id`,
// `Emp_Phonenumber`, `Email`, `Emp_role`, `Emp_dateofbirth`,
// `Emp_gender` FROM `employee_details` 
$sql = "SELECT 
        FROM  
        WHERE Emp_Id = '$user_id'";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch associative array
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["error" => "No employee found with the given user ID"]);
}

// Close connection
$conn->close();

