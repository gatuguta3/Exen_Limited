<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$required_params = ['Serv_id', 'Supply_Id', 'Name', 'Description', 'Price', 'Quantity', 'metrics', 'Type'];
foreach ($required_params as $param) {
    if (!isset($_POST[$param])) {
        $arr["success"] = "false";
        $arr["message"] = "$param is missing";
        echo json_encode($arr);
        return;
    }
}

$Name = $_POST["Name"];
$description = $_POST["Description"];
$price = $_POST["Price"];
$incomingQuantity = $_POST["Quantity"];
$metrics = $_POST["metrics"];
$Type = $_POST["Type"];
$servid = $_POST["Serv_id"];
$supplyid = $_POST["Supply_Id"];

$query = "SELECT `Quantity` FROM `supplies` WHERE `Supply_Id`='$supplyid'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $currentQuantity = $row['Quantity'];
    
    if ($currentQuantity >= $incomingQuantity) {
        // Step 3: Calculate the new quantity
        $newQuantity = $currentQuantity - $incomingQuantity;

        // Step 4: Update the existing quantity in the database
        $updateQuery = "UPDATE `supplies` SET `Quantity`='$newQuantity' WHERE `Supply_Id`='$supplyid'";
        mysqli_query($conn, $updateQuery);

        // Step 5: Insert the new record
        $insertQuery = "INSERT INTO `services_used_supplies`(`Serv_id`, `Supply_Id`, `Name`, `Description`, `metrics`, `Price`, `Quantity`, `Type`)
                        VALUES ('$servid', '$supplyid', '$Name', '$description', '$metrics', '$price', '$incomingQuantity', '$Type')";
        
        if (mysqli_query($conn, $insertQuery)) {
            $arr["success"] = "true";
        } else {
            $arr["success"] = "false";
            $arr["message"] = mysqli_error($conn);
        }
    } else {
        $arr["success"] = "false";
        $arr["message"] = "Not enough quantity available to deduct.";
    }
} else {
    $arr["success"] = "false";
    $arr["message"] = mysqli_error($conn); // Print the SQL error
}

echo json_encode($arr);
mysqli_close($conn);
?>