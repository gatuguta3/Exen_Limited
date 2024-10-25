<?php
 include 'Connect.php';
 header("Access-Control-Allow-Origin: *");

 $query= "SELECT `Supply_Id`, `Name`, `Description`, `Quantity`,`Color`, `Price`, `metrics`, `Supplier_Id` FROM `supplies`";
 $exe=mysqli_query($conn,$query); 

 $supplies = array();
 while($row = mysqli_fetch_assoc($exe)){
   $supplies[]=$row;
 }

 echo json_encode($supplies);



mysqli_close($conn);