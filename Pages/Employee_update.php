<?php
require_once("connect.php");

$id= $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
         body{                
                background: #f6f5f7;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: -20px 0 50px;
                margin-top: 20px;                
              }
    </style>
</head>
<body>
<h4>Edit Employee details</h4>
<div class="card bg-outline-dark p-2 my-4" style="border: 2px solid rgba( 255,255,255, .2);
                backdrop-filter: blur(20px);                
                border-radius: 10px;
                box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);
                width:60vw;"> 
                <div class="container-fluid">
                    <a href="Employees.php" class="btn btn-outline-dark"><i class="bi bi-arrow-left"></i></a>                    
                </div>
                                                       
        <div class="card-body">
                <?php                                          
                    $sql6="SELECT * FROM employee_details WHERE Emp_Id ='$id'";
                    $result6 = mysqli_query($conn,$sql6); 
                    $row = mysqli_fetch_assoc($result6);
                                                                                        //`Emp_Id`, `Emp_Firstname`, `Emp_lastname`, `Emp_national_Id`, `Emp_Phonenumber`, `Emp_emailAddress`, 
                                                                                        //`Emp_role`, `Emp_dateofbirth`, `Emp_gender`, `Emp_image`
                ?>
            <form action="" method="post">
                      <input type="hidden" class="form-control mt-3" placeholder="Customer id" name="edit-id" value="<?php echo $row['Emp_Id'] ?>">
                      <input type="text" class="form-control mt-3" readonly class="form-control-plaintext" value="<?php echo $row['Emp_emailAddress'] ?>" placeholder="Email address" name="edit-email">
                      <input type="text" class="form-control mt-3" placeholder="First name" name="edit-fname" value="<?php echo $row['Emp_Firstname'] ?>">
                      <input type="text" class="form-control mt-3" placeholder="Last name" name="edit-lname" value="<?php echo $row['Emp_lastname'] ?>">
                      <input type="text" class="form-control mt-3" placeholder="National id number" name="edit-national-id" value="<?php echo $row['Emp_national_Id'] ?>">
                      <input type="text" class="form-control mt-3" placeholder="Phone number" name="edit-phone-no" value="<?php echo $row['Emp_Phonenumber'] ?>">
                      <input type="date" class="form-control mt-3" id="datepicker" placeholder="contract start date" 
                          value="<?php $date=$row['Emp_dateofbirth']; 
                                       $date = date('Y-m-d', strtotime($date));
                                       echo htmlspecialchars($date);?>" name="edit-date" id="edit-date">
                   
                      <input type="text" class="form-control mt-3" placeholder="Role"  name="edit-role" value="<?php echo $row['Emp_role'] ?>"><br>
                       <div class="form-group mb-3">
                            <label>Gender:</label>
                            &nbsp;
                            <input type="radio" class="form-check-input" name="gender"  value="Male" <?php echo ($row["Emp_gender"] == 'Male') ? "checked" : ""; ?>>
                            <label for="male" class="form-input-label">Male</label>
                            &nbsp;
                            <input type="radio" class="form-check-input" name="gender"  value="Female" <?php echo ($row["Emp_gender"] == 'Female') ? "checked" : ""; ?>>
                            <label for="female" class="form-input-label">Female</label>
                      </div>
                      <button class="btn btn-outline-dark mt-2" type="submit" name="update_emp">Update</button>                      
                    </form>
                    <?php 
                    if(isset($_POST['submit'])){
                                $email= $_POST['edit-email'];
                                $fname= $_POST['edit-fname'];
                                $lname= $_POST['edit-lname'];
                                $Nid= $_POST['edit-national-id'];
                                $PhoneNo= $_POST['edit-phone-no'];
                                $date== $_POST['edit-date'];
                                $role= $_POST['edit-role'];
                                $gender= $_POST['gender'];

                        $sql=" UPDATE `employee_details` SET ,`Emp_Firstname`='$fname'
                                    ,`Emp_lastname`='$lname',`Emp_national_Id`='$Nid'
                                    ,`Emp_Phonenumber`='$PhoneNo'
                                    ,`Emp_emailAddress`='$email',`Emp_role`='$role'
                                    ,`Emp_dateofbirth`='$date'
                                    ,`Emp_gender`='$role',`Emp_image`='[value-10]' WHERE `Emp_Id`='[value-1]'";
                                }
                    ?>


        </div></div>
    
</body>
</html>