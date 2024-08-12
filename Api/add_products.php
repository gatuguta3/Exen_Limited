<?php
include 'Connect.php';
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

 $id=uniqid();
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $description = $_POST['description'];
    $colors = $_POST['colors'];
    $category = $_POST['category'];
    $buyingprice = $_POST['buyingprice'];
    $sellingprice = $_POST['sellingprice'];
    $quantity = $_POST['quantity'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    // Upload image
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_url = $target_file;
        } else {
            $image_url = '';
        }
    } else {
        $image_url = '';
    }

                /*
                    `Product_Id`, `Product_Name`, `Product_Description`
                    , `brand`, `Category`, `Initial_Cost`, `Product_Price`,
                    `Quantity`, `Available_Colors`, `Image`
                */

    // Insert product details into database
    $sql = "INSERT INTO products (`Product_Id`,`Product_Name`, `Product_Description`,
     `brand`,`Category`,`Initial_Cost`,`Product_Price`,`Quantity`, `Available_Colors`,`Image`)
      VALUES ('$id','$name','$description','$brand','$category','$buyingprice','$sellingprice','$quantity','$colors', '$image_url')";
    if ($conn->query($sql) === TRUE) {
        echo "Product created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close(); 