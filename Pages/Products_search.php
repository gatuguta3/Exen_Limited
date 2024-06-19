<?php 
require 'connect.php';
$query = $_POST ['query'];
    $sql= "SELECT * FROM products WHERE Product_Name LIKE '%$query%' ";
    $result = mysqli_query($conn,$sql);
    if($result->num_rows >0){
        while ( $row2 = mysqli_fetch_assoc($result)){
            ?>
            <tr>
              <td><?php $img_data = base64_encode($row2["Image"]);
                        $img_src = "data:image/jpeg;base64," . $img_data;
                        echo" <img src='$img_src' style='width:30px;height:30px;border:2px solid gray;border-radius:8px;object-fit:cover'>";?></td>
              <td><?php echo $row2["Product_Id"] ?></td>
              <td><?php echo $row2["Product_Name"] ?></td>
              <td><?php echo $row2["Product_Description"]?></td>
              <td><?php echo $row2["Initial_Cost"]  ?></td>
              <td><?php echo $row2["Product_Price"]?></td>
              <td><?php echo $row2["Quantity"]?></td>
              <td><?php echo $row2["Available_Colors"]?></td>
            </tr>
            <?php
        }

    }else{
        echo "<tr><td colspan='8'>No results found</td></tr>";   
    }
?>

