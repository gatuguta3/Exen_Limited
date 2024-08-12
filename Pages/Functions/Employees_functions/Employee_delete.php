<?php 

require_once __DIR__ . '/../../Pages/connect.php';

$id = $_GET["id"];
$sql = "DELETE FROM `employee_details` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}

?>