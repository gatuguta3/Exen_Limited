<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if (!isset($_POST['Product_Id'])) {
    echo json_encode(["success" => "false", "message" => "Missing parameter"]);
    return;
}

$ProductId = mysqli_real_escape_string($conn, $_POST['Product_Id']);


$query = "DELETE FROM `products` WHERE `Product_Id`='$ProductId'";
$exe = mysqli_query($conn, $query);

$response = [];
if ($exe) {
    $response["success"] = "true";
    $response["message"] = "supply Deleted successfully";
} else {
    $response["success"] = "false";
    $response["message"] = mysqli_error($conn);
}

echo json_encode($response);

?>
