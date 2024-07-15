<?php
 include 'Connect.php';

 $query= "SELECT Product_Id, Product_Name, Product_Description, brand, Category, Initial_Cost, Product_Price, Quantity, Available_Colors FROM products";
 $exe=mysqli_query($conn,$query); 

 $arr=[];

 while($row=mysqli_fetch_array($exe)){
    $arr[]=$row;
 }
 echo json_encode($arr);