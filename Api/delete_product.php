<?php
include 'Connect.php';
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
//header('Content-Type: application/json; charset=utf-8');
//header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$id = $_POST['Product_Id'];

// Delete query
$query = "DELETE FROM products WHERE Product_Id = '$id'";

// Execute query
if (mysqli_query($conn, $query)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);