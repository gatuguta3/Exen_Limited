<?php
include 'connect.php';

    $sql = "SELECT COUNT(*) AS row_count FROM customer_details";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch result
    $row = $result->fetch_assoc();
    $rowCount = $row["row_count"];
} else {
    $rowCount = 0;
} 


$sql1 = "SELECT COUNT(*) AS row_count FROM employee_details";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
// Fetch result
$row1 = $result1->fetch_assoc();
$rowCount1 = $row1["row_count"];
} else {
$rowCount1 = 0;
} 


$sql2 = "SELECT COUNT(*) AS row_count FROM supplier_details";
    $result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    // Fetch result
    $row2 = $result2->fetch_assoc();
    $rowCount2 = $row2["row_count"];
} else {
    $rowCount2 = 0;
} 

$sql3 = "SELECT * FROM users";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM feedback ORDER BY Time_Sent DESC LIMIT 5";
$result4 = $conn->query($sql4);



?>



<!doctype html>
<html lang="en">



    <head>
        <title>Administrator</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />  
        <script
          src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
        </script>      

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>  
            $(document).ready(function(){
                // jQuery methods go here...

                $(modal_logout_btn).click(function(){
                    window.location.href = "login.php";
                });    
                $(C_cust_btn).click(function(){
                    window.location.href = "Customers.php";
                });    
                $(C_pcust_btn).click(function(){
                    window.location.href = "Customers.php";
                });    
                $(C_emp_btn).click(function(){
                    window.location.href = "Employees.php";
                });    
                $(C_pro_btn).click(function(){
                    window.location.href = "Projects.php";
                });     

              });


        </script>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
          .custom-border {
            border: 2px solid #000000; /* Change the color and thickness as needed */
          }

          .card{
                border: 2px solid rgba( 255,255,255, .2);
                backdrop-filter: blur(20px);                
                border-radius: 10px;
                box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);
          }

          footer {
                box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.5);   
                background-color: #f8f9fa;
                padding: 20px; 
                text-align: center;
            }
            .list-group-item {             
            padding: 10px; /* Increase padding */
            height: 50px; /* Set fixed height */
            }
 
        </style>            
    </head>



    <body>

        <header>
<!-- This section contains the logo and admin heading -->
            <nav class="navbar  text-bg-dark">
                <div class="container-fluid">

                    <a class="navbar-brand" href="#">
                        <img src="E1.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
                      </a>
                      <p class="h3"> Administrator</p>
                                     
                </div>
              </nav>
        </header>

        <main>
<!--This is the navigation bar for the admin-->
<nav class="navbar">
            <div class="container">
            <p class="h2">Dashboard</p>
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
                <li><hr class="dropdown-divider"></hr></li>
                <li class="nav-item ms-auto">
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <span class="bi bi-box-arrow-left"></span>
                                        Logout
                                      </button>
                </li> 
              </ul>
            </div></div>
</nav>
<br>
          
<!-- Dashboard content start here -->
            
                  <div id="Dashboard" class="container-fluid  bg-transparent container-xxl">
                    
                        <div class="row">
                                            <div class="col">
                                            <div class=" card bg-outline-dark p-2 my-4">                                                
                                                <div class="card-body">
                                                <h4 class="card-title">Registered customers</h4>
                                                <p class="card-text"> <?php echo $rowCount; ?> </p>
                                                <button type="button" class="btn btn-outline-dark" id="C_cust_btn"><i class="bi bi-eye"></i></button>
                                                </div>                                            
                                            </div>
                                            </div>

                                            <div class="col">
                                            <div class="card bg-outline-dark p-2 my-4">                                                
                                                <div class="card-body">
                                                <h4 class="card-title">Suppliers</h4>
                                                <p class="card-text"> <?php echo $rowCount2; ?> </p>
                                                <button type="button" class="btn btn-outline-dark" id="C_pcust_btn"><i class="bi bi-eye"></i></button>
                                                </div>                                            
                                            </div>
                                            </div>

                                            <div class="col">
                                            <div class="card bg-outline-dark p-2 my-4">                                                
                                                <div class="card-body">
                                                <h4 class="card-title">Employees</h4>
                                                <p class="card-text"> <?php echo $rowCount1; ?> </p>
                                                <button type="button" class="btn btn-outline-dark" id="C_emp_btn"><i class="bi bi-eye"></i></button>
                                                </div>                                            
                                            </div>
                                            </div>

                                            <div class="col">
                                            <div class="card bg-outline-dark p-2 my-4">                                                
                                                <div class="card-body">
                                                <h4 class="card-title">Projects</h4>
                                                <p class="card-text">0</p>
                                                <button type="button" class="btn btn-outline-dark" id="C_pro_btn"><i class="bi bi-eye"></i></button>
                                                </div> 
                                                </div>                                           
                                          

                            </div>

                              <div class="row">
                                         <div class="container mt-5   p-3 my-3 text-white">
                                          <div id="demo" class="carousel slide " data-bs-ride="carousel">

                                            <!-- Indicators/dots -->
                                            <div class="carousel-indicators">
                                              <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                                              <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                                              <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                                            </div>
                                            
                                            <!-- The slideshow/carousel -->
                                            <div class="carousel-inner">
                                              <div class="carousel-item active ">
                                                <img src="E1.png" alt="Los Angeles" class="d-block" style="width:100%">
                                                <div class="carousel-caption">
                                                  <h3>Nyeri town</h3>
                                                  <p>The best </p>
                                                </div>
                                              </div>
                                              <div class="carousel-item ">
                                                <img src="E1.png" alt="Chicago" class="d-block" style="width:100%">
                                                <div class="carousel-caption">
                                                  <h3>Kisumu</h3>
                                                  <p>Thank you,Kisumu !</p>
                                                </div> 
                                              </div>
                                              <div class="carousel-item ">
                                                <img src="E1.png" alt="New York" class="d-block" style="width:100%">
                                                <div class="carousel-caption">
                                                  <h3>Mombasa</h3>
                                                  <p>We love the Big Apple!</p>
                                                </div>  
                                              </div>
                                            </div>
                                            
                                            <!-- Left and right controls/icons -->
                                            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                                              <span class="carousel-control-prev-icon"></span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                                              <span class="carousel-control-next-icon"></span>
                                            </button>
                                          </div>
                                            </div>
                                     </div>
                        </div><br><br>

                        <div class="row">

                        <div class="col" 
                                                
                            style=" border: 2px solid rgba( 255,255,255, .2);
                                      backdrop-filter: blur(20px);                
                                      border-radius: 10px;
                                      box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);">

                                         <div class="container p-2 my-4  text-dark mt-3">
                                             <h1>Feedback</h1>
                                             <ul class="list-group list-group-flush">                                           
                                      <?php
                                        if($result4->num_rows >0){
                                          while($row4 = $result4->fetch_assoc()){
                                            $id=$row4["Cust_Id"];
                                            $name=$row4["Description"];

                                            echo" <li class='list-group-item  text-primary rounded-pill d-flex '  style='border: 2px solid rgba( 255,255,255, .2);
                                            backdrop-filter: blur(20px);                
                                            border-radius: 10px;
                                            box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);' >";
                                            echo" <span class='badge  rounded-pill text-dark'>$id </span>";
                                            echo" <p>$name</p>";
                                            echo"</li>";
                                            echo"<br>";
                                          }}else{
                                            echo "<tr><td colspan='3'>No data found</td></tr>";
                                        }                                       
                                      
                                      ?>  </ul>
                                           </div>
                              </div> <div class="col-sm-1"></div>
                              
                              <div class="col" 
                                                      
                         style=" border: 2px solid rgba( 255,255,255, .2);
                                  backdrop-filter: blur(20px);                
                                  border-radius: 10px;
                                  box-shadow: 0 14px 28px rgba(0, 0, 0, .2), 0 10px 10px rgba(0, 0, 0, .2);">
                              <div class="container-responsive mt-3 p-2 my-4">
                              <p class="h2">Users accounts</p>  
                              <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Search user by email" id="Search_txt" name="Search_txt">
                          <button class="btn btn-outline-dark" type="submit" id="Search_btn" name="Search_btn">
                            <span class="bi bi-search"></span>
                          </button></div>
                              <div class="dropdown ">                                                         
                                  <button type="button" class="btn btn-outline-dark dropdown-toggle" id="Dashboard_btn" data-bs-toggle="dropdown">
                                  <i class="bi bi-funnel"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                                  <li><a class="dropdown-item"  href='#' >Customers</a></li>
                                  <li><a class="dropdown-item"  href='#' >Employees</a></li>
                                  <li><a class="dropdown-item"  href='#' >Suppliers</a></li>
                                  </ul></div><br>                                        
                                    <table class="table table-striped">
                                        <thead class=" table-dark">
                                        <tr>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Account status</th>                                
                                            <th>Actions</th>                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                         
                                        <?php

                                    if ($result3->num_rows > 0) {
                                    while ($row3 = $result3->fetch_assoc()) {
                                        $email=$row3["Email"];
                                        $Role=$row3["User_Role"] ;
                                        $Accountstatus=$row3["Account_status"];                                        
                                        echo "<tr>";
                                        echo "<td>" . $email ."</td>";
                                        echo "<td>" . $Role."</td>";
                                        echo "<td>" . $Accountstatus."</td>";                                       
                                        echo "<td>" ;
                                        echo "<div class='dropdown'>
                                                  <button type='button' class='btn btn-outline-dark dropdown-toggle' data-bs-toggle='dropdown'>
                                                  <i class='bi bi-gear'></i>
                                                  </button>
                                                <ul class='dropdown-menu'>
                                                <li><a class='dropdown-item' href='javascript:void()' >Approve account</a></li>
                                                <li><a class='dropdown-item' href='javascript:void()'>Disable account</a></li>
                                                </ul>
                                              </div>";
                                        echo "</td>";
                                        echo "</tr>"; 
                                      }}else {
                                        echo "<tr><td colspan='3'>No data found</td></tr>";
                                    }
                                    ?>
                                        </tbody></table></div>
                                         
                              </div>        
                                    
                        </div>
                  <!--End of dashboard--> 
               
                 
<!--End of tab content-->
            </div>

<!-- This is the exit modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
              
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Log out</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
              
                    <!-- Modal body -->
                    <div class="modal-body">
                        Are you sure you want to exit ?
                    </div>
              
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" id="modal_logout_btn">Log Out</button>
                    </div>
              
                  </div>
                </div>
            </div>

        </main><br><br>

<!-- place footer here -->
        <footer>
        <div class="container-fluid ">

<a class="navbar-brand" >
    <img src="E1.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
  </a>
  <p class="h3"> Exen Limited </p>
                
</div>
        </footer>

    </body>
</html>
shssk