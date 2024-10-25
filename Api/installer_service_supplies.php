<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Check if all required POST parameters are set
$required_params = ['Serv_id'];
foreach ($required_params as $param) {
    if (!isset($_POST[$param])) {
        $arr["success"] = "false";
        $arr["message"] = "$param is missing";
        echo json_encode($arr);
        return;
    }
}

$servid = mysqli_real_escape_string($conn, $_POST["Serv_id"]); // Prevent SQL injection

$query = "SELECT `Serv_id`, `Supply_Id`, `Name`, `Description`, `metrics`, `Price`, `Quantity`, `Type` FROM `services_used_supplies` WHERE `Serv_id`='$servid'";
$exe = mysqli_query($conn, $query);

$supplies = array();
while ($row = mysqli_fetch_assoc($exe)) {
    $supplies[] = $row;
}

echo json_encode($supplies);

mysqli_close($conn);