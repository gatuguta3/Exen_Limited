<?php
include('Connect.php');

$id = uniqid();
$role = "Customer";
$default_status = "Approved";

// Check if all required POST variables are set
if (!isset($_POST["email"]) ||!isset($_POST["password"]) ||!isset($_POST["firstname"]) ||!isset($_POST["lastname"]) ||!isset($_POST["idnumber"]) ||!isset($_POST["phone"]) ||!isset($_POST["location"])) {
    return;
}

$email = $_POST["email"];
$password = $_POST["password"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$idnumber = $_POST["idnumber"];
$phone = $_POST["phone"];
$location = $_POST["location"];






// Insert into customer_details table
$sql1 = "INSERT INTO `customer_details`(`Cust_Id`, `Cust_Firstname`, `Cust_Lastname`, 
           `Cust_Phonenumber`, `Cust_Location`, `Email`, `Cust_National_Idno`)
           VALUES ('$id','$firstname','$lastname','$phone','$location','$email','$idnumber')";


$query = "SELECT * FROM users WHERE Email = '$email'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
  echo json_encode(array('success' => false, 'message' => 'Email already exists'));
  exit;
}
$err= mysqli_query($conn, $sql1);
// Create new user
$query = "INSERT INTO `users`(`ID`, `Email`, `Password`, `User_Role`, `Account_status`) 
        VALUES ( '$id','$email','$password','$role','$default_status')";
if (mysqli_query($conn, $query) ) {
  echo json_encode(array('success' => true));
} else {
  echo json_encode(array('success' => false, 'message' => 'Error creating user'));
}

// Close connection
mysqli_close($conn);







