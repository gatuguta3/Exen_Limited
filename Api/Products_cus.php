<?php
include 'Connect.php';

$query = "SELECT Product_Id,Product_Name,Product_Description,brand,Category,
        Initial_Cost,Product_Price,Quantity,Available_Colors,image_path FROM products";

// Prepare and execute SQL query
$stmt = $conn->prepare($query);
$stmt->execute();
//`Product_Id`, `Product_Name`, `Product_Description`, `brand`, `Category`
//, `Initial_Cost`, `Product_Price`, `Quantity`, `Available_Colors`, `Image`, `image_path`

$stmt->bind_result($Product_Id, $Product_Name, $Product_Description, $brand, $Category,
                 $Initial_Cost, $Product_Price, $Quantity, $Available_Colors, $image_path);

$products = [];


while ($stmt->fetch()) {
    $product = [
        "Product_Id" => $Product_Id,
        "Product_Name" => $Product_Name,
        "Product_Description" => $Product_Description,
        "brand" => $brand,
        "Category" => $Category,
        "Initial_Cost" => $Initial_Cost,
        "Product_Price" => $Product_Price,
        "Quantity" => $Quantity,
        "Available_Colors" => $Available_Colors,
        "image_path" => $image_path,
        "image_data" => base64_encode(file_get_contents($image_path))
    ];
    $products[] = $product;
}

echo json_encode($products);