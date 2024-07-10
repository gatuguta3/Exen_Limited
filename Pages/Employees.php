<?php
require_once("connect.php");
$sql3 = "SELECT * FROM employee_details";
$result3 = $conn->query($sql3);

$roles=["Finance manager","Inventory manager","Dispatch manager","Service manager","Driver","Interior designer","Installer","Supervisor"];

if (isset($_POST['Submit_emp']) ){
  $empid=uniqid();
  $empname = $_POST['FN_emp'];
  $emplname = $_POST['LS_emp'];
  $empidno= $_POST['ID_emp'];
  $empphone= $_POST['Pno_emp'];
  $empemail = $_POST['EM_emp'];
  $emprole = $_POST['role'];
  $empdate = $_POST['date_emp'];
  $empgender= $_POST['optradio'];   


  $sql4 =   "INSERT INTO employee_details (Emp_Id,Emp_Firstname,Emp_lastname,Emp_national_Id, Emp_Phonenumber,
             Email,Emp_role,Emp_dateofbirth,Emp_gender) 
             VALUES ('$empid', '$empname','$emplname','$empidno','$empphone','$empemail','$emprole',' $empdate ',' $empgender')";

    $default_status="Pending";
    $pass="$empphone";
    $sql5= "INSERT INTO users (ID,Email,Password,User_Role, Account_status)
          VALUES ('$empid','$empemail','$pass','$emprole','$default_status')";

  if ($conn->query($sql4,) === TRUE) {
    if ($result3->num_rows > 0) {
      while ($row3 = $result3->fetch_assoc()) {
       header('location:Employees.php');    
  }
  } else {
      echo "Failed " ;
  }}
  if($conn->query($sql5) === TRUE){
    
  }else{
    echo "Failed " ; 
  }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
   />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datatables CSS  -->
  <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
  
  <script>
   $(document).ready(function(){
     // jQuery methods go here...
     $.ajax({
    type: "POST",
    url: "Employees.php",
    data: "data",
    dataType: "dataType",
    success: function (response) {
      
    }   });
    
    $(print1_btn).click(function(){
       window.location.href = "Employee_print.php";
     }); 

  }); 
      
</script>
<script>

$(document).ready(function() {
            $("#Search_btn").click(function() {
                var query = $("#Search_txt").val();
                $.ajax({
                    url: "Employee_search.php",
                    type: "POST",
                    data: { query: query },
                    success: function(response) {
                        $("#Employee_table tbody").html(response);
                    }
                });
            });
        });
</script>
<script
              src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
              integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
              crossorigin="anonymous"
          ></script>
          <script
              src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
              integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
              crossorigin="anonymous"
          ></script>

        <style>
          footer {
    box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.5);   
    background-color: #f8f9fa;
    padding: 20px; 
    text-align: center;
}

.table-wrapper {
            max-height: 600px; 
            overflow-y: auto; 
        }
        </style>
</head>
<body>
<header>

<!-- This section contains the logo and admin heading -->
    <nav class="navbar text-bg-dark">
                <div class="container-fluid">

                    <a class="navbar-brand" href="#">
                        <img src="E1.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
                      </a>
                      <p class="h3"> Administrator</p>
                                     
                </div>
              </nav>
</header>
<main>
<nav class="navbar">
<div class="container">
<p class="h2">Employees</p>
<div class="dropdown dropstart ">                                                         
<button type="button" class="btn btn-outline-dark dropdown-toggle" id="Dashboard_btn" data-bs-toggle="dropdown"><i class="bi bi-list"></i></button>
<ul class="dropdown-menu">
<li><a class="dropdown-item"  href='Dashboard.php' >Dashboard</a></li>
<li><hr class="dropdown-divider"></hr></li>
    <li><a class="dropdown-item"  href='Customers.php' >Customers</a></li>
    <li><a class="dropdown-item" href="Employees.php">Employees</a></li>
    <li><a class="dropdown-item"  href="Suppliers.php">Suppliers</a></li>
    <li><hr class="dropdown-divider"></hr></li>
    <li><a class="dropdown-item"  href="Products.php">Products</a></li>
    <li><a class="dropdown-item" href="Supplies.php">Supplies</a></li>
    <li><hr class="dropdown-divider"></hr></li>
    <li><a class="dropdown-item"  href="Transactions.php">Transactions</a></li>
    <li><a class="dropdown-item" href="Deliveries.php">Deliveries</a></li>
    <li><a class="dropdown-item" href="Orders.php">Orders</a></li>
    <li><a class="dropdown-item" href="Services.php">Services</a></li>
    <li><a class="dropdown-item"href="Feedback.php">Feedback</a></li>
    <li><hr class="dropdown-divider"></hr></li>
    <li><a class="dropdown-item"href="Projects.php">Projects</a></li>
  </ul>
</div></div>
</nav><br>
<div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>

<div id="Employees" class="container-fluid d-flex container-xl"
                              
style=" border: 2px solid rgba( 255,255,255, .2);
                                  backdrop-filter: blur(20px);                
                                  border-radius: 10px;
                                  box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);"><br>
                    <div class="col">
                      <div class="container-responsive mt-3">
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Search Employee by firstname" id="Search_txt" name="Search_txt">
                          <button class="btn btn-outline-dark" type="submit" id="Search_btn" name="Search_btn">
                            <span class="bi bi-search"></span>
                          </button><br>
                          <div class="container  p-1 my-1">
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#Register_Employee_Modal" >
                            <span class="bi bi-person-plus"></span>
                          </button>                        
                          <button type="button" class="btn btn-outline-dark" id="print1_btn" ><i class="bi bi-printer"></i></button>
                        </div>
                      
                        <div class="container-responsive mt-3">
                              
                          <table class="table table-striped" id="Employee_table">
                            <thead class="table-dark">
                              <tr>                                
                                <th>Employee Id</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Nationa Id no</th>
                                <th>Phone number</th>
                                <th>Email address</th>
                                <th>Role</th>
                                <th>Date of Hire</th>
                                <th>Gender</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>

                                              <?php 
                                              $sql3 = "SELECT * FROM employee_details";
                                              $result3 = $conn->query($sql3);
                                              while( $row3=mysqli_fetch_assoc($result3)){          
                                              ?>
                                              <tr>                                                
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
                                      ?>
          
          
                              </tbody>
                          </table>
                        
                        </div>

                      </div>                     
                    </div>               
</div>




</main>  

<!-- This is the employee registration Modal -->
<div class="modal" id="Register_Employee_Modal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content ">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Register new Employee </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>    

      <!-- Modal body -->
      <div class="modal-body">           
      <form method="POST" style="width:60vw;">
                                              
                      <input type="text" class="form-control mt-3" placeholder="First name" id="FN_emp" name="FN_emp">
                      <input type="text" class="form-control mt-3" placeholder="Last name" id="LS_emp" name="LS_emp">
                      <input type="text" class="form-control mt-3" placeholder="National id number" id="ID_emp" name="ID_emp">
                      <input type="text" class="form-control mt-3" placeholder="Phone number" id="Pno_emp" name="Pno_emp">
                      <input type="text" class="form-control mt-3" placeholder="Email address" id="EM_emp" name="EM_emp">
                      <input type="date" class="form-control mt-3" id="datepicker" id="date_emp" name="date_emp">                                         
                      <select name="role" class="form-control mt-3">
                            <?php foreach($roles as $role): ?>
                                <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                            <?php endforeach; ?>
                        </select>
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio1" name="optradio" value="Male" checked>
                        <label class="form-check-label" for="radio1">Male</label>
                        </div>
                        <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio2" name="optradio" value="Female">
                        <label class="form-check-label" for="radio2">Female</label> 
                        <!-- Modal footer -->
                    <div class="modal-footer">
                    <button class="btn btn-outline-dark mt-2" type="submit" name="Submit_emp">Submit</button>                    
                    </div>
                       
                    </form>        
                    
                    </div></div>
  </div>
</div>  
</body>
</html>