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
        $id = $row['ID'];
        //echo json_encode(array('User_Role' => $role)); 
        //echo json_encode(array('ID' => $id));
        $response = array(
           'User_Role' => $role,
            'User_Id' => $id
        );
        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'Invalid email or password'));
    }
}

$conn->close();



  