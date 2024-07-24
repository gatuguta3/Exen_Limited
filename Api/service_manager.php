<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

include "Connect.php";


   
$sql = "SELECT Serv_id, Type, Date_Booked, Cust_Id, Description, Description_Image, Status FROM services";
$result = $conn->query($sql);

if ($result === FALSE) {
    die(json_encode(["error" => "Error in SQL query: " . $conn->error]));
}

if ($result->num_rows > 0) {
    $services = [];
    while ($row = $result->fetch_assoc()) {
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

mysqli_close($conn);