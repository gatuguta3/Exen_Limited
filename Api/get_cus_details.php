<?php
include "Connect.php";

$user_id = isset($_POST['user_id']) ? $conn->real_escape_string($_POST['user_id']) : '';

if (empty($user_id)) {
    echo json_encode(["error" => "User ID is required"]);
    exit();
}

// Create the SQL query
$sql = "SELECT Cust_Id, Cust_Firstname, Cust_Lastname, Cust_Phonenumber, Cust_Location, Email, Cust_Dateofbirth, Cust_Gender, Cust_National_Idno 
        FROM `customer_details` 
        WHERE Cust_Id = '$user_id'";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch associative array
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["error" => "No customer found with the given user ID"]);
}

// Close connection
$conn->close();

