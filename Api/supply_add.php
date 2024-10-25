<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$id = rand(1000, 9999);

// Check if all required POST parameters are set
//INSERT INTO `services_used_supplies`(`Serv_id`, `Supply_Id`, `Name`, `Description`, `metrics`, `Price`, `Quantity`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')
$required_params = ['Name', 'description', 'color', 'price', 'quantity','supplier','metrics','Type', 'data', 'name'];
foreach ($required_params as $param) {
    if (!isset($_POST[$param])) {
        $arr["success"] = "false";
        $arr["message"] = "$param is missing";
        echo json_encode($arr);
        return;
    }
}

$Name = $_POST["Name"];
$description = $_POST["description"];
$color = $_POST["color"];
$price = $_POST["price"];
$quantity = $_POST["quantity"];
$supplier = $_POST["supplier"];
$metrics = $_POST["metrics"];
$Type = $_POST["Type"];
$data = $_POST["data"];
$name = $_POST["name"];

$path = "Supplies/$name";

// Ensure the file path directory exists
if (!file_exists('Supplies')) {
    mkdir('Supplies', 0777, true);
}

$query = "INSERT INTO `supplies`(`Supply_Id`, `Name`, `Description`, `Color`, `Quantity`, `Price`, `metrics`,`Type`, `Supplier_Id`, `image_path`)
           VALUES ('$id','$Name','$description','$color','$quantity','$price','$metrics','$Type','$supplier','$path')";
           file_put_contents($path, base64_decode($data));

try {
    $exe = mysqli_query($conn, $query);
    if ($exe) {
        $arr["success"] = "true";
    } else {
        $arr["success"] = "false";
        $arr["message"] = mysqli_error($conn); // Print the SQL error
    }
} catch (Exception $e) {
    $arr["success"] = "false";
    $arr["message"] = $e->getMessage();
}

echo json_encode($arr);

?>