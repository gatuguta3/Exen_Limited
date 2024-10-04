<?php 
include "Connect.php";

$user_id = $_POST['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$location = $_POST['location'];
$phone_number = $_POST['phone_number'];
$national_id_number = $_POST['national_id_number'];


$sql = "UPDATE customer_details SET Cust_Firstname = '$first_name', 
        Cust_Lastname = '$last_name', Cust_Location = '$location', 
        Cust_Phonenumber = '$phone_number', Cust_National_Idno = '$national_id_number'
         WHERE Cust_Id = '$user_id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'error' => $conn->error));
}

$conn->close();