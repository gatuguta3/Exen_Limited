<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

include "Connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT User_Role,ID FROM users WHERE Email = '$email' AND  Password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $role = $row['User_Role'];

        echo json_encode(array('User_Role' => $role));
    } else {
        echo json_encode(array('error' => 'Invalid email or password'));
    }
}

$conn->close();



  