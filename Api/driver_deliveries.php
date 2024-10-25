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
    $sql="SELECT `Delivery_Id`, `Delivery_Date`, `Order_Id` FROM `deliveries` WHERE Driver_Id ='$userId' AND `Status` = 'In Transit'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $deliveries = array();        
        while($row = $result->fetch_assoc()) {
            $deliveries[] = [
                "Delivery_Id" => $row["Delivery_Id"],
                "Delivery_Date" => $row ["Delivery_Date"],
                "Order_Id" => $row["Order_Id"],
            ];

        }
        echo json_encode($deliveries);
    } else {
        echo json_encode([]);
    }


} else {
    echo json_encode(["message" => "Invalid request method"]);
    http_response_code(405);
}

mysqli_close($conn);
