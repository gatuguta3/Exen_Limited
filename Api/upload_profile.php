<?php
include "Connect.php";

if (isset($_FILES['image']) && isset($_POST['user_id']) && isset($_POST['imagename'])) {
    $user_id = $_POST['user_id'];
    $imageData = $_FILES['image'];
    $imageName = $_POST['imagename'];

    // Validate user input
    if (empty($user_id) || !is_numeric($user_id)) {
        echo json_encode(["error" => "User ID must be a numeric value"]);
        exit();
    }

    // Validate image data
    if (empty($imageData) || !is_uploaded_file($imageData['tmp_name'])) {
        echo json_encode(["Invalid image data"]);
        exit();
    }

    // Move the uploaded file to a new location
    $imagePath = 'Profile_Pics/' . $imageName;
    if (!move_uploaded_file($imageData['tmp_name'], $imagePath)) {
        echo json_encode(["error" => "Failed to upload image"]);
        exit();
    }

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO customer_details (Cust_Id, profile_url) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $imagePath);
    if (!$stmt->execute()) {
        echo json_encode(["error" => "Failed to insert into database: " . $conn->error]);
        exit();
    }
    echo json_encode(["uploaded"]);
} else {
    echo json_encode(["Invalid request"]);
    exit();
}

$conn->close();
?>