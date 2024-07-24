<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

include "Connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
        echo json_encode(["message" => "User ID is required"]);
        http_response_code(400);
        exit;
    }

    $userId = mysqli_real_escape_string($conn, $_GET['user_id']);

    $sql = "SELECT Serv_id, Type, Date_Booked, Cust_Id,
             Description, Description_Image, Status 
            FROM services 
            WHERE Cust_Id = '$userId'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $services = [];
        while($row = $result->fetch_assoc()) {
            $services[] = [
                'Serv_id' => $row['Serv_id'],
                'Type' => $row['Type'],
                'Date_Booked' => $row['Date_Booked'],
                'Cust_Id' => $row['Cust_Id'],
                'Description' => $row['Description'],
                'Description_Image' => base64_encode($row['Description_Image']),
                'Status' => $row['Status']
            ];
        }
        echo json_encode($services);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(["message" => "Invalid request method"]);
    http_response_code(405);
}

mysqli_close($conn);

