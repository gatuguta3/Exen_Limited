<?php
 include 'Connect.php';
 header("Access-Control-Allow-Origin: *");

 $query= "SELECT Product_Id, Product_Name, Product_Description, brand, Category, Initial_Cost, Product_Price, Quantity, Available_Colors FROM products";
 $exe=mysqli_query($conn,$query); 

 $data = array();
 while($row = mysqli_fetch_assoc($exe)){
   $data[]=$row;
 }

 echo json_encode($data);



mysqli_close($conn);