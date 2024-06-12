<?php
require __DIR__ . '/../../Pages/connect.php';


$query = $_POST['query'];

$sql="SELECT * FROM employee_details WHERE Emp_Firstname OR Emp_lastname LIKE '%$query%' ";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while($row3 = $result->fetch_assoc()) {
        $id=$row3["Emp_Id"];
        $name=$row3["Emp_Firstname"] ;
        $lname=$row3["Emp_lastname"];
        $nid=$row3["Emp_national_Id"];
        $pno=$row3["Emp_Phonenumber"];
        $pemail=$row3["Emp_emailAddress"];
        $prole= $row3["Emp_role"];
        $dofb=$row3["Emp_dateofbirth"];
        $gender= $row3["Emp_gender"];
        $image=$row3["Emp_image"];

        $img_data = base64_encode($image);
        $img_src = "data:image/jpeg;base64," . $img_data;

      echo "<tr>";
      echo "<td> <img src='$img_src' style='width:30px; length: 30px;' class='rounded-pill'></td>";
      echo "<td> {$id}</td>";
      echo "<td>{$name}</td>";
      echo "<td>{$lname}</td>";
      echo "<td>{$nid}</td>";
      echo"<td>{$pno}</td>";
      echo"<td>{$pemail }</td>";
      echo"<td>{$prole}</td>";
      echo"<td>{$dofb }</td>";
      echo"<td>{$gender }</td>";
      echo "<td>" ;
      echo "   <button type='button' class='Update_btn  btn btn-outline-dark ' href='#Update_Employee_Modal' data-bs-toggle='modal' id='Update_btn'
                data-id='{$id}'
                data-fname='{$name}'
                data-lname='{$lname}'
                data-nid='{$nid}'
                data-pid='{$pno}'
                data-email='{$pemail}'
                data-role='{$prole}'
                data-date='{$dofb}'
                data-gender='{$gender}'
                >
                <i class='bi bi-pencil'></i>
                </button>    
                <button type='button' class='View_btn  btn btn-outline-dark ' id='View_btn'
                Vdata-id='{$id}'            
                >
                <i class='bi bi-trash'></i>
                </button>                                   
            ";
      echo "</td>";

      echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No results found</td></tr>";
}
?>
<!-- This is the employee update Modal -->
<div class="modal" id="Update_Employee_Modal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content ">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Employee details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="Employee_Update.php" method="POST">      
                     <input type="text" class="form-control mt-3" placeholder="Customer id" id="edit-id" >
                      <input type="text" class="form-control mt-3" placeholder="First name" id="edit-fname">
                      <input type="text" class="form-control mt-3" placeholder="Last name" id="edit-lname">
                      <input type="text" class="form-control mt-3" placeholder="National id number" id="edit-national-id">
                      <input type="text" class="form-control mt-3" placeholder="Phone number" id="edit-phone-no">
                      <input type="text" class="form-control mt-3" placeholder="Email address" id="edit-email">
                      <input type="text" class="form-control mt-3" placeholder="Date of hire"  id="edit-date"> 
                      <input type="text" class="form-control mt-3" placeholder="Role"  id="edit-role">
                      <input type="text" class="form-control mt-3" placeholder="Gender"  id="edit-gender">
            
      </div>  
                       
                    </form>  
       <!-- Modal footer -->
                    <div class="modal-footer">
                    <button class="btn btn-outline-dark mt-2" type="button" name="update_emp">Submit</button>
                    </div>
                    </div></div>
  </div>
  <!--  -->

  <script>
    var btns = document.getElementsByClassName("Update_btn");
    var modal = document.getElementById('Update_Employee_Modal',);
    var span = document.getElementsByClassName("close")[0];
    for (var i = 0; i < btns.length; i++) {
        btns[i].onclick = function () {
          modal.style.display = "block";            
            document.getElementById('edit-id').value = this.getAttribute('data-id');
            document.getElementById('edit-fname').value = this.getAttribute('data-fname');
            document.getElementById('edit-lname').value = this.getAttribute('data-lname');
            document.getElementById('edit-national-id').value = this.getAttribute('data-nid');
            document.getElementById('edit-phone-no').value = this.getAttribute('data-pid');
            document.getElementById('edit-email').value = this.getAttribute('data-email');
            document.getElementById('edit-date').value = this.getAttribute('data-role');
            document.getElementById('edit-role').value = this.getAttribute('data-date');
            document.getElementById('edit-gender').value = this.getAttribute('data-gender');
        }
        
    }

  </script>
