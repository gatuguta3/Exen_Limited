<?php 
require "connect.php";
$query = $_POST ['query'];
                                  //`Serv_id`, `Type`, `Date_Booked`,
                                  // `Date_Completed`, `Cust_Id`, `Description`,
                                  // `Description_Image`, `Status`, `Emp_Id`, `Start_Date`
                                  
                                  $sql="SELECT * FROM services WHERE Serv_Id LIKE '%$query%'";
                                  $result= mysqli_query($conn,$sql);
                                  if($result ->num_rows >0){
                                    while( $row = mysqli_fetch_assoc($result)){
                                      ?>
                                      <tr>
                                        <td><?php echo $row["Serv_id"] ?></td>
                                        <td><?php echo $row["Type"] ?></td>
                                        <td><?php echo $row["Date_Booked"] ?></td>
                                        <td><?php echo $row["Date_Completed"] ?></td>
                                        <td><?php echo $row["Cust_Id"] ?></td>
                                        <td><?php echo $row["Description"] ?></td>
                                        <td><?php echo $row["Description_Image"] ?></td>
                                        <td><?php echo $row["Status"] ?></td>
                                        <td><?php echo $row["Emp_Id"] ?></td>
                                        <td><?php echo $row["Start_Date"] ?></td>
                                      </tr>
                                      <?php
                                    }

                                  }else{
                                    echo "<tr><td colspan='10'>No results found</td></tr>";
                                  }
                                ?>                 