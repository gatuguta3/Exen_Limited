<?php
    require 'connect.php';
    $query = $_POST ['query'];
    $sql= "SELECT * FROM suppliers WHERE Name LIKE '%$query%' ";
    $result = mysqli_query($conn,$sql);
    if($result->num_rows >0){
        while ( $row6 = mysqli_fetch_assoc($result)){
            ?>
            <tr>
              <td><?php echo $row6["Supplier_Id"]?></td>
              <td><?php echo $row6["Name"] ?></td>
              <td><?php echo $row6["Type"] ?></td>
              <td><?php echo $row6["Location"]?></td>
              <td><?php echo $row6["Phonenumber"];?></td>
              <td><?php echo $row6["email_address"]?></td>
              <td><?php echo $row6["start_date"]?></td>
              <td>                                               
                  <a class="link-dark" href="Suppliers_edit.php?id=<?php echo $row6 ["Supplier_Id"]?>"><i class="bi bi-pencil"> Edit</i></a>                                                 
              </td>
            </tr>
            <?php
            }                  

    }else{
        echo "<tr><td colspan='7'>No results found</td></tr>";
    }
?>