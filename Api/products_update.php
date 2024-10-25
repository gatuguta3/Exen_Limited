<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if (!isset($_POST['Product_Id']) || !isset($_POST['Product_Name']) || !isset($_POST['Product_Description']) || !isset($_POST['brand']) || !isset($_POST['Category']) || !isset($_POST['Initial_Cost']) || !isset($_POST['Product_Price']) || !isset($_POST['Quantity']) || !isset($_POST['Available_Colors'])) {
    echo json_encode(["success" => "false", "message" => "Missing parameters"]);
    return;
}

$productId = mysqli_real_escape_string($conn, $_POST['Product_Id']);
$productName = mysqli_real_escape_string($conn, $_POST['Product_Name']);
$productDescription = mysqli_real_escape_string($conn, $_POST['Product_Description']);
$brand = mysqli_real_escape_string($conn, $_POST['brand']);
$category = mysqli_real_escape_string($conn, $_POST['Category']);
$initialCost = mysqli_real_escape_string($conn, $_POST['Initial_Cost']);
$productPrice = mysqli_real_escape_string($conn, $_POST['Product_Price']);
$quantity = mysqli_real_escape_string($conn, $_POST['Quantity']);
$availableColors = mysqli_real_escape_string($conn, $_POST['Available_Colors']);

$query = "UPDATE products SET Product_Name='$productName', Product_Description='$productDescription', brand='$brand',
 Category='$category', Initial_Cost='$initialCost', Product_Price='$productPrice', Quantity='$quantity',
  Available_Colors='$availableColors' WHERE Product_Id='$productId'";
$exe = mysqli_query($conn, $query);

$response = [];
if ($exe) {
    $response["success"] = "true";
    $response["message"] = "Product updated successfully";
} else {
    $response["success"] = "false";
    $response["message"] = mysqli_error($conn);
}

echo json_encode($response);

?>
