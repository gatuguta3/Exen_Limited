<?php 
require "connect.php";
$query = $_POST ['query'];
                                $sql="SELECT * FROM deliveries WHERE Delivery_Id LIKE '%$query%'";
                                $result = mysqli_query($conn,$sql);
                                if($result -> num_rows >0){
                                  while( $row = mysqli_fetch_assoc($result)){
                                    ?>
                                      <tr>
                                        <td><?php echo $row["Delivery_Id"] ?></td>
                                        <td><?php echo $row["Emp_Id"] ?></td>
                                        <td><?php echo $row["Delivery_Date"] ?></td>
                                        <td><?php echo $row["Delivery_Cost"] ?></td>
                                        <td><?php echo $row["Order_Id"] ?></td>
                                        <td><?php echo $row["Vehicle_Id"] ?></td>
                                        <td><?php echo $row["Delivery_Location"] ?></td>
                                        <td><?php echo $row["Cust_Id"] ?></td>
                                        <td><?php echo $row["Status"] ?></td>
                                      </tr>

                                    <?Php
                                  }

                                }else{
                                  echo "<tr><td colspan='9'>No results found</td></tr>";
                                }
                              ?> 