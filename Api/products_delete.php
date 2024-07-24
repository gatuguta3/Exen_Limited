<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if (!isset($_POST['Product_Id'])) {
    echo json_encode(["success" => "false", "message" => "Product_Id is missing"]);
    return;
}

$productId = intval($_POST['Product_Id']);

$query = "DELETE FROM products WHERE Product_Id = '$productId'";
$exe = mysqli_query($conn, $query);

$response = [];
if ($exe) {
    $response["success"] = "true";   
} else {
    $response["success"] = "false";
    $response["message"] = mysqli_error($conn);
}

echo json_encode($response);
