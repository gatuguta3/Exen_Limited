<?php
header("Access-Control-Allow-Origin: *");
//`Cust_Id`, `Cust_Firstname`,
 //`Cust_Lastname`,
 //`Cust_Phonenumber`,
  //`Cust_Location`,
   //`Email`,
  //`Cust_Dateofbirth`, `Cust_Gender`, `Cust_National_Idno`
 
include('Connect.php');

$id=uniqid();
$role="Customer";
$default_status="Approved";

if(isset($_POST["email"])){
  $email=$_POST["email"];

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
echo"$email";


    $sql="INSERT INTO `users`(`ID`, `Email`, `Password`, `User_Role`, `Account_status`) 
          VALUES ( '$id','$email','$password','$role','$default_status')";
    $exe=$conn->query($sql);

    $sql1="INSERT INTO `customer_details`(`Cust_Id`, `Cust_Firstname`, `Cust_Lastname`,
           `Cust_Phonenumber`, `Cust_Location`, `Email,`Cust_National_Idno`)
           VALUES ('$id','$firstname','$lastname','$phone','$location','$email','$idnumber')";
    $exe1=$conn->query($sql1);
    
   

    $arr=[];
    if($exe === true && $exe1 === true)
    {
      $arr["success"]=["true"];
     
    }
    else{
      $arr["success"]=["false"];
      
    }

    if($exe1 === true)
    {
      $arr["success"]=["true"];
     
    }
    else{
      $arr["success"]=["false"];
      
    }
    print(json_encode($arr));
    


                                        
                                       