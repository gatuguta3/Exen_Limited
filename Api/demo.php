<?php 
header("Access-Control-Allow-Origin: *");
include('Connect.php');

if(isset($_POST["email"])){
    $email=$_POST["email"];
    echo"$email";
  }
  else return;
  if(isset($_POST["password"])){
    $password=$_POST["password"];
  }
  else return;
  if(isset($_POST["firstname"])){
    $firstname=$_POST["firstname"];
  }
  else return;
  if(isset($_POST["lastname"])){
    $lastname=$_POST["lastname"];
  }
  else return;
  if(isset($_POST["idnumber"])){
    $idnumber=$_POST["idnumber"];
  }
  else return;
  if(isset($_POST["phone"])){
    $phone=$_POST["phone"];
  }
  else return;
  if(isset($_POST["location"])){
    $location=$_POST["location"];
  }
  else return;

  $sql="INSERT INTO `demo`(`Email`, `firstname`, `lastname`, `phonenumber`, 
        `location`, `idnumber`, `password`) 
        VALUES ('$email','$firstname','$lastname','$phone','$location','$idnumber','$password')";

$exe=$conn->query($sql);
$arr=[];
if($exe === true && $exe1===true)
{
  $arr["success"]=["true"];
 
}
else{
  $arr["success"]=["false"];
  
}
print(json_encode($arr));
