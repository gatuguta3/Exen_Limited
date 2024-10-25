<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if (!isset($_POST['Serv_id']) || !isset($_POST['Status'])) {
    echo json_encode(["success" => "false", "message" => "Missing parameters"]);
    return;
}

$Servid = mysqli_real_escape_string($conn, $_POST['Serv_id']);
$Status = mysqli_real_escape_string($conn, $_POST['Status']);


$query = "UPDATE `services` SET `Status`= '$Status' WHERE `Serv_id`='$Servid'";
$exe = mysqli_query($conn, $query);

$response = [];
if ($exe) {
    $response["success"] = "true";
    $response["message"] = "service updated successfully";
} else {
    $response["success"] = "false";
    $response["message"] = mysqli_error($conn);
}

echo json_encode($response);

?>
