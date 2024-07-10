<?php
require 'connect.php';

$query = $_POST['query'];

$sql3="SELECT * FROM employee_details WHERE Emp_Firstname LIKE '%$query%' ";

$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
  while( $row3=mysqli_fetch_assoc($result3)){
  ?>
  <tr>
    <td><?php 
          $image=$row3["Emp_image"];
          $img_data = base64_encode($image);
          $img_src = "data:image/jpeg;base64," . $img_data;
          echo "<img src='$img_src' style='width:30px; length: 30px;' class='rounded-pill'";
    ?></td>
    <td><?php echo $row3["Emp_Id"]?></td>
    <td><?php echo $row3["Emp_Firstname"]?></td>
    <td><?php echo $row3["Emp_lastname"]?></td>
    <td><?php echo $row3["Emp_national_Id"]?></td>
    <td><?php echo $row3["Emp_Phonenumber"]?></td>
    <td><?php echo $row3["Email"]?></td>
    <td><?php echo $row3["Emp_role"]?></td>
    <td><?php echo $row3["Emp_dateofbirth"]?></td>
    <td><?php echo $row3["Emp_gender"]?></td>
    <td>
    <a class="link-dark" href="Employee_update.php?id=<?php echo $row3["Emp_Id"]?>"><i class="bi bi-pencil"> Edit</i></a>
    </td>
    
  </tr>
<?php     
  }
} else {
    echo "<tr><td colspan='11'>No results found</td></tr>";
}
?>
