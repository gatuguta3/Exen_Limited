<?php 
require "connect.php";
$query = $_POST ['query'];
                                  //`Transaction_Id`, `Cust_Id`, `Trasaction_Type`, `Serv_Id`,
                                  // `Order_Id`, `Amount`, `Date_Payed`, `Date_Approved`, `Status`
                                  $sql="SELECT * FROM transactions WHERE Transaction_Id LIKE '%$query%'";
                                  $result = mysqli_query($conn,$sql);
                                  if($result->num_rows >0){ 
                                    while ( $row = mysqli_fetch_assoc($result)){
                                      ?>
                                      <tr>
                                      <td><?php echo $row["Transaction_Id"]?></td>
                                      <td><?php echo $row["Cust_Id"]?></td>
                                      <td><?php echo $row["Trasaction_Type"]?></td>
                                      <td><?php echo $row["Serv_Id"]?></td>
                                      <td><?php echo $row["Order_Id"]?></td>
                                      <td><?php echo $row["Amount"]?></td>
                                      <td><?php echo $row["Date_Payed"]?></td>
                                      <td><?php echo $row["Date_Approved"]?></td>
                                      <td><?php echo $row["Status"]?></td>
                                     <!-- 
                                      <td><//?php echo $row[""]?></td>
                                      <td><//?php echo $row[""]?></td>
                                      <td><//?php echo $row[""]?></td>
                                      <td><//?php echo $row[""]?></td>
                                      <td><//?php echo $row[""]?></td>
                                      <td><//?php echo $row[""]?></td>
                                      <td><//?php echo $row[""]?></td>
                                      <td><//?php echo $row[""]?></td>
                                      <td><//?php echo $row[""]?></td> 
                                     -->                                   
                                  
                                      </tr>
                                      <?php
                                  }

                                  }else{
                                    echo "<tr><td colspan='9'>No results found</td></tr>";
                                  }
                              
                                ?>   