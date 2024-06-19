<?php 
require 'connect.php';
$query = $_POST ['query'];
    $sql= "SELECT * FROM supplies WHERE Name LIKE '%$query%' ";
    $result = mysqli_query($conn,$sql);
    if($result->num_rows >0){
        while ( $row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
             <td><?php $img_data = base64_encode($row["Image"]);
                        $img_src = "data:image/jpeg;base64," . $img_data;
                        echo" <img src='$img_src' style='width:30px;height:30px;border:2px solid gray;border-radius:8px;object-fit:cover'>"; ?></td>
              <td><?php echo $row["Supply_Id"]?></td>
              <td><?php echo $row["Name"] ?></td>
              <td><?php echo $row["Description"] ?></td>
              <td><?php echo $row["Quantity"]?></td>
              <td><?php echo $row["Price"];?></td>
              <td><?php echo $row["Supplier_Id"]?></td>            
             
            </tr>
            <?php
            }

    }else{
        echo "<tr><td colspan='7'>No results found</td></tr>"; 
    }
?>