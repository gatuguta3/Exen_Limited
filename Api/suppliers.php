<?php
 include 'Connect.php';
 header("Access-Control-Allow-Origin: *");

 $query= "SELECT `Supplier_Id`, `S_Name`, `S_Type`, `S_Location`, `Phonenumber`, `email_address`, `S_start_date` FROM `suppliers`";
 $exe=mysqli_query($conn,$query); 

 $supplies = array();
 while($row = mysqli_fetch_assoc($exe)){
   $suppliers[]=$row;
 }

 echo json_encode($suppliers);



mysqli_close($conn);