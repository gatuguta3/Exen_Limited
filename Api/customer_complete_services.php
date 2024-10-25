<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read and decode the raw JSON input data
    $inputData = json_decode(file_get_contents('php://input'), true);

    // Check if input data is valid
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["message" => "Invalid JSON input"]);
        http_response_code(400);
        exit;
    }

    // Validate user ID from the JSON payload
    if (!isset($inputData['user_id']) || empty($inputData['user_id'])) {
        echo json_encode(["message" => "User  ID is required"]);
        http_response_code(400);
        exit;
    }

    $userId = mysqli_real_escape_string($conn, $inputData['user_id']);

    // Prepare the SQL query to fetch all services with a specific status
    $sql = "
    SELECT `Serv_id`, `Type`, `Date_Booked`, `Date_Completed`, `Start_Date`, `Service_fee`, `Supplies_Cost`
    FROM `services` WHERE `Cust_Id`=? AND `Status`='Service complete'
    ";

    $stmt = $conn->prepare($sql);

    // Check if the SQL statement was prepared successfully
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(["message" => "Failed to prepare the SQL statement: " . $conn->error]);
        exit;
    }

    // Bind parameters
    $stmt->bind_param("s", $userId);

    // Execute the query
    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(["message" => "Failed to execute query: " . $stmt->error]);
        exit;
    }

    // Fetch the result set
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $complete_services = [];
        while ($row = $result->fetch_assoc()) {
            $complete_services[] = [        
                "Serv_id" => $row["Serv_id"],
                "Type" => $row["Type"],
                "Date_Booked" => $row["Date_Booked"],
                "Date_Completed" => $row["Date_Completed"],
                "Service_fee" => $row["Service_fee"],        
                "Supplies_Cost" => $row["Supplies_Cost"],
                "Start_Date" => $row["Start_Date"],        
            ];
        }
        // Output the services as a JSON array
        echo json_encode($complete_services);
    } else {
        // No services found
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