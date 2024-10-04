<?php
include "Connect.php";

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
        http_response_code(400);
        echo json_encode(["message" => "User  ID is required"]);
        exit;
    }

    $userId = $_POST['user_id'];

    $sql = "SELECT `Order_Id`, `Amount`, `Date_Payed`,`Status` FROM `orders` WHERE `Cust_Id` = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $orders = [];
        while($row = $result->fetch_assoc()){
            $orders[] = [
                "orderId" => $row["Order_Id"],
                "amount" => $row["Amount"],
                "datePayed" => $row["Date_Payed"],
                "status" => $row["Status"],
              ];
        }
        echo json_encode($orders);
    } else {
        echo json_encode([]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Invalid request method"]);
}

mysqli_close($conn);