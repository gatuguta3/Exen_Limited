<?php
  include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers</title>
    <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        >
   </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
              crossorigin="anonymous"
    />
    <script>
      $(document).ready(function() {
            $("#Search_btn").click(function() {
                var query = $("#Search_txt").val();
                $.ajax({
                    url: "Supplier_search.php",
                    type: "POST",
                    data: { query: query },
                    success: function(response) {
                        $("#supplier_table tbody").html(response);
                    }
                });
            });
        });

  </script>
  <!-- Bootstrap JavaScript Libraries -->
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
<p class="h2">Suppliers</p>
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
</nav>
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
            <div id="Suppliers" class="container-fluid container-xl "><br>
                                <div class="row " style="border: 2px solid rgba( 255,255,255, .2);
                                                          backdrop-filter: blur(20px);                
                                                          border-radius: 10px;
                                                          box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);">
                                <div class="col mt-3">

                                    <div class="input-group mb-3" >
                                    <input type="text" class="form-control" placeholder="Search Supplier" id="Search_txt" name="Search_txt">
                                    <button class="btn btn-outline-dark" type="submit" id="Search_btn" name="Search_btn">
                                        <span class="bi bi-search"></span>
                                    </button>
                                    </div> 

                                    <div class="container  p-1 my-1 ">
                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle='modal' href="#Register_new_supplier">
                                        <span class="bi bi-person-plus"></span>
                                    </button>
                                    <button class="btn btn-outline-dark" onclick="window.print()"><i class="bi bi-printer"></i></button>
                                    </div>
                                    <style>
                                      @media print{
                                        body * {
                                          visibility: hidden;
                                        }
                                        .printable_table, .printable_table * {
                                          visibility: visible;
                                        }
                                        .printable_table {
                                          position: absolute;
                                          left: 0px;
                                          top: 0px;
                                        }
                                        
                                      }
                                    </style>

                                    <div class="container-responsive mt-3 printable_table">                                            
                                    <table class="table table-striped" id="supplier_table">
                                        <thead class=" table-dark">
                                        <tr>
                                            <th>Supplier Id</th>
                                            <th>Full name</th>
                                            <th>Type</th>                                
                                            <th>Location</th>
                                            <th>Phone number</th>
                                            <th>Email address</th>
                                            <th>Start Date</th>                            
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $sql6="SELECT * FROM suppliers";
                                            $result6 = mysqli_query($conn,$sql6);
                                            while ( $row6 = mysqli_fetch_assoc($result6)){
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
                                            ?>
                                          
                                        </tbody>
                                    </table>
                                    </div>

                                </div>                               
                            
                                </div>                           
            </div>

<!-- This is the supplier Register Modal -->

<div class="modal" id="Register_new_supplier">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create New supplier account</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      
      <div class="modal-body"> 
      <form method="POST"> 
                  <input type="text" class="form-control mt-3" placeholder="Name" required name="S_name" id="S_name">                  
                  <input type="text" class="form-control mt-3" placeholder="Location" required name="S_Location" id="S_Location"><br>
                  <div class="form-group mb-3">
                    <label>Supplier type:</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="S_type" id="radio1" value="Company">
                    <label for="male" class="form-input-label">Company</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="S_type" id="radio2" value="Individual">
                    <label for="female" class="form-input-label">Individual</label>
                  </div> 
                  <input type="text" class="form-control mt-3" placeholder="Phone number" required name="S_pno" id="S_pno">
                  <input type="text" class="form-control mt-3" placeholder="Email address" name="S_email" id="S_email">
                  <input type="date" class="form-control mt-3" id="datepicker" placeholder="contract start date" required name="S_date" id="S_date">                   
      
      <!-- Modal footer -->
      <div class="modal-footer">
      <button class="btn btn-outline-dark mt-3" type="submit" name="submit_supplier">Submit</button>
      </div>
      </form>
      </div>
      

    </div>
  </div>

</div>
<?php
//INSERT INTO `suppliers`(`Supplier_Id`, `Name`, `Type`, 
//`Location`, `Phonenumber`, `email_address`, `start_date`)
// VALUES ('[value-1]','[value-2]','[value-3]','[value-4]',
//'[value-5]','[value-6]','[value-7]')

if(isset($_POST['submit_supplier'])){
   $supid=uniqid();
   $Sname=$_POST['S_name'];
   $Stype=$_POST['S_type'];
   $Slocation=$_POST['S_Location'];
   $Spno=$_POST['S_pno'];
   $SEmail=$_POST['S_email'];
   $Sdate=$_POST['S_date'];

   $sql="INSERT INTO suppliers (`Supplier_Id`, `Name`, `Type`,
        `Location`, `Phonenumber`, `email_address`, `start_date`)VALUES
         ('$supid','$Sname','$Stype','$Slocation','$Spno','$SEmail','$Sdate')";
  
  $default_status="pending";
  $role="supplier";
  $pass="$Spno";

  $sql1="INSERT INTO users (ID,Email, Password ,User_Role, Account_status)
          VALUES ('$supid','$SEmail','$pass','$role','$default_status')";

if ($conn->query($sql,) === TRUE) {
  if ($result6->num_rows > 0) {
    while ($row6 = $result6->fetch_assoc()) {
     header('location:Suppliers.php');    
}
} else {
    echo "Failed " ;
}}
if($conn->query($sql1) === TRUE){
  
}else{
  echo "Failed " ; 
}

}

?>


  </main>
  <footer>
 
  </footer>
    
</body>
</html>