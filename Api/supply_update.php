<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if (!isset($_POST['Supply_Id']) || !isset($_POST['Name']) || !isset($_POST['Description']) || !isset($_POST['metrics']) || !isset($_POST['Price']) 
    || !isset($_POST['Quantity']) || !isset($_POST['Color']) || !isset($_POST['Supplier_Id'])) {
    echo json_encode(["success" => "false", "message" => "Missing parameters"]);
    return;
}

$supplyId = mysqli_real_escape_string($conn, $_POST['Supply_Id']);
$Name = mysqli_real_escape_string($conn, $_POST['Name']);
$Description = mysqli_real_escape_string($conn, $_POST['Description']);
$metrics = mysqli_real_escape_string($conn, $_POST['metrics']);
$Price = mysqli_real_escape_string($conn, $_POST['Price']);
$Quantity = mysqli_real_escape_string($conn, $_POST['Quantity']);
$supplierid = mysqli_real_escape_string($conn, $_POST['Supplier_Id']);
$Color = mysqli_real_escape_string($conn, $_POST['Color']);

$query = "UPDATE `supplies` SET `Name`= '$Name',`Description`='$Description',`Color`='$Color',
        `Quantity`='$Quantity',`Price`='$Price',`metrics`='$metrics',`Supplier_Id`='$supplierid' WHERE `Supply_Id`='$supplyId'";
$exe = mysqli_query($conn, $query);

$response = [];
if ($exe) {
    $response["success"] = "true";
    $response["message"] = "supply updated successfully";
} else {
    $response["success"] = "false";
    $response["message"] = mysqli_error($conn);
}

echo json_encode($response);

?>
