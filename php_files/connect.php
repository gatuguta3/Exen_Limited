<?php



$host="Localhost";
$pass="";
$user="root";
$db="exen_limited";

$conn=mysqli_connect($host,$user,$pass,$db);

if($conn-> connect_error){
    echo "connection failed" .$conn-> connect_error;
}






