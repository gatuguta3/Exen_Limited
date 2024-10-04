<?php 
include "Connect.php";

$user_id = $_POST['user_id'];
$new_password = $_POST['new_password'];

$sql = "UPDATE users SET Password = '$new_password' WHERE ID = '$user_id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'error' => $conn->error));
}

$conn->close();
