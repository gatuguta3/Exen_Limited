<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

include "connect2.php";

$email=$_GET['email'];
$password=$_GET['password'];

$sql="SELECT * FROM 'users' WHERE Email= :email";
$sql .= "AND Password= :password ";
$stmt= $conn->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":password", $password);
$stmt->execute();
$returnValue = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($returnValue);

  