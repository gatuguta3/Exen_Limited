<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if (!isset($_POST['Supply_Id'])) {
    echo json_encode(["success" => "false", "message" => "Missing parameter"]);
    return;
}

$supplyId = mysqli_real_escape_string($conn, $_POST['Supply_Id']);


$query = "DELETE FROM `supplies` WHERE `Supply_Id`='$supplyId'";
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
