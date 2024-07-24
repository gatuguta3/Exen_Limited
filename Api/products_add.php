<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$id = uniqid();

// Check if all required POST parameters are set
$required_params = ['caption', 'brand', 'description', 'colors', 'category', 'price', 'sellingprice', 'quantity', 'data', 'name'];
foreach ($required_params as $param) {
    if (!isset($_POST[$param])) {
        echo json_encode(["success" => "false", "message" => "$param is missing"]);
        return;
    }
}

$cap = $_POST["caption"];
$brand = $_POST["brand"];
$description = $_POST["description"];
$colors = $_POST["colors"];
$category = $_POST["category"];
$price = $_POST["price"];
$sellingprice = $_POST["sellingprice"];
$quantity = $_POST["quantity"];
$data = $_POST["data"];
$name = $_POST["name"];

$path = "Products/$name";

// Ensure the file path directory exists
if (!file_exists('Products')) {
    mkdir('Products', 0777, true);
}

$query = "INSERT INTO products (Product_Id, Product_Name, Product_Description, brand, Category, Initial_Cost, Product_Price, Quantity, Available_Colors, image_path) 
          VALUES ('$id', '$cap', '$description', '$brand', '$category', '$price', '$sellingprice', '$quantity', '$colors', '$path')";
file_put_contents($path, base64_decode($data));

$arr = [];
$exe = mysqli_query($conn, $query);

if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
    $arr["message"] = mysqli_error($conn); // Print the SQL error
}

echo json_encode($arr);
