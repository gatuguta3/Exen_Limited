<?php

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
      $(document).ready(function(){
                  // jQuery methods go here...

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
</nav><br>
            <div id="Suppliers" class="container-fluid container-xl bg-transparent"><br>
                                <div class="row">
                                <div class="col">

                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search Supplier">
                                    <button class="btn btn-outline-dark" type="submit">
                                        <span class="bi bi-search"></span>
                                    </button>
                                    </div> 

                                    <div class="container  p-1 my-1 ">
                                    <button type="button" class="btn btn-outline-dark"  data-bs-toggle="offcanvas" data-bs-target="#Register_new_supplier">
                                        <span class="bi bi-person-plus"></span>
                                    </button>
                                    </div>

                                    <div class="container-responsive mt-3">                                            
                                    <table class="table table-striped">
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
                                          include 'connect.php';
                                          $sql6="SELECT * FROM supplier_details";
                                          $result6 = mysqli_query($conn,$sql6);
                                        
                                        if($result6->num_rows > 0) {
                                         while ( $row6 = $result6->fetch_assoc()) {
                                        $ids=$row6["Supplier_Id"];
                                        $names=$row6["Name"] ;
                                        $lnames=$row6["Type"];
                                        $nids=$row6["Location"];
                                        $pnos=$row6["Phonenumber"];
                                        $pemails=$row6["email_address"];
                                        $proles= $row6["start_date"];
                                        
                                        echo "<tr>";
                                        echo "<td>" . $ids ."</td>";
                                        echo "<td>" . $names."</td>";
                                        echo "<td>" . $lnames."</td>";
                                        echo "<td>" .$nids ."</td>";
                                        echo"<td>" . $pnos."</td>";
                                        echo"<td>" . $pemails ."</td>";
                                        echo"<td>" . $proles."</td>";
                                        echo "<td>" ;
                                          echo "<div class='dropdown'>
                                                    <button type='button' class='btn btn-outline-dark dropdown-toggle' data-bs-toggle='dropdown'>
                                                      Actions
                                                    </button>
                                                  <ul class='dropdown-menu'>                                                 
                                                  <li><a class='dropdown-item' href='#Update_Supplier_Modal' data-bs-toggle='modal'>Edit details</a></li>
                                                </ul>
                                                </div>";
                                          echo "</td>";
                                          echo "</tr>";       
                                            }
                                          }else{
                                            echo "Failed to fetch data";
                                          }
                                          ?>
                                        
                                        </tbody>
                                    </table>
                                    </div>

                                </div>                               
                            
                                </div>                           
            </div>

<!-- Offcanvas Sidebar for Supplier registration -->

            <div class="offcanvas offcanvas-end text-bg-dark" id="Register_new_supplier">
              <div class="offcanvas-header">
                <h1 class="offcanvas-title">Supplier details</h1>
                <button type="button" class="btn-close btn-danger text-reset" data-bs-dismiss="offcanvas"></button>
              </div>
              <div class="offcanvas-body">
                <form>      
                  <input type="text" class="form-control mt-3" placeholder="Name">                  
                  <input type="text" class="form-control mt-3" placeholder="Location">
                  <input type="text" class="form-control mt-3" placeholder="Phone number">
                  <input type="text" class="form-control mt-3" placeholder="Email address">
                  <input type="date" class="form-control mt-3" id="datepicker" placeholder="contract start date"> 
                <button class="btn btn-secondary mt-3" type="button">Submit</button>
                </form>
              </div>
            </div>

<!-- This is the supplier update Modal -->

<div class="modal" id="Update_Supplier_Modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Supplier Details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-dark" >update</button>
      </div>

    </div>
  </div>
</div>
  </main>
  <footer></footer>
    
</body>
</html>