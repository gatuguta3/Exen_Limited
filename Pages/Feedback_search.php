<?php 
                                // `Feedback_Id`, `Cust_Id`,
                                // `Time_Sent`, `Date_Sent`, `Description`
                                include("connect.php");
                                $query = $_POST ['query'];
                                $sql = "SELECT * FROM feedback WHERE Cust_Id LIKE '%$query%'";
                                $result = $conn->query($sql);
                                if($result->num_rows >0){
                                  while ( $row = $result->fetch_assoc()){
                                    ?>
                                    <tr>
                                      <td><?php echo $row["Feedback_Id"] ?></td>
                                      <td><?php echo $row["Cust_Id"] ?></td>
                                      <td><?php echo $row["Time_Sent"] ?></td>
                                      <td><?php echo $row["Date_Sent"] ?></td>
                                      <td><?php echo $row["Description"] ?></td>
                                    </tr>
                                    <?php
                                  }

                                }else{
                                  echo "<tr><td colspan='5'>No results found</td></tr>";
                                }
?> 